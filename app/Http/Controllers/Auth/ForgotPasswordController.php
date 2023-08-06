<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use App\Models\EmailOtp;
use App\Models\User;
use App\Services\AuditTrailService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    public function findEmail_index(){
        return view('auth.identify');
    }

    public function confirm_email(Request $request){
        $validated = $request->validate([
            'email' => ['required'],
        ]);

        $user = User::where('email', $request->input('email'))->first(); 

        if ($user) {
            auth()->login($user);
            return redirect('forgot_password/select');
        }

        return redirect('forgot_password/find_email')->with('error', 'Email not found' );
    }

    public function selectSend_index(){
        return view('auth.passwords.selectcodesender');
    }

    public function select_sendcode(Request $request){
        $user = User::where('email', Auth::user()->email)->first(); 
        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);

        if ($request->input('email')) {
            EmailOtp::create([
            'email' => $user->email,
            'verifycode' => $otp,
            'expire_at' =>$time,
            ]);
            Mail::to(Auth::user()->email)->send(new SendOtp($otp)); 
            return redirect('forgot_password/verifycode/email');
        } else {
        
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
                return redirect('forgot_password/verifycode/sms');
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
        $user = User::where('email', Auth::user()->email)->first(); 
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
        $user = User::where('email', Auth::user()->email)->first(); 
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

    public function reset_password(Request $request){

        if($request->input('emailotp')){
            $validated = $request->validate([
                'code' => ['required'],
            ]);
            $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();
            
            if($emailverify){
                if($emailverify->expire_at > Carbon::now()){
                    return redirect('forgot_password/resetpage');
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

    public function reset_index(){
        return view('auth.passwords.reset');
    }

    public function update_password(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password is minimun of 8 characters',
            'password.confirmed' => 'Password did not match',
        ]);

        $password = bcrypt($validated['password']);
        User::where('id', Auth::user()->id)->update([
            'password' => $password,
        ]);

        (new AuditTrailService())->store("Change password");

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
}
