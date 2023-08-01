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
    public function Audit_Trail($activity){
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = $activity;
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();
    }

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

        return view('secretary.dashboard', compact('totals', 'transactionArray'), ['diagnosis' => $diagnosis, 'males' => $male, 'females' =>$female])      ->with('name', $name)
        ->with('users', $users)
        ->with('pending', $pending)
        ->with('transaction', $totalsales)
        ->with('latests', $latestuser);

    }

    //------------------- discount ---------------------------//
    public function discount_show(){
        $data = Discount::all();
        return view('secretary.system_settings.discount', ['discounts' => $data]);
    }

    public function fetch_discount(){
        $data = Discount::all();
        return response()->json(['discounts'=> $data, ]);
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

            $activity = "Create new discount";
            $this->Audit_Trail($activity);

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

            $activity = "Update discount";
            $this->Audit_Trail($activity);

            return response()->json([
                'status'=>200,
                'message' => 'discount updated successfully',
            ]);

        }
    }
        
    public function delete_discount($discountcode){   

        DB::table('discounts')->where('discountcode', $discountcode)->delete();
        
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Delete';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        $activity = "Delete discount";
        $this->Audit_Trail($activity);

        return response()->json([
            'status'=>200,
            'message' => 'deleted successfully',
            
        ]);
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

    $activity = "Update profile";
    $this->Audit_Trail($activity);

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

            $activity = "Change Password";
            $this->Audit_Trail($activity);

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


    public function update_guestpage_setting($id, Request $request){
        
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

                $activity = "Update guestpage";
                $this->Audit_Trail($activity);

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

        $activity = "Verify user";
        $this->Audit_Trail($activity);
        
        return response()->json($user->email);
    }

}

