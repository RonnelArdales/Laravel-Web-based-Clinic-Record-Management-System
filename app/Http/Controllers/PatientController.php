<?php

namespace App\Http\Controllers;

use App\Mail\Bookappointment;
use App\Mail\Cancelappointment;
use App\Mail\Cancelappointmentpatient;
use App\Mail\Cancelappointmentpatienttoadmin;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Billing;
use App\Models\Consultationfile;
use App\Models\Guestpage;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{

    public function homepage(){
        $speak_with_you = Guestpage::where('title', 'speak with you')->select('content')->first() ;
        return view('patient.homepage' , ['speakwithyou' => $speak_with_you]);
    }
    public function profileshow(){
        
        // $users = User::all();

        // $view = view()->make('pdfSample', ['users' => $users]);
        // $html_content = $view->render();
        // PDF::SetTitle("List of users");
        // PDF::AddPage();
        // PDF::writeHTML($html_content, true, false, true, false, '');
        // // userlist is the name of the PDF downloading
        // PDF::Output('userlist.pdf');    

        // return response()->download(public_path($filename));
        // $client = new Client('SEMAPHORE API KEY', 'Sender Name');
        // $client->message()->send('0917xxxxxxx', 'Your message here');
        $documents = Consultationfile::where('user_id', Auth::user()->id)->get();
        $appointments = DB::table('appointments')->where('user_id',  Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('patient.profile.profile', compact('documents', 'appointments'));
    }

    public function image_profile_update($id, Request $request){
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
       return redirect()->back()->with('success', 'Updated successfully');
    }

    public function edit_profile(){
        return view('patient.profile.editprofile');
    }

    public function update_profile($id, Request $request){
        
        $validated = $request->validate([
            "fname" => ['required', 'min:4'],
            "lname" => ['required', 'min:4'],
            "birthday" => ['required'],
            "address" => ['required', 'min:4'],
            "address" => ['required', 'min:4'],
            "gender" => ['required'],
            "mobileno" => ['required', 'min:4'],
            "email" => ['required', 'email' ],
        ], [
            "fname.required" => "First name is required",
        ] );
        $input = $request->all();
        $user = User::where('id', $id)->first();

        $user->fname = $input['fname'];
        $user->mname = $input['mname'];
        $user->lname = $input['lname'];
        $user->birthday = $input['birthday'];
        $user->address = $input['address'];
        $user->gender = $input['gender'];
        $user->mobileno = $input['mobileno'];
        $user->email = $input['email'];

        if($request->input('old_password') || $request->input('password') || $request->input('password_confirmation')){
            if(password_verify($input['old_password'], $user->password)){
                $validated = $request->validate([
                    "password" => 'required|confirmed|min:8',
                ], [
                    'password.required' => 'Password is required',
                    'password.confirmed' => 'Password did not match',
                ] );
                  
                        $validated = $request->validate([
                              "password" => ['required'],
                          ], [
                              "password.required" => "New password is required",
                          ] );
                        $encrypt = bcrypt($request->input('password'));
                        $user->password = $encrypt;
      
            }else{
                  return redirect()->back()->with('error', 'The password did not match with the current password.');
            }
        }
        
        $user->save();

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Update profile';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        return redirect('/patient/profile')->with('success', 'Updated successfully');
    }

    public function index_billing(){
        $billings =  DB::table('transactions')->where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8, ['*'], 'billing');
        return view('patient.billing.index', compact('billings'));
    }
    public function index_payment(Request $request){   
     
            $input = $request->all();
 
            $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
            $date = Carbon::createFromFormat('m-d-Y', $input['date'])->format('Y-m-d');
            $billin_no = Transaction::max('transno') + 1;

    
            $billinginfo = array(
                                'fullname' => Auth::user()->fname . " " . Auth::user()->lname,
                                'modeofpayment' => "Gcash",
                                'date' => $request->input('date'),
                                'time' => $request->input('time'),
                            );

            $mops = Modeofpayment::all();
            $fee = Reservationfee::first();

            return view('patient.billing.billing_payment')->with('info', $billinginfo)
                                                        ->with('mops', $mops)
                                                        ->with('fee', $fee);

    }


    public function get_mop($id){
        $mop = Modeofpayment::where('modeofpayment', $id)->first();
        return response()->json(['mop' => $mop]);
    }
    public function store_payment(Request $request){

        $request->validate([
            "reference_no" => ['required'],
            "mop" => ['required'],
        ], [
            'reference_no.required' => 'Reference no is required',
            'mop' => 'Mode of payment is required',
        ]);

        $input = $request->all();
        $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
        $date = Carbon::createFromFormat('m-d-Y', $input['date'])->format('Y-m-d');

            $appointment = new Appointment();
            $appointment->user_id = Auth::user()->id;
            $appointment->fullname = Auth::user()->fname . " " . Auth::user()->lname;
            $appointment->contact_no = Auth::user()->mobileno;
            $appointment->email = Auth::user()->email;
            $appointment->date = $input['date'];
            $appointment->time = $time;
            $appointment->appointment_method = "online";
            $appointment->reservation_fee = $input['reservation_fee'];
            $appointment->mode_of_payment = $input['mop'];
            $appointment->reference_no = $input['reference_no'] ;
            $appointment->status = 'pending';
            $appointment->save();

            $admins = User::where('usertype', 'admin')->get();
            $secretaries = User::where('usertype', 'secretary')->get();
 
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new Bookappointment);
            }

            foreach ($secretaries as $secretary) {
                Mail::to($secretary->email)->send(new Bookappointment);
            }

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create an appointment';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();
            

            return redirect('patient/homepage')->with('success', 'Created Successfully, Please wait for your appointment');
    }

    public function cancel_appointment($id){
        $appointment = Appointment::where('id', $id)->update(['status' => 'cancel',]);
        $user = Appointment::where('id', $id)->first();
        $fullname = $user->fullname;
        $date = $user->date;
        $time = $user->time;

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->username = Auth::user()->username;
        $audit_trail->activity = 'Change appointment status to cancel';
        $audit_trail->usertype = Auth::user()->usertype;
        $audit_trail->save();

        Mail::to($user->email)->send(new Cancelappointmentpatient($fullname, $date, $time));

        $admins = User::where('usertype', 'admin')->get();
        $secretaries = User::where('usertype', 'secretary')->get();

        foreach ($admins as $admin) {

           Mail::to($admin->email)->send(new Cancelappointmentpatienttoadmin ($fullname, $date, $time));
        }

        foreach ($secretaries as $secretary) {

            Mail::to($secretary->email)->send(new Cancelappointmentpatienttoadmin ($fullname, $date, $time));
         }
        

        return response()->json($appointment);
    }

    public function document_view($id){
        $document = Consultationfile::where('id', $id)->first();

        return response()->json(['document' => $document]);

    }
}
