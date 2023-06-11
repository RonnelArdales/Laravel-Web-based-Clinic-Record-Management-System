<?php

namespace App\Http\Controllers;

use App\Mail\Approveaccount;
use App\Models\Addtocartservice;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\BusinessHour;
use App\Models\Consultation;
use App\Models\Dayoff_date;
use App\Models\Discount;
use App\Models\Guestpage;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class SecretaryController extends Controller
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

            return view('secretary.dashboard', compact('totals', 'transactionArray'), ['diagnosis' => $diagnosis, 'males' => $male, 'females' =>$female]) ->with('name', $name)
                                        // ->with('patients', $patient)
                                          ->with('users', $users)
                                          ->with('pending', $pending)
                                          ->with('transaction', $totalsales)
                                          ->with('latests', $latestuser)
                            
                                          ;

    }

    //profile page
    public function profile(){
  
        $patients = DB::table('users')->where('usertype', 'patient')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');

        return view('secretary.profile', compact('patients'));
    }


    public function update_user($id, Request $request){
        
        $validator = Validator::make($request->all(), [
            "first_name" => ['required'],
            "last_name" => ['required'],
            "birthday" => ['required'],
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
    

    //service
    public function service_show(){
        $service = DB::table('services')->paginate(8);
        return view('secretary.system_settings.service', ['services' => $service]);
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

    //appointment
    public function appointment_show(){
        return view('welcome');
    }

//--------------queuing --------------//

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
    return view('secretary.queuing');

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



public function view_transaction(){

    $addtocarts =  DB::table('addtocartservices')->orderBy('created_at', 'desc')->paginate(4, ['*'], 'addtocart');
    $service = Service::all();
    $sum = Addtocartservice::sum('price');
    $patients =  DB::table('users')->where('usertype', 'patient')->where('status', 'verified')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
    return view('secretary.transaction', [
                                    'services' => $service, 
                                    'addtocarts'=> $addtocarts, 
                                    'sum'=>$sum,
                                    'patients'=>$patients, 
                                  ]);
    // $appointment = Appointment::all();
    // $transaction = DB::table('transactions')->paginate(2) ;
    // return view('admin.transaction', [ 'appointments'=> $appointment, 'transactions' => $transaction]);
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

public function get_id(){
    $appointment = Transaction::max('transno');
    $total = intval( $appointment) + 1;
    return response()->json([
        'id' => $total ,
       ]);
}

public function delete_transaction($id){

    Addtocartservice::where('id', $id)->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Deleted successfully',
    ]);

}

public function index_billing(Request $request){

    if ($request->ajax()) {
        $data = DB::table('transactions')->distinct()->select('transno', 'user_id', 'fullname', 'sub_total', 'status', 'total' )->orderBy('transno', 'desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->status == "Pending"){
                        
                         $btn = '<button type="button" data-id="' . $row->transno . '" class="payment btn  btn-success btn-sm">Pay now</button>';
                        $btn = $btn.'<a href="/secretary/billing/viewBilling/ ' . $row->transno . ' " class="btn btn-primary btn-sm" style="margin-left:5px"    >View</a>';
                        $btn = $btn.'<button  style="margin-left:5px" class="delete btn btn-sm btn-danger" data-id="' . $row->transno . '">Delete</button>';
                        $size = '<div style="width: 200px">' . $btn . '</div>';                
                        return $size;
                       
                    }else{

                        $btn = ' <a href="/secretary/billing/viewBilling/' . $row->transno . '" class="btn btn-primary btn-sm">View</a>';
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

    return view('secretary.billing', [
                                    'discounts' =>$discount,
                                    'mops' =>$mops,
                                  ]);
}

public function get_discount($id){
    $discount = Discount::where('discountcode', $id)->first();

    return response()->json([
        "status" => '200',
        "discount" => $discount,
    ]);

}

public function addtocart_getalldata($id){
    $billing = Transaction::where('transno', $id)->first();

    return response()->json(['data' => $billing]);
    }

        //------------------- discount ---------------------------//
        public function discount_show(){
            $data = Discount::all();
            return view('secretary.system_settings.discount', ['discounts' => $data]);
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
                $audit_trail->activity = 'Update discount';
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
            $audit_trail->activity = 'Delete';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();

            return response()->json([
                'status'=>200,
                    'message' => 'deleted successfully',
                
            ]);
        }


        public function view_billing($id){
            $infos = Transaction::with('user')->where('transno', $id)->first();
    
            $services = Transaction::where('transno', $id)->get();
          
            return view('secretary.viewBilling', compact('services', 'infos'));
        }

        public function show_businesshours(){
            $hours = BusinessHour::where('day', 'Monday')->whereNotIn('from', ['23:59:00'])->orderBy('from', 'asc')->get();
            $day = BusinessHour::where('day', 'Monday')->select('day', 'off')->distinct()->get();
            $off_dates = Dayoff_date::all();
            
            $day = BusinessHour::where('day', 'Monday')->select('day', 'off')->distinct()->get();
        return view('secretary.system_settings.businesshours', ['hours' =>$hours, "days" => $day, 'offdates' => $off_dates]);
     }

     public function index_modeofpayment(){
        $mops = DB::table('modeofpayments')->orderBy('created_at', 'desc')->paginate(5);

        return view('secretary.system_settings.modeofpayment', compact('mops'));
    }


    public function index_reservationfee_setting(){
        $reservationfee = Reservationfee::first();
        return view('secretary.system_settings.reservationfee', compact('reservationfee'));
    }



    public function index_myprofile(){
        return view('secretary.profile.index');
    }

    public function edit_myprofile(){
        return view('secretary.profile.edit');
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

    return redirect('/secretary/myprofile')->with('success', 'Updated successfully');

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


        
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Change password';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
       return redirect()->back();
    }

    public function index_changepass(){
        return view('secretary.profile.changepass');
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
        return redirect()->back()->with('success', 'Updated successfully');
         
    }else{
        return redirect()->back()->with('oldpassword', 'The password did not match with the current password.');
    }

}

public function show_guestpage_setting(){
    $content = Guestpage::all();
    return view('secretary.system_settings.guestpage', ['guestpages' => $content]);
 }

 public function edit_guestpage_setting($id){
    $content = Guestpage::where('id', $id)->first();
    return view('secretary.system_settings.edit_guestpage', ['guestpages' => $content]);
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

            return redirect('secretary/guestpage')->with('success', 'updated Successfully');
        }

    }

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
    return view('secretary.pendinguser');
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


}

