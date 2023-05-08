<?php

namespace App\Http\Controllers;

use App\Mail\Approveaccount;
use App\Mail\bookconfirmation;
use App\Mail\Cancelappointment;
use App\Mail\newAccount;
use App\Mail\patientbook;
use App\Mail\PatientDocument;
use App\Models\Addtocartservice;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Billing;
use App\Models\BusinessHour;
use App\Models\Consultation;
use App\Models\Consultationfile;
use App\Models\Discount;
use App\Models\Guestpage;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
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
use DataTables;

class AdminController extends Controller
{

    // view urls
    public function dashboard(){

        $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
        ->orderBy('date', 'asc')->limit(3)->get();
        $latestuser = User::orderBy('created_at', 'desc')->take(7)->get();


        $transaction = Transaction::select(DB::raw('SUM(total) as total'))
    ->whereYear('created_at', date('Y'))
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->pluck('total');

    
$transactionArray = $transaction->map(function ($item) {
    return (string) $item;
})->toArray();

$try = DB::select(DB::raw('
    SELECT SUM(total) as total, MONTH(created_at) as month FROM (
        SELECT total, created_at FROM transactions WHERE YEAR(created_at) = YEAR(NOW())
        UNION ALL
        SELECT reservation_fee, created_at FROM appointments WHERE YEAR(created_at) = YEAR(NOW())
    ) as combined_totals
    GROUP BY MONTH(created_at)
    ORDER BY MONTH(created_at)
'));



$totals = array_column($try, 'total', 'month');



$gender_records = Consultation::selectRaw('primary_diag, 
    MONTH(created_at) as month, 
    COUNT(CASE WHEN gender = "Male" THEN 1 ELSE NULL END) as "male", 
    COUNT(CASE WHEN gender = "Female" THEN 1 ELSE NULL END) as "female", 
    COUNT(*) as "all"')
    ->whereNotNull('primary_diag')
    ->whereYear('created_at', '=',  date('Y') )
    ->groupBy('primary_diag', 'month')
    ->get();


$diagnosis=[];
$male=[];
$female=[];
foreach($gender_records as $gender){
$diagnosis[]=$gender->primary_diag;
$male[]=$gender->male;
$female[]=$gender->female;
}






            $users = User::all()->count();
            $pending = Appointment::where('status', 'Pending')->count();
            $transaction = Transaction::whereDate('created_at', Carbon::today())->get();
            $appointment = Appointment::whereDate('created_at', Carbon::today())->get();
            $totalappointment = $appointment->sum('reservation_fee');
            $totalbilling = $transaction->sum('total');
            $totalsales = intval($totalappointment) + intval($totalbilling);
            $name= auth()->user()->fname;
    
            return view('admin.dashboard', compact('totals', 'transactionArray'), ['diagnosis' => $diagnosis, 'males' => $male, 'females' =>$female]) ->with('name', $name)
                              
                                          ->with('users', $users)
                                          ->with('pending', $pending)
                                          ->with('transaction', $totalsales)
                                          ->with('latests', $latestuser)
                               
                                          ;
    }


    



// $users = User::all()->count();
// $pending = Appointment::where('status', 'Pending')->count();
// $name= auth()->user()->fname;
// // dd($data);
// $patient = User::select('fname')->distinct()->get();
// return view('admin.dashboard', ['services' => $service, 'males' => $male, 'females' =>$female])->with('name', $name)
//                               ->with('patients', $patient)
//                               ->with('users', $users)
//                               ->with('pending', $pending)
//                               ->with('datas', $gender_records)
//                              ->with('appointments', $appointments)
//                               ;



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

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create new discount';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

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

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Update Discount';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

            return response()->json([
                'status'=>200,
                    'message' => 'discount updated successfully',
                
            ]);

        }
    }
    
    public function delete_discount($discountcode)
    {   
        DB::table('discounts')->where('discountcode', $discountcode)->delete();

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Delete discount';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    //service
    public function service_show(){
        $service = DB::table('services')->paginate(8);
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
            'price' =>'required',
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
            $service->services = $request->input('servicename');
            $service->price = $request->input('price');
            $service->save();

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create new service';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

            return response()->json([
                'status'=>200,
                'message' => 'Added successfully',
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
            'price'=>'required',
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
                'services' =>$request->get('servicename'),
                'price' => $request->get('price'),
            );

            $upadted = DB::table('services')->where('servicecode', $servicecode)->update($arrItem);
            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Update Service';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

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

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Delete service';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    // ----------------------------- Appointment -------------------------------- //




    public function appointment_change_status($id, Request $request){
        $email = DB::table('appointments')->where('id', $id)->first();
        $fullname = $email->fullname;
        $date = $email->date;
        $time = $email->time;

    if($request->status == "Success"){
        $upadted = DB::table('appointments')->where('id', $id)->update(['status' =>  'success']);

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Change appointment status to success';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        // Mail::to($email->email)->send(new bookconfirmation($fullname, $date, $time));
        return response()->json([
    ]);
    }elseif($request->status == "Cancel"){
        $upadted = DB::table('appointments')->where('id', $id)->update(['status' =>  'cancel']);
        Mail::to($email)->send(new Cancelappointment($fullname, $date, $time));

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Change appointment status to cancel';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
        
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

    public function get_appointment_service($id){
        $service = Service::where('servicecode', $id)->first();
        return response()->json([
            'service' => $service,
            // 'users' => $user,
            // 'fullname' => $fullname,
        ]);
    }

    public function get_time(Request $request){
        
        $start = $request->start;
        $date = date('m-d-Y', strtotime($start));
        $day = date('l', strtotime($start));
        $day_numeric = date('w', strtotime($start));

        $workinghours = BusinessHour::where('day', $day)->whereNotIn('from', ['23:59:00'])->pluck('from')->toArray();
        $currentappointment = Appointment::where('date', $start)->where('status', 'pending' )->pluck('time')->toArray();
        $availablehours = array_diff($workinghours, $currentappointment);
        $offday = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($offday as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        if(in_array($day_numeric, $day_array)){

            return response()->json(['status' => 405, 'message' => 'Sorry, this day is off' ]);

        }else{
            if( empty($availablehours) ){
                return response()->json([
                    'status' => 405,
                    'message' => "Sorry, this date is full",
                    'working hours in specific day' => $workinghours,
                    'available time' => $availablehours
                ]);
            }else{
                return response()->json([
                    'date' => $date,
                    'day' => date('l', strtotime($start)),
                    'working hours in specific day' => $workinghours,
                    'current appointments in date' => $currentappointment,
                    'available_time' => $availablehours]);
            }
    
        }
        

        // $day = date('l', strtotime($date));
        // $workinghours = BusinessHour::where('day', '=', $day)->whereNotIn('from', ['23:59:00'])->select('from')->get();

        // return response()->json([
        //     'day' => $day,
        //     'working_hours' => $workinghours,
        // ]);
    }

    public function delete_appointment($id){
        DB::table('appointments')->where('id', $id)->delete();
    }




  //-------------------------------- transaction --------------------------------//
    public function view_transaction(){

        $addtocarts =  DB::table('addtocartservices')->orderBy('created_at', 'desc')->paginate(4, ['*'], 'addtocart');
        $service = Service::all();
        $sum = Addtocartservice::sum('price');
        $patients =  DB::table('users')->where('usertype', 'patient')->where('status', 'verified')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        return view('admin.transaction', [
                                        'services' => $service, 
                                        'addtocarts'=> $addtocarts, 
                                        'sum'=>$sum,
                                        'patients'=>$patients, 
                                      ]);
        // $appointment = Appointment::all();
        // $transaction = DB::table('transactions')->paginate(2) ;
        // return view('admin.transaction', [ 'appointments'=> $appointment, 'transactions' => $transaction]);
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
                                $input['pdf']->move(public_path('consultation/'), $filename) ;
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



    //--------------------------- billing ----------------------------//
    public function index_billing(Request $request){

        if ($request->ajax()) {
            $data = DB::table('transactions')->distinct()->select('transno', 'user_id', 'fullname', 'sub_total', 'status', 'total' )->orderBy('created_at', 'desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        if($row->status == "Pending"){
                            
                             $btn = '<button type="button" data-id="' . $row->transno . '" class="payment btn  btn-success btn-sm">Pay now</button>';
                            $btn = $btn.'<a href="/admin/billing/viewBilling/ ' . $row->transno . ' " class="btn btn-primary btn-sm" style="margin-left:5px"    >View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                            $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;
                           
                        }else{

                            $btn = ' <a href="/admin/billing/viewBilling/' . $row->transno . '" class="btn btn-primary btn-sm">View</a>';
                            $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                    $size = '<div style="width: 200px">' . $btn . '</div>';                
                            return $size;

                           
                          
                        }

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    //    $billing =  DB::table('transactions')->distinct()->select('transno', 'user_id', 'fullname', 'sub_total', 'status', 'total' )->orderBy('transno', 'desc')->paginate(10, ['*'], 'addtocart');
        $discount = Discount::all();
        $mops = Modeofpayment::all();
        // $billing = Transaction::distinct()->select('transno', 'user_id', 'fullname', 'sub_total', 'status', 'total' )->orderBy('transno', 'desc')->get();

        return view('admin.billing', [
                                        'discounts' =>$discount,
                                        'mops' =>$mops,
                                      ]);
    }

    public function get_service($id){

        $service = Service::where('servicecode', $id )->first();
        return response()->json([

            'service' => $service,
           ]);
    }

    public function get_id(){
        $appointment = Transaction::max('transno');
        $total =  $appointment + 1;
        return response()->json([
            'id' => $total ,
           ]);
    }

    public function store_addtocart(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname'=>'required',
            'servicecode'=>'required',
            'price'=>'required',
        ],[
            'fullname.required'=>'Please select user',
            'servicecode.required'=>'Service is required',
            'price.required'=>'Price is required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>401,
                'errors'=> $validator->messages(),
            ]);

        }else{
                    $input = $request->all();
                    $addtocartexist = Addtocartservice::where('servicecode', $input['servicecode'])->first();
                
                    if($addtocartexist){
                        return response()->json([
                            'status' => 400,
                            'message' => 'The service is already added',
                        ]);
                    }else{
                        $addtocart = new Addtocartservice();
                        $addtocart->transno = $input['transno'];
                        $addtocart->user_id = $input['userid'];
                        $addtocart->fullname = $input['fullname'];
                        $addtocart->servicecode = $input['servicecode'];
                        $addtocart->service = $input['service'];
                        $addtocart->price = $input['price'];
                        $addtocart->save();
                
                        return response()->json([
                            'status' => 200,
                            'message' => 'Added successfully',
                            'data' => $addtocart,
                        ]);
                    }
        }
        
   
    }
    public function store_billing(Request $request){

        if (Addtocartservice::count() == 0) {
            return response()->json(['status' => '400']);
        }else{
            $sum = Addtocartservice::sum('price');
            // $insert = Addtocartservice::where('billing_no', $request->billingno)->update(['sub_total' => $sum])
            $addtocart = Addtocartservice::all();
            foreach ($addtocart as $data) {
    
                $billing = new Transaction();
                $billing->transno = $data->transno;
                $billing->user_id = $data->user_id;
                $billing->fullname = $data->fullname;
                $billing->servicecode = $data->servicecode;
                $billing->service = $data->service;
                $billing->price = $data->price;
                $billing->sub_total = $sum;
                $billing->total = $sum;
                $billing->status = 'Pending';
                $billing->save();
            }
            Addtocartservice::truncate();  

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create transaction';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();
    
            return response()->json([
               'status' => 200,
               'message' => 'Saved successfully',
            ]);

        }



    }

    public function update_payment($id ,Request $request){
        

    $validator = Validator::make($request->all(), [
        'mode_of_payment' => 'required'
        ],[
            'mode_of_payment.required'=>'Mode of payment is required',
            ]);

     if($validator->fails()) {
        return response()->json([
           'status' => 400,
           'errors' => $validator->errors()
        ]);
     }else{
$input = $request->all();
        if($input['mode_of_payment'] == "Cash"){
            $validator = Validator::make($request->all(), [
                'payment'=>'required',
            ],[
                'payment.required'=> 'Payment  is required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->errors(),
                ]);
            }else{

                
                        Transaction::where('transno', $id)->update([
                                                    'discount' => $input['discountname'],
                                                    'discount_price' => $input['discountprice'],
                                                    'total' => $input['total'],
                                                    'mode_of_payment' => $input['mode_of_payment'],
                                                    'reference_no' => $input['reference_no'],
                                                    'payment' => floor($input['payment']),  
                                                    'change' => floatval(str_replace(',', '', $input['change'])),
                                                    'status' => "Paid",             
                                                            ]);

                                                    $audit_trail = new AuditTrail();
                                                    $audit_trail->user_id = Auth::user()->id;
                                                    $audit_trail->username = Auth::user()->username;
                                                    $audit_trail->activity = 'Update transaction';
                                                    $audit_trail->usertype = Auth::user()->usertype;
                                                    $audit_trail->save();
          
            }
        }else{
            $validator = Validator::make($request->all(), [
                'reference_no'=>'required',
            ],[
                'reference_no.required'=> 'Reference no is required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }else{

                        Transaction::where('transno', $id)->update([
                                                    'discount' => $input['discountname'],
                                                    'discount_price' => $input['discountprice'],
                                                    'total' => $input['total'],
                                                    'mode_of_payment' => $input['mode_of_payment'],
                                                    'reference_no' => $input['reference_no'],
                                                    'payment' => floor($input['payment']),  
                                                    'change' => floatval(str_replace(',', '', $input['change'])),
                                                    'status' => "Paid",             
                                                            ]);

                                                            $audit_trail = new AuditTrail();
                                                            $audit_trail->user_id = Auth::user()->id;
                                                            $audit_trail->username = Auth::user()->username;
                                                            $audit_trail->activity = 'Update transaction';
                                                            $audit_trail->usertype = Auth::user()->usertype;
                                                            $audit_trail->save();
            }
        }




     }




    }


    public function delete_transaction($id){

        Addtocartservice::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully',
        ]);

    }

    public function view_billing($id){
        $infos = Transaction::with('user')->where('transno', $id)->first();

        $services = Transaction::where('transno', $id)->get();
      
        return view('admin.viewBilling', compact('services', 'infos'));
    }
    public function edit_billing($id){
        $infos = Billing::with('user')->where('billing_no', $id)->first();
        $services = Billing::where('billing_no', $id)->get();

        //
        
        // $sum = Addtocartservice::sum('price');
        // // $insert = Addtocartservice::where('billing_no', $request->billingno)->update(['sub_total' => $sum])

        // $addtocart = Addtocartservice::all();

        // foreach ($addtocart as $data) {

        //     $billing = new Billing();
        //     $billing->billing_no = $data->billing_no;
        //     $billing->user_id = $data->user_id;
        //     $billing->fullname = $data->fullname;
        //     $billing->servicecode = $data->servicecode;
        //     $billing->service = $data->service;
        //     $billing->price = $data->price;
        //     $billing->sub_total = $sum;
        //     $billing->total = $sum;
        //     $billing->status = 'Pending';
        //     $billing->save();
        // }
        // Addtocartservice::truncate();  

        // return response()->json([
        //    'status' => 200,
        //    'message' => 'Saved successfully',
        // ]);

        return view('admin.editBilling', compact('services', 'infos'));
    }


    public function delete_billing($id){

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Delete Transaction';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
          
        $transaction = Transaction::where('transno', '=', $id)->delete();
        return response()->json($id);

    }

    public function deleteall_addtocart(){
        Addtocartservice::truncate();  
        return response()->json([
            'status'=> "deleted successfully",
        ]);
    }

    public function addtocart_paginate(Request $request){
       
        // return response()->json([$request->all()]);
        $appointments = Appointment::all();
        $addtocarts =  DB::table('addtocartservices')->paginate(4, ['*'], 'addtocart');
        $services = Service::all();
        $sum = Addtocartservice::sum('price');
        return view('pagination.pagination_addtocart', compact('addtocarts', 'sum'))->render();
    }

    public function addtocart_getalldata($id){
    $billing = Transaction::where('transno', $id)->first();

    return response()->json(['data' => $billing]);
    // if($addtocart == 0){
    //     return response()->json([
    //         "status" => '400',
    //         "message" => 'Please insert data',
    //     ]);
    // }else{
    //     return response()->json([
    //         "status" => '200',
    //         "message" => 'table has data',
    //     ]);
    // }
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
 public function view_queuing(Request $request){


        if ($request->ajax()) {
            $data = DB::table('appointments')->where('status', 'pending')->whereDate('date', '=', date('Y-m-d'))->whereDate('time', '>', date('H:i:s'))
            ->orderBy('time', 'asc');
            return Datatables::of($data)
            ->addColumn('time', function ($event) {
                // Convert the start_time to a Carbon instance
                $time = Carbon::parse($event->time);
    
                // Format the time as desired, e.g. "h:i A" for 12-hour time format
                return $time->format('h:i A');
            })
            ->addColumn('date', function ($event) {
                // Convert the start_time to a Carbon instance
                $date = Carbon::parse($event->date);
    
                // Format the time as desired, e.g. "h:i A" for 12-hour time format
                return $date->format('M d, Y');
            })
                    ->make(true);
        }
        return view('admin.queuing');



 }

 public function upcoming_queuing(Request $request){

        if ($request->ajax()) {
            $data = DB::table('appointments')->where('status', 'pending')->whereDate('date', '>', date('Y-m-d'))->whereDate('time', '>', date('H:i:s'))
            ->orderBy('date', 'asc');
            return Datatables::of($data)
            ->addColumn('time', function ($event) {
                // Convert the start_time to a Carbon instance
                $time = Carbon::parse($event->time);
    
                // Format the time as desired, e.g. "h:i A" for 12-hour time format
                return $time->format('h:i A');
            })
            ->addColumn('date', function ($event) {
                // Convert the start_time to a Carbon instance
                $date = Carbon::parse($event->date);
    
                // Format the time as desired, e.g. "h:i A" for 12-hour time format
                return $date->format('M d, Y');
            })
                    ->make(true);
        }
        return view('secretary.queuing');


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

    $audit_trail = new AuditTrail();
    $audit_trail->user_id = Auth::user()->id;
    $audit_trail->username = Auth::user()->username;
    $audit_trail->activity = 'Delete business hours';
    $audit_trail->usertype = Auth::user()->usertype;
    $audit_trail->save();

          return response()->json([
                "status" => "deleted successfully",
            ]);
}

public function off_status(Request $request ){
    $status = $request->status;
    $day = implode($request->day_id);
    
    if( $status == "checked"){
        BusinessHour::where('day', '=', $day)->update(['off' => 0]);

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update business hour';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return response()->json(['status' => 'successfully remove off day']);
    }else{
        BusinessHour::where('day', '=', $day)->update(['off' => 1]);

        
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update business hour';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
        
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
         $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Create new business hour';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return response()->json(['status' => 'off day', 'data' => $day]);
    }else{
        $businesshours->off = 0;
         $businesshours->save();

         $audit_trail = new AuditTrail();
         $audit_trail->user_id = Auth::user()->id;
         $audit_trail->username = Auth::user()->username;
         $audit_trail->activity = 'Create new business hour';
         $audit_trail->usertype = Auth::user()->usertype;
         $audit_trail->save();

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

            
        // $audit_trail = new AuditTrail();
        // $audit_trail->user_id = Auth::user()->id;
        // $audit_trail->username = Auth::user()->username;
        // $audit_trail->activity = 'Update guestpage ';
        // $audit_trail->usertype = Auth::user()->usertype;
        // $audit_trail->save();

            return redirect('admin/guestpage')->with('success', 'updated Successfully');
        }

    }

 }


 //------------consultation --------------------------------//
 public function index_consultation(Request $request){
    if ($request->ajax()) {
        $data = DB::table('consultations')->select('user_id', 'fullname', 'age' ,'gender' )->oldest('created_at')->distinct()->orderby('created_at','desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = ' <a href="/admin/consultation/viewrecords/' . $row->user_id . '" class=" btn btn-sm btn-primary">View</a>';          
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('admin.consultation.index');
 }

 public function index_consultation_appointment_show(Request $request){
    
    // dd($data);
    if ($request->ajax()) {
        $data = DB::table('appointments')->where('status', 'success')->orderby('created_at', 'desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $time = Carbon::parse($event->time);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $time->format('h:i A');
                })
                ->addColumn('date', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $date = Carbon::parse($event->date);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $date->format('M d, Y');
                })
             
                ->addColumn('action', function($row){
                    $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn btn-sm btn-danger" id="select"  data-id="' . $row->id . '">Select</button>';         
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    return view('admin.consultation.create');
 }

 public function create_consultation(){
    $services = Service::all();

    
    return view('admin.consultation.create', compact('services'));
 }

 public function get_consultation_appointment($id){
    $appointment = Appointment::with('user')->where('id', $id)->first();
    return response()->json(['appointment' => $appointment,
                              'gender' => $appointment->user->gender,
                              'age' => $appointment->user->age,
                                        ] );
 }

 public function consultation_store(Request $request){

    $validator = Validator::make($request->all(), [
        "appoint_id" => ['required'],
        "service" => ['required'],
        ],[
            'appoint_id.required' => 'Please select patient appointment',
            'service.required' => 'please insert service',
            ])->stopOnFirstFailure(true);

     if($validator->fails()) {
        
        return Redirect::back()->withErrors($validator);
    }else{
        $input = $request->all();
    
        $date = Carbon::createFromFormat('m/d/Y',$input['date'])->format('Y-m-d');
        $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
        $consultation = new Consultation();
        $consultation->appointment_id = $input['appoint_id'];
        $consultation->user_id = $input['userid'];
        $consultation->fullname = $input['fullname'];
        $consultation->gender = $input['gender'];
        $consultation->age = $input['age'];
        $consultation->date = $date;
        $consultation->time = $time;
        $consultation->service = $input['service'];
        $consultation->primary_diag = $input['primary_diag'];
        $consultation->behavioral_observation = $input['observation'];
        $consultation->brief_summary_encounter = $input['summary'];
        $consultation->clinical_impression = $input['impression'];
        $consultation->treatment_given = $input['treatment'];
        $consultation->recommendation = $input['recommendation'];
        $consultation->save();

        return redirect('/admin/consultation');
    }
 }

 public function consultation_view_records($id, Request $request){
    $userinfo = User::where('id', $id)->first();
    $consultations =  DB::table('consultations')->where('user_id', $id)->orderby('created_at', 'desc')->paginate(5);
    $last = Consultation::where('user_id', $id)->latest()->first();


    return view('admin.consultation.patienthistory', compact('userinfo', 'consultations', 'last'));
 }

 public function consultation_view($id, $user_id){

    $userinfo = User::where('id', $user_id)->first();
    $last = Consultation::where('user_id', $user_id)->latest()->first();
    $consultations = Consultation::where('id', $id)->first();

    return view('admin.consultation.view', compact('userinfo', 'consultations', 'last'));
 }

 
 public function consultation_edit($id, $user_id){

    $userinfo = User::where('id', $user_id)->first();
    $last = Consultation::where('user_id', $user_id)->latest()->first();
    $consultations = Consultation::where('id', $id)->first();
    return view('admin.consultation.edit', compact('userinfo', 'consultations', 'last'));
 }

 public function consultation_update($id, Request $request){
    


    $consultation = Consultation::where('id', $id)->update([ 'behavioral_observation' => $request->input('observation') ?? 'n/a',
                                                             'brief_summary_encounter' => $request->input('summary') ?? 'n/a',
                                                             'clinical_impression' => $request->input('impression') ?? 'n/a' ,
                                                             'treatment_given' => $request->input('treatment') ?? 'n/a' ,
                                                             'recommendation' => $request->input('recommendation') ?? 'n/a' ,
                                                                ]);


    return redirect('/admin/consultation/viewrecords/'. $request->input('user_id'));                                                            
 }

 public function index_document(Request $request) {
    if ($request->ajax()) {
        $data = DB::table('consultationfiles')->orderby('created_at','desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="view btn btn-sm btn-primary" data-id="' . $row->id . '">View</button>';
                    $btn = $btn.'<button class="edit btn btn-sm btn-primary" style="margin-left: 5px; margin-right: 5px;" data-id="' . $row->id . '">Edit</button>';
                    $btn = $btn.'<button class="delete btn btn-sm btn-danger" data-id="' . $row->id . '">Delete</button>';
                    $size = '<div style="width: 200px">' . $btn . '</div>';                
                        return $size;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('admin.document');
 }

 public function document_show_appointment(Request $request){
       // dd($data);
       if ($request->ajax()) {
        $data = DB::table('appointments')->where('status', 'success')->orderby('created_at', 'desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $time = Carbon::parse($event->time);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $time->format('h:i A');
                })
                ->addColumn('date', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $date = Carbon::parse($event->date);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $date->format('M d, Y');
                })->setColumnStyle([
                    'time' => 'width: 150px;',
                    'date' => 'width: 200px;',
                ])
                ->addColumn('action', function($row){
                    $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn  " id="select"  data-id="' . $row->id . '">Select</button>';   
                    $size = '<div style="width: 150px">' . $btn . '</div>';          
                        return $size;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    
 }

 public function store_document(Request $request){


    $validator = Validator::make($request->all(), [
        'fullname'=>'required',
        'pdf' => 'mimes:pdf|max:3000|required',
        'doc_type' => 'required',
    ],[
        'pdf.mimes'=>'the file must be a pdf',
        'pdf.required' => 'pdf file is required',
        'fullname.required' => 'Please select an appointment',
        'doc_type.required' => 'File description is required',
    ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>400,
            'errors'=> $validator->messages(),
        ]);

    }else{
            $input = $request->all();
            $filename = date('YmdHis'). '.' . $input['pdf']->getClientOriginalExtension();
            $input['pdf']->move(public_path('consultation/'), $filename);
            $input['pdf'] = $filename;

            $date = Carbon::createFromFormat('m/d/Y', $input['date'])->format('Y-m-d');
            $documents = new Consultationfile();
            $documents->appointment_id = $input['appointment_id'];
            $documents->appointment_date = $date;
            $documents->user_id = $input['user_id'];
            $documents->fullname = $input['fullname'];
            $documents->documenttype = $input['doc_type'];
            $documents->filename = $input['pdf'];
            $documents->note = $input['note'];
            $documents->save();

            $user = User::where('id', $input['user_id'])->first();
            
            $fullname = $input['fullname'];

            Mail::to($user->email)->send(new PatientDocument ($fullname, $date));

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create  Document';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();
        
            return response()->json([
               'status' =>'success',
                'data' => $documents,
            ]);
    }
 }

    public function edit_document($id){
        $document = Consultationfile::where('id', $id)->first();
        return response()->json([
            'document' => $document,
        ]);
    }

    public function update_document($id, Request $request){

        

        $validator = Validator::make($request->all(), [
                    'doc_type' => 'required',
                    'pdf' => 'mimes:pdf|max:3000',
        ],[

                    'pdf.mimes'=>'the file must be a pdf',
                    'doc_type.required'=>'File description is required',
        ]);
    
        if($validator->fails()){
                return response()->json([
                    'status'=>400,
                    'errors'=> $validator->messages(),
                ]);
            }else{
                    $input = $request->all();
                    $document = Consultationfile::where('id', $id)->first();
                    $path = public_path('consultation/'.$document->filename) ;
                  

                    if($document){
                        $document->note = $input['note'];
                        $document->documenttype = $input['doc_type'];
                        // return response()->json($document);
                            if($request->file('pdf')){
                         
                                    if(File::exists($path)){
                                        // return response()->json('file exist');
                                        File::delete($path);
                                    }
                                    $filename = date('YmdHis'). '.' . $input['pdf']->getClientOriginalExtension();
                                    $input['pdf']->move(public_path('consultation/'), $filename);
                                    $input['pdf'] = $filename;
                                    $document->filename = $filename;
    
                            }
                            
                            $document->save();

                            $audit_trail = new AuditTrail();
                            $audit_trail->user_id = Auth::user()->id;
                            $audit_trail->username = Auth::user()->username;
                            $audit_trail->activity = 'Update document';
                            $audit_trail->usertype = Auth::user()->usertype;
                            $audit_trail->save();

                            return response()->json([
                                    'status'=> 200,
                                    'message'=> 'updated successfully',
                            ]);
                            
                    }else{
                            return response()->json([
                                    'status'=>404,
                                    'errors'=> 'no file found',
                                ]);
                    }
            }

        }

        public function delete_document($id){
            $document = Consultationfile::where('id', $id)->first();
            $path = public_path('consultation/'.$document->filename) ;
            DB::table('consultationfiles')->where('id', $id)->delete();
            if(File::exists($path)){
                    File::delete($path);
                }

                $audit_trail = new AuditTrail();
                $audit_trail->user_id = Auth::user()->id;
                $audit_trail->username = Auth::user()->username;
                $audit_trail->activity = 'Delete Document';
                $audit_trail->usertype = Auth::user()->usertype;
                $audit_trail->save();

            return response()->json([
                'status'=>200,
                    'message' => 'Deleted successfully',
                
            ]);
        }

        public function index_reservationfee_setting(){
            $reservationfee = Reservationfee::first();
            return view('system_settings.reservationfee', compact('reservationfee'));
        }

        public function update_reservationfee_setting($id, Request $request){

            $validated = $request->validate([
                "newfee" => ['required'],
            ],[
              'newfee.required' => 'Reservation fee is required',

            ]);

        $reservationfee = Reservationfee::where('id', $id)->update(['reservationfee' => $request->input('newfee')]);
            
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update reservation fee';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

            return redirect()->back()->with('success', 'Updated successfully');
        }

        public function index_myprofile(){
            return view('admin.profile.index');
        }

        public function edit_myprofile(){
            return view('admin.profile.edit');
        }

        public function update_myprofile(Request $request){

            $validated = $request->validate([
                "first_name" => ['required'],
                "mname" => [''],
                "last_name" => ['required',],
                "birthday" => ['required'],
                "age" => ['required'],
                "address" => ['required'],
                "gender" => ['required'],
                "mobileno" => ['required'],
                "email" => ['required', 'email'],
            ],[
              'first_name.required' => 'First name is required',
              'last_name.required' => 'Last name is required',
              'birthday.required' => 'Birthday is required',
              'age.required' => 'Age is required',
              'address.required' => 'Address is required',
              'gender.required' => 'gender is required',
              'mobileno.required' => 'Mobile number is required',
              'email.required' => ' Email is required',
            ]);

        $user = User::where('id', Auth::user()->id)->first();
        $input = $request->all();

        if($user->email == $input['email']  ){
            $user->email = $input['email'];

        }else{

            $validated = $request->validate([
                "email" => [ Rule::unique('users', 'email') ],
            ]);
            $user->email = $input['email'];
        }

        if($user->mobileno == $input['mobileno']  ){
            $user->mobileno = $input['mobileno'];

        }else{
            $validated = $request->validate([
                "mobileno" => [Rule::unique('users', 'mobileno') ],
            ]);
            $user->mobileno = $input['mobileno'];
        }
        

        $user->fname = $input['first_name'];
        $user->mname = $input['mname'];
        $user->lname = $input['last_name'];
        $user->birthday = $input['birthday'];
        $user->address = $input['address'];
        $user->age= $input['age'];
        $user->gender = $input['gender'];

        $user->save();

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update profile';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return redirect('/admin/myprofile')->with('success', 'Updated successfully');

        }

        public function update_profile_pic($id, Request $request){
            $input = $request->all();
            $validated = $request->validate([
                "profilepic" => 'required|mimes:png,jpg,jpeg',
     
            ],[
                "profilepic" =>'The picture must be a file of type: png, jpg, jpeg.'
            ]);
    
            $user = User::where('id', Auth::user()->id)->first();
            $path = public_path('profilepic/'.$user->profile_pic);
    
            if(File::exists($path)){
                File::delete($path);
            }
            $filename = date('YmdHis'). '.' . $input['profilepic']->getClientOriginalExtension();
            $input['profilepic']->move(public_path('profilepic/'), $filename) ;
            $input['profilepic'] = $filename;
            $user->profile_pic = $filename;
    
            $user->save();
           return redirect()->back();
        }

        public function index_changepass(){
            return view('admin.profile.changepass');
        }

        public function update_changepass(Request $request){

       $input = $request->all();
            
        if(password_verify($input['oldpassword'], Auth::user()->password)){
            $validated = $request->validate([
                "password" => 'required|confirmed|min:8',
            ],[
              'password.required' => 'Password is required',
              'password.confirmed' => 'Password did not match',
            ]);

            $user = User::where('id', Auth::user()->id)->first();
            $encrypt = bcrypt($request->input('password'));
            $user->password = $encrypt;
            $user->save();

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Change password';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

            return redirect()->back()->with('success', 'Updated successfully');
             
        }else{
            return redirect()->back()->with('oldpassword', 'The password did not match with the current password.');
        }

    }

    public function index_modeofpayment(){
        $mops = DB::table('modeofpayments')->orderBy('created_at', 'desc')->paginate(5);

        return view('system_settings.modeofpayment', compact('mops'));
    }

    public function store_modeofpayment(Request $request){
        
    $validator = Validator::make($request->all(), [
        'mop'=>'required',
        'image' => 'mimes:png,jpeg,jpg|max:3000',
    ],[
        'mop.required' => 'Name is required',
    ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>400,
            'errors'=> $validator->messages(),
        ]);

    }else{
            $input = $request->all();
            $mop = new Modeofpayment();
            if($request->file()){
                        $filename = date('YmdHis'). '.' . $input['image']->getClientOriginalExtension();
            $input['image']->move(public_path('modeofpayment/'), $filename);
            $input['image'] = $filename;
            $mop->image = $input['image'];
            }
            $mop->modeofpayment = $input['mop'];
            $mop->save();
        
            
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Create new mode of payment';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

            return response()->json([
               'status' =>'success',
                'data' => $request->all(),
            ]);
    }
    }

    public function edit_modeofpayment($id){
        $mop = Modeofpayment::where('id', $id)->first();
        return response()->json([
            'mop' => $mop,
        ]);
    }

    public function update_modeofpayment($id, Request $request){

        $validator = Validator::make($request->all(), [
            'mop'=>'required',
            'image' => 'mimes:png,jpeg,jpg|max:3000',
        ],[
            'mop.required' => 'Name is required',
        ]);


        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{
                $input = $request->all();
                $mop = Modeofpayment::where('id', $id)->first();
                $path = public_path('mofeofpayment/'.$mop->image) ;
              

                if($mop){
                    $mop->modeofpayment = $input['mop'];
                    // return response()->json($document);
                        if($request->file('image')){
                     
                                if(File::exists($path)){
                                    // return response()->json('file exist');
                                    File::delete($path);
                                }
                                $filename = date('YmdHis'). '.' . $input['image']->getClientOriginalExtension();
                                $input['image']->move(public_path('modeofpayment/'), $filename);
                                $input['image'] = $filename;
                                $mop->image = $filename;

                        }
                        
                        $mop->save();

                        
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update mode of payment';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
                        
                        return response()->json([
                                'status'=> 200,
                                'message'=> 'updated successfully',
                        ]);
                        
                }else{
                        return response()->json([
                                'status'=>404,
                                'errors'=> 'no file found',
                            ]);
                }
        }
        
    }

    public function delete_modeofpayment($id){
            Modeofpayment::where('id', $id)->delete();

            
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Delete mode of payment';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'updated successfully',
    ]);
        
    }

    public function get_filterdata(Request $request){

        $query = Appointment::query();

        if ($request->has('name')) {
            $query->where('fullname', 'like', '%' . $request->input('name') . '%');
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('reports.searchresult.appointment_result', compact('appointments'))->render();
    }

    public function index_pendinguser(Request $request){
        
        if ($request->ajax()) {
            $data = DB::table('users')->where('status', 'pending')->orderby('created_at','desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function ($event) {
                        // Convert the start_time to a Carbon instance
                        $date = Carbon::parse($event->created_at);
            
                        // Format the time as desired, e.g. "h:i A" for 12-hour time format
                        return $date->format('M j, Y H:i A');
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button class="verify btn btn-sm btn-primary" style="text-align:center" data-id="' . $row->id . '">Verify</button>';
                        // $btn = $btn.'<button class="edit btn btn-sm btn-primary" style="margin-left: 5px; margin-right: 5px;" data-id="' . $row->id . '">Edit</button>';
                        // $btn = $btn.'<button class="delete btn btn-sm btn-danger" data-id="' . $row->id . '">Delete</button>';
                        // $size = '<div style="width: 150px; text-align:center">' . $btn . '</div>';                
                            return $btn;
                    })
                    ->addColumn('fullname', function ($row){
                        return $row->fname . ' ' . $row->lname;
                    })
 
                    ->rawColumns(['action', 'fullname'])
                    
                    ->make(true);
        }
        return view('admin.pendinguser');
    }

    public function update_pendinguser($id){

        $user = User::where('id', $id)->first();
        $user->status = "verified";
        $user->save();

        Mail::to($user->email)->send(new Approveaccount);

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Verify user';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
        
        return response()->json($user->email);


    }

    public function fetch_user(Request $request){

        if ($request->ajax()) {
            $data =  DB::table('users')->where('usertype', 'patient')->where('status', 'verified')->orderBy('created_at', 'desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('fullname', function($row){
                        $fullname = $row->fname . " " . $row->lname;
                            return $fullname;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn btn-sm btn-danger" id="select"  data-id="' . $row->id . '">Select</button>';         
                            return $btn;
                    })
                    ->rawColumns(['action', 'fullname'])
                    ->make(true);
        }
    }
    

}