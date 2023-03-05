<?php

namespace App\Http\Controllers;

use App\Mail\bookconfirmation;
use App\Models\Addtocartservice;
use App\Models\Admin;
use App\Models\Appoinment;
use App\Models\Appointment;
use App\Models\Appointmentnew;
use App\Models\Billing;
use App\Models\BusinessHour;
use App\Models\Discount;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Svg\Tag\Rect;

class AdminController extends Controller
{



    // view urls
    public function dashboard(){
            $name= auth()->user()->fname;
            $patient = User::select('fname')->distinct()->get();
            return view('admin.dashboard')->with('name', $name)->with('patients', $patient);
    }

    //profile page
    public function profile(){
        return view('admin.profile');
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
            "email" => ['required', 'email' ],
            "username" => ['required'],
            "password" => 'required|confirmed|',
            "usertype" => ['required'],
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
            $user->usertype = $request->input('usertype');
            $user->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
      



        //hashing of password
        // $validated['password'] = bcrypt($validated['password']);
        // //kunin yung data galing model ("Clinicusers")
        // User::create($validated);
        // return redirect('/admin/profile');
        //$email = $request->input('email');
        // return redirect('/verify')->with('email', $email);
        // auth()->login($clinicuser);
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
            "password" => 'confirmed|',
            "usertype" => ['required'],
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
                // $encrypt = bcrypt($request->input('password'));
                $arrItem = array(
                    
                    'fname' =>$request->get('first_name'),
                    'mname' => $request->get('mname'),
                    'lname' => $request->get('last_name'),
                    'birthday' => $request->get('birthday'),
                    'address' => $request->get('address'),
                    'gender' => $request->get('gender'),
                    'mobileno' => $request->get('mobile_number'),
                    'email' => $request->get('email'),
                    // 'password' => $encrypt,
                    'usertype' => $request->get('usertype'),
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

    //search user
    public function search_user(Request $request){

        if($request->ajax()){
                $name =  $request->input('search');
                $users = User::where('fname', 'LIKE', '%'.$name.'%' )->orWhere('mname', 'LIKE', '%'.$name.'%')->orWhere('lname', 'LIKE', '%'.$name.'%')->get();
                return response()->json(['data'=> $users ]);
            
        }else{
            $users = User::all();
            return view ('reports.users' , compact('users'));
        }

        if($request->input('usertype')){
            $usertype =  $request->input('usertype');
            $users_usertype = User::Where('usertype', $usertype)->get();
            return response()->json(['usertype' => $users_usertype ]);
        }

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

        // $user = User::findOrFail($id);
        // return view('admin.profile.updateuser', ['user' => $user]);
    }

    // discount
    public function discount_show(){
        $data = Discount::all();
        return view('admin.discount', ['discounts' => $data]);
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
        return view('/admin/service', ['services' => $service]);
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

        $appointment = Appointment::all();
        $patient = User::all()->where('usertype', 'patient');
        return view('admin.appointment', ['appointments' => $appointment, 'patients'=> $patient]);
    }

    public function appointment_book($id){
        $upadted = DB::table('appointments')->where('id', $id)->update(['status' =>  'Booked']);
        Mail::to('ronnelardales2192@gmail.com')->send(new bookconfirmation);
        return response()->json([
                'staus' => $id,
        ]);
       
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
        $workinghours = BusinessHour::where('day', '=', $day)->select('from')->get();

        return response()->json([
            'day' => $day,
            'working_hours' => $workinghours,
            
        ]);
    }


  //-------------------------------- transaction --------------------------------//
    public function view_transaction(){
        $appointment = Appointment::all();
        $transaction = Transaction::all();
        // $service = Service::all();
        // $appointment = Appointment::all();
        // $data = User::where('usertye', '=', 'patient');
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
        $addtocarts =  DB::table('addtocartservices')->paginate(2);
        $service = Service::all();
        $sum = Addtocartservice::sum('price');

        return view('admin.billing', [ 'appointments'=> $appointment, 'services' => $service, 'addtocarts'=> $addtocarts, 'sum'=>$sum]);
    }

    public function get_service($id){

        $service = Service::where('servicecode', $id )->get();
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

            $table_view = view('hello')->render();
    
            return response()->json([
                'status' => 200,
                'message' => 'added successfully',
                'html'=> $table_view,
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
        $addtocarts =  DB::table('addtocartservices')->paginate(2);
        $services = Service::all();
        $sum = Addtocartservice::sum('price');
        return view('pagination_addtocart', compact('addtocarts'))->render();
    }
}

