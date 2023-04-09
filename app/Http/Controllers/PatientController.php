<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Guestpage;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;


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
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        $appointments = Appointment::Where('user_id', Auth::user()->id )->get();
        return view('patient.profile.profile', compact('transactions', 'appointments'));
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
        ]);
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
        return view('patient.billing.billing');
    }
    public function index_payment(Request $request){   
     
            $input = $request->all();
            $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
            $date = Carbon::createFromFormat('m-d-Y', $input['date'])->format('Y-m-d');
            $billin_no = Billing::max('billing_no') + 1;
         
            // $appointment = new Appointment();
            // $appointment->user_id = Auth::user()->id;
            // $appointment->fullname = Auth::user()->fname . " " . Auth::user()->lname;
            // $appointment->gender = Auth::user()->gender;
            // $appointment->service = $input['service'];
            // $appointment->date = $input['date'];
            // $appointment->time = $time;
            // $appointment->price = $input['price'];
            // $appointment->status = 'Pending';
            // $appointment->save();
            
            // $billing = new Billing();
            // $billing->billing_no = $billin_no;
            // // $billing->appointment_no = $appointment->id;
            // $billing->user_id = Auth::user()->id;
            // $billing->fullname = Auth::user()->fname . " " . Auth::user()->lname;
            // $billing->appointment_date = $date . " " . $time;
            // $billing->servicecode = $input['service_code'];
            // $billing->service = $input['service'];
            // $billing->price = $input['price'];
            // $billing->sub_total = $input['price'];
            // $billing->discount = $input['discount'];
            // $billing->total =  $input['total_price'];
            // $billing->mode_of_payment = $input['mode_of_payment'];
            // $billing->status = 'Not Paid';
            // $billing->save();
            // $billing->reference_no
            // $billing->payment
            // $billing->change
            // $billing->status
    
            $billinginfo = array('billing_no' => $billin_no,
                                'fullname' => Auth::user()->fname . " " . Auth::user()->lname,
                                'modeofpayment' => $request->input('mode_of_payment'),
                                'servicecode' => $request->input('service_code'),
                                'service' => $request->input('service'),
                                'price' => $request->input('price'),
                                'discount' => $request->input('discount'),
                                'total' => $request->input('total_price'),
                                'date' => $request->input('date'),
                                'time' => $request->input('time'),
                            );

            if($input['mode_of_payment'] == "gcash"){
                return view('patient.billing.billing_payment')->with('info', $billinginfo);
            }else{
                $appointment = new Appointment();
                $appointment->user_id = Auth::user()->id;
                $appointment->fullname = Auth::user()->fname . " " . Auth::user()->lname;
                $appointment->gender = Auth::user()->gender;
                $appointment->service = $input['service'];
                $appointment->date = $input['date'];
                $appointment->time = $time;
                $appointment->mode_of_payment = $input['mode_of_payment'];
                $appointment->price = $input['price'];
                $appointment->status = 'Pending';
                $appointment->save();
                //send notification to admin

                return redirect('patient/homepage')->with('message', 'Created Successfully, Please wait for the confirmation that will in your email');
            } 
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
        $billin_no = Billing::max('billing_no') + 1;
            $appointment = new Appointment();
            $appointment->user_id = Auth::user()->id;
            $appointment->fullname = Auth::user()->fname . " " . Auth::user()->lname;
            $appointment->gender = Auth::user()->gender;
            $appointment->service = $input['service'];
            $appointment->date = $input['date'];
            $appointment->time = $time;
            $appointment->price = $input['price'];
            $appointment->mode_of_payment = $input['mop'];
            $appointment->status = 'Pending';
            // $appointment->save();

            $billing = new Billing();
            $billing->billing_no = $billin_no;
            $billing->appointment_no = $appointment->id;
            $billing->user_id = Auth::user()->id;
            $billing->fullname = Auth::user()->fname . " " . Auth::user()->lname;
            $billing->appointment_date = $date . " " . $time;
            $billing->servicecode = $input['service_code'];
            $billing->service = $input['service'];
            $billing->price = $input['price'];
            $billing->sub_total = $input['price'];
            $billing->discount = $input['discount'];
            $billing->total =  $input['total'];
            $billing->mode_of_payment = $input['mop'];
            $billing->reference_no = $input['reference_no'];
            $billing->status = 'Paid';
            // $billing->save();

            //send email to admin

            return redirect('patient/homepage')->with('success', 'Created Successfully, Please wait for the confirmation that will in your email');
    }

    public function cancel_appointment($id){
        $appointment = Appointment::where('id', $id)->update(['status' => 'Cancelled',]);
        return response()->json($appointment);
    }
}
