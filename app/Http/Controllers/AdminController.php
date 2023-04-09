<?php

namespace App\Http\Controllers;

use App\Mail\bookconfirmation;
use App\Mail\Cancelappointment;
use App\Mail\patientbook;
use App\Models\Addtocartservice;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Billing;
use App\Models\BusinessHour;
use App\Models\Discount;
use App\Models\Guestpage;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use PDO;

class AdminController extends Controller
{

    // view urls
    public function dashboard(){

        $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
        ->orderBy('date', 'asc')->limit(3)->get();
        // // $data = Appointment::distinct('service')-> select('service' , DB::raw('count(gender) as gender_count, gender'))->groupBy('gender', 'service')->get();
        // $data = Appointment:: select('service' , DB::raw('count(*) as gender_count, gender'))->groupBy('gender', 'service')->get();

        // $male = Appointment::where('service', 'Diagnostic')->whereHas('user' , function($query){
        //     $query->where('gender', 'Female');
        // })->with('user')->get();
        // $malecount = $male->count();
        // $datacount = ['Gender'];

        $gender_records = Appointment::selectRaw('service,
                COUNT(CASE WHEN gender = "Male" THEN 1 ELSE NULL END) as "male",
                COUNT(CASE WHEN gender = "Female" THEN 1 ELSE NULL END) as "female",
                COUNT(*) as "all"
        ')->groupBy('service')->get();
        $service=[];
        $male=[];
        $female=[];
        foreach($gender_records as $gender){
            $service[]=$gender->service;
            $male[]=$gender->male;
            $female[]=$gender->female;
        }
        // dd($gender_records[0]->service);
        // dd([$service, $male, $female]);

        // $array = ['Gender', 'Number', 'Service'];
        //   foreach ($gender_records as $key=>$value){
        //         $array[++$key] = [ $value->service, $value->gender, $value->number,];
        //   }
 
        
// dd(json_encode ($gender_records));
        
        // $data = DB::table('appointments')->select('service' ,DB::raw('gender as gender'),
        //                                         DB::raw('count(*) as number'))
        //   ->groupBy('gender', 'service')->get();

        //   $array = ['Gender', 'Number', 'Service'];
        //   foreach ($data as $key=>$value){
        //         $array[++$key] = [ $value->service, $value->gender, $value->number,];
        //   }
    //   {{$data->service}} {{$data->gender}} {{$data->number}} 
            
    // dd(json_encode($array));


            $users = User::all()->count();
            $pending = Appointment::where('status', 'Pending')->count();
            $name= auth()->user()->fname;
            // dd($data);
            $patient = User::select('fname')->distinct()->get();
            return view('admin.dashboard', ['services' => $service, 'males' => $male, 'females' =>$female])->with('name', $name)
                                          ->with('patients', $patient)
                                          ->with('users', $users)
                                          ->with('pending', $pending)
                                          ->with('datas', $gender_records)
                                         ->with('appointments', $appointments)
                                          ;
    }

    //profile page
    public function profile(){
        $patients = DB::table('users')->where('usertype', 'patient')->paginate(9, ['*'], 'patient');
        $secretaries = DB::table('users')->where('usertype', 'secretary')->paginate(9, ['*'], 'secretary');
        $admins = DB::table('users')->where('usertype', 'admin')->paginate(9, ['*'], 'admin'); 
        return view('admin.profile', compact('patients', 'secretaries', 'admins'));
    }

    public function store_user(Request $request){

        $validator = Validator::make($request->all(), [
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" =>'required|numeric',
            "email" => ['required', 'email', Rule::unique('users', 'email') ],
            "username" => ['required', 'regex:/\w*$/', 'min:8', Rule::unique('users', 'username')],
            "password" => 'required|confirmed|min:8',
            "usertype" => ['required'],
            "status" => ['required'],
        ],[
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'birthday.required' => 'Birthday is required',
            'address.required' => 'Address is required',
            'gender.required' => 'gender is required',
            'mobile_number.required' => 'Mobile number is required',
            'email.required' => ' Email is required',
            'username.required' => 'Username name is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password did not match',
            'usertype.required' => 'Usertype is required',
            'status.required' => 'status is required',
          ]);

        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{
            $encrypt = bcrypt($request->input('password'));
            $user = new User();
            $user->fname = $request->input('first_name');
            $user->mname = $request->input('mname');
            $user->lname = $request->input('last_name');
            $user->birthday = $request->input('birthday');
            $user->address = $request->input('address');
            $user->gender = $request->input('gender');
            $user->mobileno = $request->input('mobile_number');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = $encrypt;
            $user->status = $request->input('status');
            $user->usertype = $request->input('usertype');
            $user->save();

            // $audit_trail = new AuditTrail();
            // $audit_trail->user_id = Auth::user()->id;
            // $audit_trail->username = Auth::user()->username;
            // $audit_trail->activity = 'Create new account ';
            // $audit_trail->usertype = Auth::user()->usertype;

        // $audit_trail->save();
        //     return response()->json([
        //         'status'=>200,
        //         'message' => 'audit trail',
        //     ]);
        }
      
    }

    public function update_user($id, Request $request){
        $validator = Validator::make($request->all(), [
            "first_name" => ['required'],
            "last_name" => ['required'],
            "birthday" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" => ['required', 'min:4'],
            "email" => ['required', 'email' ],
            "password" => ['confirmed'],
            "usertype" => ['required'],
            "status" => ['required'],
        ],[
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'birthday.required' => 'Birthday is required',
            'address.required' => 'Address is required',
            'gender.required' => 'gender is required',
            'mobile_number.required' => 'Mobile number is required',
            'email.required' => ' Email is required',
            'username.required' => 'Username name is required',
            'password.confirmed' => 'Password did not match',
            'usertype.required' => 'Usertype is required',
            'status.required' => 'status is required',
          ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else
        {
            if($request->input('password') == null){
                $arrItem = array(
                    'fname' =>$request->get('first_name'),
                    'mname' => $request->get('mname'),
                    'lname' => $request->get('last_name'),
                    'birthday' => $request->get('birthday'),
                    'address' => $request->get('address'),
                    'gender' => $request->get('gender'),
                    'mobileno' => $request->get('mobile_number'),
                    'email' => $request->get('email'),
                    'usertype' => $request->get('usertype'),
                    'status' => $request->get('status'),
                );
                DB::table('users')->where('id', $id)->update($arrItem);
                return response()->json([
                    'status'=>200,
                        'message' => 'discount updated successfully without updated password',
                    
                ]);

            }else{
                 $encrypt = bcrypt($request->input('password'));
                    $arrItem = array(
                        'fname' =>$request->get('first_name'),
                        'mname' => $request->get('mname'),
                        'lname' => $request->get('last_name'),
                        'birthday' => $request->get('birthday'),
                        'address' => $request->get('address'),
                        'gender' => $request->get('gender'),
                        'mobileno' => $request->get('mobile_number'),
                        'email' => $request->get('email'),
                        'password' => $encrypt,
                        'usertype' => $request->get('usertype'),
                        'status' => $request->get('status'),
                    );
                    DB::table('users')->where('id', $id)->update($arrItem);
                    return response()->json([
                        'status'=>200,
                        'message' => 'discount updated successfully with  updated password',
                        
                    ]);
               
            }
        }
    }

    //delete user 
    public function delete_user($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
        ]);
    }


    //show user data in edit page
    public function edit_user($id){
        $user = User::where('id', $id )->get();
           if($user){
            return response()->json([
                'status'=>200,
                'user' => $user,
            ]);
           }else{
            return response()->json([
                'status'=>404,
                'message' => 'discount not found',
            ]);
           }
    }

    public function profile_paginate(Request $request){
        $usertype = $request->input('usertypetable');
        $patients = DB::table('users')->where('usertype', 'patient')->paginate(9, ['*'], 'patient');
        $secretaries = DB::table('users')->where('usertype', 'secretary')->paginate(9, ['*'], 'secretary');
        $admins = DB::table('users')->where('usertype', 'admin')->paginate(9, ['*'], 'admin');
        
        if($usertype == "patient"){
            return view('pagination.pagination_patient', compact('patients'))->render();
        }elseif ($usertype == "secretary") {
            return view('pagination.pagination_secretary', compact('secretaries'))->render();
        }else{
            return view('pagination.pagination_admin', compact('admins' ))->render();
        }
       
    }


    //------------------- discount ---------------------------//
    public function discount_show(){
        $data = Discount::all();
        return view('system_settings.discount', ['discounts' => $data]);
    }

    public function fetch_discount(){
        $data = Discount::all();
        return response()->json([
            'discounts'=> $data,
        ]);
    }

    //show discount create form
    public function create_discount(){
        return view('admin.discount.creatediscount');
    }

    public function store_discount(Request $request){

        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            $discount = new Discount;
            $discount->discountname = $request->input('discountname');
            $discount->percentage = $request->input('percentage');
            $discount->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
    }
    public function edit_discount($discountcode){
           $discount = Discount::where('discountcode', $discountcode )->get();
           if($discount){
            return response()->json([
                'status'=>200,
                'discount' => $discount,
            ]);
           }else{
            return response()->json([
                'status'=>404,
                'message' => 'discount not found',
            ]);
           }
    }
    public function update_discount($discountcode ,Request $request){

        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {
            $arrItem = array(
                'discountname' =>$request->get('discountname'),
                'percentage' => $request->get('percentage'),
            );

            DB::table('discounts')->where('discountcode', $discountcode)->update($arrItem);

            return response()->json([
                'status'=>200,
                    'message' => 'discount updated successfully',
                
            ]);

        }
    }
    
    public function delete_discount($discountcode)
    {   
        DB::table('discounts')->where('discountcode', $discountcode)->delete();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    //service
    public function service_show(){
        $service = Service::all();
        return view('system_settings.service', ['services' => $service]);
    }

public function fetch_service(){
    
    $data = Service::all();
    return response()->json([
        'services'=> $data,
    ]);
}

    //create
    public function store_service(Request $request){

        $validator = Validator::make($request->all(), [
            'servicename'=>'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            $service = new Service;
            $service->servicename = $request->input('servicename');
            $service->price = $request->input('price');
            $service->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
    }

    //show edit service
    public function edit_service($servicecode){

        $service = Service::where('servicecode', $servicecode )->get();
        if($service){
         return response()->json([
             'status'=>200,
             'service' => $service,
         ]);
        }else{
         return response()->json([
             'status'=>404,
             'message' => 'discount not found',
         ]);
        }
    }

    //update service
    public function update_service($servicecode ,Request $request){
        $validator = Validator::make($request->all(), [
            'servicename'=>'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {
            $arrItem = array(
                'servicename' =>$request->get('servicename'),
                'price' => $request->get('price'),
            );

            $upadted = DB::table('services')->where('servicecode', $servicecode)->update($arrItem);
            if($upadted){
                return response()->json([
                    'status'=>200,
                        'message' => 'service updated successfully',
                    
                ]);
            }else{
                return response()->json([
                    'status'=>400,
                        'message' => 'service updated unsuccessfully',
                    
                ]);
            }
        }
    }

    public function delete_service($servicecode){
        DB::table('services')->where('servicecode', $servicecode)->delete();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    // ----------------------------- Appointment -------------------------------- //
    public function appointment_show(){
        $appoints = Appointment::where('service', 'Diagnostic')->with('user')->get();
        $female = Appointment::where('service', 'Diagnostic')->whereHas('user' , function($query){
            $query->where('gender', 'Female');
        })->with('user')->get()->count(); 
        $male = Appointment::where('service', 'Diagnostic')->whereHas('user' , function($query){
            $query->where('gender', 'Male');
        })->with('user')->get()->count(); 
        $total =     $male = Appointment::select('service')->whereHas('user' , function($query){
            $query->where('gender', 'Male');
        })->get()->count(); 
        // // $female = Appointment::where('service', 'Diagnostic')->with('users_female')->get()->count();
        // $male = Appointment::where('service', 'Diagnostic')->withCount('users_male')->get();
        // dd($count);
        // $counts = Appointment::where('service', 'Diagnostic')->with('users_male', 'users_female', 'user')->get()->count();
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
        $patients =  DB::table('users')->where('usertype', 'patient')->paginate(6, ['*'], 'patient');
        return view('admin.appointment', compact('appointments', 'patients', 'appoints', 'male', 'female'));
    }

    public function store_appointment(Request $request){

        $validator = Validator::make($request->all(), [
            'userid'=>'required',
            'date' => 'required',
            'time' => 'required',
        ],[
            'userid.required'=>'Patient information is required',
            'date.required' => 'Appointment date is required',
            'time.required' => 'Appointment time is required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $input = $request->all();
           $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s') ;
            $appointment = new Appointment();
            $appointment->user_id = $input['userid'];
            $appointment->fullname = $input['fullname'];
            $appointment->service = "Psychotherapy Counselling";
            $appointment->date =  $input['date'];
            $appointment->time = $time;
            $appointment->price =  "2000";
            $appointment->status = "Pending";
            $appointment->save();
            // Mail::to('ronnelardales2192@gmail.com')->send(new patientbook);
      
            return response()->json([
                'status' => 200,
                'message' => "Successfully created",
                'time' => $time,
            ]);
        }

 
    }

    public function appointment_change_status($id, Request $request){

    if($request->status == "Booked"){
        $upadted = DB::table('appointments')->where('id', $id)->update(['status' =>  'Booked']);
        // Mail::to('ronnelardales2192@gmail.com')->send(new bookconfirmation);
        return response()->json([
        'staus' => $id,
]);
 }elseif($request->status == "Cancelled"){
    $upadted = DB::table('appointments')->where('id', $id)->update(['status' =>  'Cancelled']);
    // Mail::to('ronnelardales2192@gmail.com')->send(new Cancelappointment);
    return response()->json([
    'staus' => $id,
]);
 }else{
    return response()->json([
        'staus' => $id,
    ]);
 }

    }

    public function get_user($id){
        $user = User::where('id', $id)->get();
        $fullname = User::select( DB::raw("CONCAT(fname, ' ', lname) as fullname"))->where('id', $id)->get();
        return response()->json([
            'users' => $user,
            'fullname' => $fullname,
        ]);
    }

    public function get_time(Request $request){
        
        $date = $request->date;
        
        $day = date('l', strtotime($date));
        $workinghours = BusinessHour::where('day', '=', $day)->whereNotIn('from', ['23:59:00'])->select('from')->get();

        return response()->json([
            'day' => $day,
            'working_hours' => $workinghours,
        ]);
    }

    public function delete_appointment($id){
        DB::table('appointments')->where('id', $id)->delete();
    }

    public function appointment_status($id, Request $request){
        $appointment = Appointment::where('id', $id)->first();
        
        
        if($request->status == "Booked"){
              if($appointment->status === "Booked" ){
            return response()->json(['status' => 400,
                                    'data' => 'tangina',
                                                    ]);
        }else{
            return response()->json(['status' => 300,  'data' => $appointment->status,]);
        }
        }else{
            if($appointment->status === "Cancelled" ){
                return response()->json(['status' => 400  ]);
            }else{
                return response()->json(['status' => 300]);
            }
        }
    }


  //-------------------------------- transaction --------------------------------//
    public function view_transaction(){
        $appointment = Appointment::all();
        $transaction = DB::table('transactions')->paginate(2) ;
        return view('admin.transaction', [ 'appointments'=> $appointment, 'transactions' => $transaction]);
    }

    public function store_transaction(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname'=>'required',
            'pdf' => 'mimes:pdf|max:3000',
        ],[
            'pdf.mimes'=>'the file must be a pdf',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);

        }else{
            $input = $request->all();
            if($request->file('pdf')){
                $validator = Validator::make($request->all(), [
                    'password'=>'required|confirmed',
                    
                ],[
                    'password.confirmed' => 'Password did not match',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status'=>400,
                        'errors'=> $validator->messages(),
                    ]);
                }else{
                    $filename = date('YmdHis'). '.' . $input['pdf']->getClientOriginalExtension();
                    $input['pdf']->move(public_path('consultation/'), $filename);
                    $input['pdf'] = $filename;
                    $password = Crypt::encrypt($input['password']);
                    $input['password'] = $password;
                }
                
            }else{
                $input['pdf'] = "";
                $input['password'] = "";
            }
            $transaction = new Transaction();
            $transaction->transaction_date = date('Y-m-d H:i:s');
            $transaction->user_id = $request->input('userid');
            $transaction->fullname = $request->input('fullname');
            $transaction->consultation_date  = $request->input('consultation');
            $transaction->file  = $input['pdf'];
            $transaction->password  = $input['password'];
            $transaction->save();
            return response()->json([
             'status' => 'successfully created',
             'data' => $input['fullname'],
             'file status' => $input['pdf'],
            ]);
        }  
    }

    public function edit_transaction($id){
        $transaction = Transaction::where('id', $id)->first();
        return response()->json([
            'transaction' => $transaction,
        ]);
    }

    public function update_transaction($id, Request $request){

	  $validator = Validator::make($request->all(), [
		'password'=>'confirmed',	
                'pdf' => 'mimes:pdf|max:3000',
	],[
		'password.confirmed' => 'Password did not match',
                'pdf.mimes'=>'the file must be a pdf',
	]);

	if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{
                $input = $request->all();
                $transaction = Transaction::where('id', $id)->first();
                $path = public_path('consultation/'.$transaction->file) ;
                if($transaction){

                        $transaction->user_id = $input['userid'];
                        $transaction->fullname = $input['fullname'];
                        $transaction->transaction_date = $input['transactiondate'];
                        $transaction->consultation_date = $input['consultation'];
                        
                        if($request->file('pdf')){
                                if(empty($transaction->password)){
                                        $validator = Validator::make($request->all(), [
                                        'password'=>'required|confirmed',        
                                        ],[
                                        'password.confirmed' => 'Password did not match',
                                        ]);
                                        if($validator->fails()){
                                                      return response()->json([
                                                          'status'=>400,
                                                          'errors'=> $validator->messages(),
                                                      ]);
                                                  }else{
                                                        $password = Crypt::encrypt($input['password']);
                                                        $transaction->password = $password;
                                                  }
                                }else{
                                        $validator = Validator::make($request->all(), [
                                        'password'=>'confirmed',        
                                        ],[
                                        'password.confirmed' => 'Password did not match',
                                        ]);
                                        if($validator->fails()){
                                                return response()->json([
                                                    'status'=>400,
                                                    'errors'=> $validator->messages(),
                                                ]);
                                            }else{
                                                  $password = Crypt::encrypt($input['password']);
                                                  $transaction->password = $password;
                                            }
                                }
                                if(File::exists($path)){
                                    File::delete($path);
                                }
                                $filename = date('YmdHis'). '.' . $input['pdf']->getClientOriginalExtension();
                                $input['pdf']->move(public_path('consultation/'), $filename);
                                $input['pdf'] = $filename;
                                $transaction->file = $filename;

                        }
                        
                        $transaction->save();
                        return response()->json([
                                'status'=> 200,
                                'message'=> 'updated successfully',
                        ]);
                        
                }else{
                        return response()->json([
                                'status'=>404,
                                'errors'=> 'no user found',
                            ]);
                }
        }
	
        }
    


    // public function upload_file(Request $request){
    //     $input = $request->all();
    //     $file = $request->file('pdf');
    //     $filename = date('YmdHis'). '.' . $file->getClientOriginalExtension();
    //     $file->move(public_path('consultation/'), $filename);
    //     $input['pdf'] = $filename;

    //     $upload = new Upload();
    //     $upload->file = $input['pdf'];
    //     $upload->save();
    //     return redirect()->back();
    // }

    
    // public function upload_show($id){
    //     $data = Upload::find($id);
    //     return view('viewconsultation', compact('data'));
    // }

    // public function upload_download($file){
    //    return response()->download(public_path('consultation/' . $file));
    // // $file = Pdf::loadFile(public_path('consultation/' . $file))->stream('download.pdf');
    // // dd($file);
    // }

    public function getappointment_user($id){
        $appointment = Appointment::where('id', $id)->get();
        $fullname = Appointment::select( DB::raw("CONCAT(date, ' ', time) as appointmentDate"))->where('id', $id)->get();
       return response()->json([

        'users' => $appointment,
        'appointment' => $fullname,
       ]);
    }

    public function delete_transaction($id){
        $transaction = Transaction::where('id', $id)->first();
        $path = public_path('consultation/'.$transaction->file) ;
        DB::table('transactions')->where('id', $id)->delete();
        if(File::exists($path)){
                File::delete($path);
            }
        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
                // 'filename' => $filename->getClientOriginalExtension(),
            
        ]);
    }


    //--------------------------- billing ----------------------------//
    public function view_billing(){
        $appointment = Appointment::all();
        $addtocarts =  DB::table('addtocartservices')->paginate(5, ['*'], 'addtocart');
        $service = Service::all();
        $sum = Addtocartservice::sum('price');
        $discount = Discount::all();

        return view('admin.billing', [  'appointments'=> $appointment, 
                                        'services' => $service, 
                                        'addtocarts'=> $addtocarts, 
                                        'sum'=>$sum, 
                                        'discounts' =>$discount,]);
    }

    public function get_service($id){

        $service = Service::where('servicecode', $id )->first();
        return response()->json([

            'service' => $service,
           ]);
    }

    public function get_id(){
        $appointment = Billing::max('billing_no') + 1;
        return response()->json([
            'id' => $appointment,
           ]);
    }

    public function store_addtocart(Request $request){
        $input = $request->all();
      
        // $validator = Validator::make($request->all(), [
        //     'password'=>'confirmed',	
        //             'pdf' => 'mimes:pdf|max:3000',
        // ],[
        //     'password.confirmed' => 'Password did not match',
        //             'pdf.mimes'=>'the file must be a pdf',
        // ]);
        $addtocartexist = Addtocartservice::where('servicecode', $input['servicecode'])->first();
       

        if($addtocartexist){
            return response()->json([
                'status' => 400,
                'message' => 'The service is already added',
            ]);
        }else{
            $addtocart = new Addtocartservice();
            $addtocart->billing_no = $input['billingno'];
            $addtocart->billing_date = date('Y-m-d H:i:s');
            $addtocart->appointment_no = $input['appointment'];
            $addtocart->user_id = $input['userid'];
            $addtocart->fullname = $input['fullname'];
            $addtocart->consultation_date = $input['consultation'];
            $addtocart->servicecode = $input['servicecode'];
            $addtocart->service = $input['service'];
            $addtocart->price = $input['price'];
            $addtocart->save();
    
            return response()->json([
                'status' => 200,
                'message' => 'added successfully',
            ]);
        }
    }

    public function deleteall_addtocart(){
        Addtocartservice::truncate();  
        return response()->json([
            'status'=> "deleted successfully",
        ]);
    }

    public function addtocart_paginate(Request $request){
       
        $appointments = Appointment::all();
        $addtocarts =  DB::table('addtocartservices')->paginate(5, ['*'], 'addtocart');
        $services = Service::all();
        $sum = Addtocartservice::sum('price');
        return view('pagination.pagination_addtocart', compact('addtocarts'))->render();
    }

    public function addtocart_getalldata(){
    $addtocart = Addtocartservice::count();
    if($addtocart == 0){
        return response()->json([
            "status" => '400',
            "message" => 'Please insert data',
        ]);
    }else{
        return response()->json([
            "status" => '200',
            "message" => 'table has data',
        ]);
    }
    }

    public function get_discount($id){
            $discount = Discount::where('discountcode', $id)->first();
 
            return response()->json([
                "status" => '200',
                "discount" => $discount,
            ]);
     
}

public function index_discount(){
    $discount = Discount::all();

    return response()->json([
        "status" => '200',
        "discount" => $discount,
    ]);

}


//----------------------quueing ------------------------//
 public function view_queuing(){
    $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))->whereDate('time', '>', date('H:i:s'))
    ->orderBy('date', 'asc')->paginate(5, ['*'], 'queuing');
   

           
            
    // $appointments = Appointment::where('status', 'Booked')->where('created_at', '<=', date('Y-m-d H:i:s'))->get();
    return view('admin.queuing', compact('appointments'));
 }

 // ---------------- business hours ---------------------------//
 public function show_businesshours(){
        $hours = BusinessHour::where('day', 'Monday')->whereNotIn('from', ['23:59:00'])->orderBy('from', 'asc')->get();
        
        $day = BusinessHour::where('day', 'Monday')->select('day', 'off')->distinct()->get();
    return view('system_settings.businesshours', ['hours' =>$hours, "days" => $day]);
 }

 
 public function delete_businesshours(Request $request){
    $checked_array = $request->day_id;

    $data = BusinessHour::whereIn('id', $checked_array)->delete();
          return response()->json([
                "status" => "deleted successfully",
            ]);
}

public function off_status(Request $request ){
    $status = $request->status;
    $day = implode($request->day_id);
    if( $status == "checked"){
        BusinessHour::where('day', '=', $day)->update(['off' => 0]);
        return response()->json(['status' => 'successfully remove off day']);
    }else{
        BusinessHour::where('day', '=', $day)->update(['off' => 1]);
        
        return response()->json(['status' => 'successfully add off day']);
    }

    
    
}

public function get_hours(Request $request){
   $businessdays = $request->businessdays;
   $hours = BusinessHour::where('day', $businessdays)->whereNotIn('from', ['23:59:00'])->orderBy('from', 'asc')->get();
   $days = BusinessHour::where('day', $businessdays)->select('day', 'off')->distinct()->get();
   return view('pagination.businesshours_table', compact('hours', 'days'))->render();
}

public function store_businesshours(Request $request){
    $input = $request->all();
    $businesshours = new BusinessHour();
    $businesshours->day = $input['business_date'];
    $businesshours->from = Carbon::createFromFormat('H:i', $input['business_time'])->format('H:i:s');
    $businesshours->to = Carbon::createFromFormat('H:i', $input['business_time'])->format('H:i:s');
    $businesshours->step = 30;
    $day = BusinessHour::where('day', $input['business_date'])->where('off', '1') ->select('off')->first();
    if($day){
        $businesshours->off = 1;
         $businesshours->save();
        return response()->json(['status' => 'off day', 'data' => $day]);
    }else{
        $businesshours->off = 0;
         $businesshours->save();
        return response()->json(['status' => 'none', 'data' => $day]);
    }
    // $time = Carbon::createFromFormat('H:i', $input['business_time'])->format('H:i:s');
   

    return response()->json(['status' => 'created successfully']);
}
 public function show_guestpage_setting(){
    $content = Guestpage::all();
    return view('system_settings.guestpage', ['guestpages' => $content]);
 }

 public function edit_guestpage_setting($id){
    $content = Guestpage::where('id', $id)->first();
    return view('system_settings.edit_guestpage', ['guestpages' => $content]);
 }

 public function update_guestpage_setting($id, Request $request)
 {
    $validator = Validator::make($request->all(), [
        // "content" => 'bail|required',
        'image' => 'bail|mimes:img,jpg,png|max:3000'
        ],[
            'image.mimes'=>'the file must be a image',
            ])->stopOnFirstFailure(true);

     if($validator->fails()) {
        return Redirect::back()->withErrors($validator);
    }else{

        $input = $request->all();
        $guestpage_id = Guestpage::where('id', $id)->first();
        $path = public_path('guestpage/'.$guestpage_id->image) ;

        if($guestpage_id){
            $guestpage_id->title = $input['title'];
            $guestpage_id->content = $input['content']; 

            if($request->image_status == "remove"){
                if(File::exists($path)){
                    File::delete($path);
                }
                $guestpage_id->image = "";
            }

            if($request->image){
                if(File::exists($path)){
                    File::delete($path);
                }
                $filename = date('YmdHis'). '.' . $input['image']->getClientOriginalExtension();
                $input['image']->move(public_path('guestpage/'), $filename);
                $input['image'] = $filename;
                $guestpage_id->image = $filename;
            }
            $guestpage_id->save();
            return redirect('admin/guestpage')->with('success', 'updated Successfully');
        }

    }

 }
}