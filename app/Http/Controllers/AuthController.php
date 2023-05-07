<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use App\Mail\SendOtp;
use App\Mail\SendVerifycode;
use App\Models\AuditTrail;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;
use Twilio\Rest\Client;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function verifyemail(){
        return view('auth.verify');
      
    }

    public function verifyemail_auth(){
        return view('auth.verifyauth');
    }

    public function resendcode_verify(){
        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);
        EmailOtp::create([
           'email' => Auth::user()->email,
           'verifycode' => $otp,
           'expire_at' =>$time,
        ]);
        Mail::to(Auth::user()->email)->send(new SendVerifycode($otp));
        
        return redirect()->back();
    }

    public function identify_email(){
        return view('auth.identify');
    }

    public function emailverifycode(Request $request){

   
        $validated = $request->validate([
            'code' => ['required'],
        ],[
            'code.required' => 'Verification code is required',
        ]);

        if(Auth::check()){
            $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();

            if($emailverify){
                if($emailverify->expire_at > Carbon::now()){
        
                $user = User::where('id', Auth::user()->id)->first();
                        $user->emailstatus = 'verified';
                        $user->save();
                        if(Auth::user()->usertype == 'admin'){
                            return redirect('admin/dashboard')  ;
                          }elseif(Auth::user()->usertype == 'patient'){
                            return redirect('patient/homepage');
                          }else{
                            return redirect('secretary/dashboard');
                          }  
                }else{
                    return redirect()->back()->with('error', 'Verification code has expired ' );
                }
               }else{
                return redirect()->back()->with('error', 'Incorrect verification code' );
               }

        }else{
            $emailverify = EmailOtp::where('email', '=',  $request->email)->where('verifycode' , '=', $request->input('code')) ->first();

            if($emailverify){
                if($emailverify->expire_at > Carbon::now()){
        
                    $encrypt = bcrypt($request->input('password'));
                    $user = new User();
                    $user->fname = $request->input('first_name');
                    $user->mname = $request->input('mname');
                    $user->lname = $request->input('last_name');
                    $user->birthday = $request->input('birthday');
                    $user->age = $request->input('age');
                    $user->address = $request->input('address');
                    $user->gender = $request->input('gender');
                    $user->mobileno = $request->input('mobile_number');
                    $user->email = $request->input('email');
                    $user->username = $request->input('username');
                    $user->password = $encrypt;
                    $user->usertype = 'patient'; //usertype
                    $user->status = "pending";
                    $user->emailstatus = "verified"; 
                    $user->save();

                    $userauth = User::where('email','=', $request->input('email'))->first(); 
                    auth()->login($userauth);

                    $audit_trail = new AuditTrail();
                    $audit_trail->user_id = Auth::user()->id;
                    $audit_trail->username = Auth::user()->username;
                    $audit_trail->activity = 'Created an account';
                    $audit_trail->usertype = Auth::user()->usertype;
                    $audit_trail->save();

          


                if(Auth::user()->usertype == 'admin'){
                return redirect('admin/dashboard');
              }elseif(Auth::user()->usertype == 'patient'){
                // Alert::success('Created Successfully', 'Your account is successfully created, wait for the administrator approval to used the full function of the system. Please check back later');
                return redirect('patient/homepage')->with('success', 'Your account is successfully created, wait for the administrator approval to used the full function of the system. Please check back later' );
              }else{
                return redirect('secretary/dashboard');
              }
                }else{
                    return redirect()->back()->with('error', 'Verification code has expired ' );
                }
               }else{
                return redirect()->back()->with('error', 'Incorrect verification code' );
               }
   
         
        }


    }

    public function confirm_email(Request $request){
       
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email','=', $request->input('email'))->first(); 
        if ($user) {
            auth()->login($user);
            //  $otp = rand(10, 99999);
            //  $time = Carbon::now()->addMinute(5);
            //  EmailOtp::create([
            //     'email' => $user->email,
            //     'verifycode' => $otp,
            //     'expire_at' =>$time,
            //  ]);
            //  Mail::to($user->email)->send(new SendOtp($otp)); 
            //  return redirect('/verifycode');
                return redirect('/select');
        }
        return redirect()->back()->with('error', 'Email not found' );
      
        }



  public function index_select(){
        return view('auth.passwords.selectcodesender');
    }

    public function select_sendcode(Request $request){
        $user = User::where('email','=', Auth::user()->email)->first(); 

            if ($request->input('email')) {
            $otp = rand(10, 99999);
             $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'email' => $user->email,
                'verifycode' => $otp,
                'expire_at' =>$time,
             ]);
             Mail::to(Auth::user()->email)->send(new SendOtp($otp)); 
             return redirect('/verifycode/email');
            } else {
         
                $otp = rand(10, 99999);
                $time = Carbon::now()->addMinute(5);

                $email_otp = new EmailOtp();
                $email_otp->mobileno =  strval($user->mobileno); 
                $email_otp->verifycode = $otp;
                $email_otp->expire_at = $time;
                $email_otp->save();

                $cleanedNumber = preg_replace('/[^0-9]/', '', Auth::user()->mobileno);

                $formattedNumber = "+" . '63 ' . substr($cleanedNumber, 1, 3) . ' ' . substr($cleanedNumber, 4, 3) . ' ' . substr($cleanedNumber, 7 , 8);
                
                $message = "This an sms verification code to change your password" . " " . $otp;
        
                try {
          
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
          
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($formattedNumber, [
                        'from' => $twilio_number, 
                        'body' => $message]);
          
                        return redirect('/verifycode/sms');
          
                } catch (Exception $e) {
                    dd("Error: ". $e->getMessage());
                }
        
            }
            
         
    }


    public function show_verifycode_email(){
        return view('auth.passwords.confirm');
    }

    public function show_verifycode_sms(){
        return view('auth.passwords.index_sms');
    }

    public function resend_code(){
        $user = User::where('email','=', Auth::user()->email)->first(); 
        if ($user) {
             $otp = rand(10, 99999);
             $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'email' => $user->email,
                'verifycode' => $otp,
                'expire_at' =>$time,
             ]);
             Mail::to($user->email)->send(new SendOtp($otp));
             
             return redirect()->back();
        }
        return redirect()->back()->with('error', 'Email not send, please try again' );
    }

    public function resend_code_sms(){
        $user = User::where('email','=', Auth::user()->email)->first(); 
        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);

        $email_otp = new EmailOtp();
        $email_otp->mobileno =  strval($user->mobileno); 
        $email_otp->verifycode = $otp;
        $email_otp->expire_at = $time;
        $email_otp->save();

        $cleanedNumber = preg_replace('/[^0-9]/', '', Auth::user()->mobileno);

        $formattedNumber = "+" . '63 ' . substr($cleanedNumber, 1, 3) . ' ' . substr($cleanedNumber, 4, 3) . ' ' . substr($cleanedNumber, 7 , 8);
        
        $message = "This an sms verification code to change your password" . " " . $otp;

        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($formattedNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
                return redirect('/verifycode/sms');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }



    }

    public function resend_code_create($email){


        // $user = User::where('email','=', Auth::user()->email)->first(); 
        // if ($user) {
             $otp = rand(10, 99999);
             $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'email' => $email,
                'verifycode' => $otp,
                'expire_at' =>$time,
             ]);
             Mail::to($email)->send(new SendVerifycode($otp));
             
             return redirect()->back();
        // }
        // return redirect()->back()->with('error', 'Email not send, please try again' );
        // return view('auth.passwords.confirm');
        
    }

    public function reset_password(Request $request){

        if($request->input('emailotp')){

            $validated = $request->validate([
                'code' => ['required'],
            ]);
           $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();
         
           if($emailverify){
            if($emailverify->expire_at > Carbon::now()){
                return redirect('/resetpage');
            }else{
                return redirect()->back()->with('error', 'expired code' );
            }
            
           }else{
            return redirect()->back()->with('error', 'Incorrect code' );
           }

        }else{

            $validated = $request->validate([
                'code' => ['required'],
            ]);
           $emailverify = EmailOtp::where('mobileno', '=',  Auth::user()->mobileno)->where('verifycode' , '=', $request->input('code')) ->first();
         
           if($emailverify){
            if($emailverify->expire_at > Carbon::now()){
                return redirect('/resetpage');
            }else{
                return redirect()->back()->with('error', 'expired code' );
            }
            
           }else{
            return redirect()->back()->with('error', 'Incorrect code' );
           }

        }

    }

    public function update_password(Request $request){
        $validated = $request->validate([
            'new_password' => ['required', 'min:8'],
        ], [
            'new_password.required' => 'Password is required',
            'new_password.min' => 'Password is minimun of 8 characters',
        ]);

                    $password = bcrypt($validated['new_password']);
                    User::where('id', Auth::user()->id)->update([
                        'password' => $password,
                    ]);

                    $audit_trail = new AuditTrail();
                    $audit_trail->user_id = Auth::user()->id;
                    $audit_trail->username = Auth::user()->username;
                    $audit_trail->activity = 'Change password';
                    $audit_trail->usertype = Auth::user()->usertype;
                    $audit_trail->save();


                    if(Auth::check()){
                        if(Auth::user()->usertype == 'admin'){
                            return redirect('admin/dashboard');
                          }elseif(Auth::user()->usertype == 'patient'){
                            return redirect('patient/homepage');
                          }else{
                            return redirect('secretary/dashboard');
                          }
                    }
            
    
    }
    public function show_reset(){
        return view('auth.passwords.reset');
    }


    public function sendsms(){

        $receiverNumber = "+63 993 619 4046";
        $message = "hello";

        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }

    }

}
