<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Consultationfile;
use App\Models\Guestpage;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\File;


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
       return redirect()->back();
    }

    public function edit_profile(){
        return view('patient.profile.editprofile');
    }

    public function update_profile($id, Request $request){
        
        $validated = $request->validate([
            "fname" => ['required', 'min:4'],
            // "mname" => ['min:4'],
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
                  
                  if($request->input('password') == $request->input('password_confirmation')){
                        $validated = $request->validate([
                              "password" => ['required'],
                          ], [
                              "password.required" => "New password is required",
                          ] );
                        $encrypt = bcrypt($request->input('password'));
                        $user->password = $encrypt;
                  }else{
                        return redirect()->back()->with('error', 'The password did not match.');
                  }
            }else{
                  return redirect()->back()->with('error', 'The password did not match with the current password.');
            }
        }
       
        $user->save();
        return redirect('/patient/profile')->with('message', 'updated successfully');
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

            return view('patient.billing.billing_payment')->with('info', $billinginfo);

    }

    public function store_payment(Request $request){

        $request->validate([
            "reference_no" => ['required'],
        ], [
            'reference_no.required' => 'Reference no is required'
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
            $appointment->mode_of_payment = "Gcash";
            $appointment->reference_no = $input['reference_no'] ;
            $appointment->status = 'pending';
            $appointment->save();

            //send email to admin

            return redirect('patient/homepage')->with('success', 'Created Successfully, Please wait for the confirmation that will in your email');
    }

    public function cancel_appointment($id){
        $appointment = Appointment::where('id', $id)->update(['status' => 'cancel',]);
        return response()->json($appointment);
    }

    public function document_view($id){
        $document = Consultationfile::where('id', $id)->first();

        return response()->json(['document' => $document]);

    }
}
