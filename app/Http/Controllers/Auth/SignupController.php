<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreSignupRequest;
use App\Mail\SendVerifycode;
use App\Models\EmailOtp;
use App\Models\User;
use App\Services\AuditTrailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class SignupController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(StoreSignupRequest $request){

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
        $user->emailstatus = "unverified"; 
        $user->save();

        (new AuditTrailService())->store_unverified($user, "Create an Account");

        auth()->login($user);
        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);
        EmailOtp::create([
        'email' =>  Auth::user()->email,
        'verifycode' => $otp,
        'expire_at' => $time ,
                ]); 
        Mail::to(Auth::user()->email)->send(new SendVerifycode($otp));
        
        return redirect('/verify-email-auth');
    }

    public function verifyemail($email){
        return view('auth.verify')->with('email', $email);
    }

    
    public function resend_code_create($email){

        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);
        EmailOtp::create([
        'email' => $email,
        'verifycode' => $otp,
        'expire_at' =>$time,
        ]);
        Mail::to($email)->send(new SendVerifycode($otp));
        
        return redirect()->back();
        
    }

    public function emailverifycode(Request $request, $email){

        $validated = $request->validate([
            'code' => ['required'],
        ],[
            'code.required' => 'Verification code is required',
        ]);

        if(Auth::check()){
            $emailverify = EmailOtp::where('email', Auth::user()->email)->where('verifycode' ,  $request->only('code')) ->first();

            if(!$emailverify){
                return redirect()->back()->with('error', 'Incorrect verification code' );
            }

            if($emailverify->expire_at < Carbon::now()){
                return redirect()->back()->with('error', 'Verification code has expired ' );
            }

            $user = User::where('id', Auth::user()->id)->first();
            $user->emailstatus = 'verified';
            $user->save();

            switch (Auth::user()->usertype){
                case "admin":
                    return redirect('admin/dashboard');
                    break;
                case "secretary":
                    return redirect('secretary/dashboard');
                    break;
                case "patient":
                    if(Auth::user()->status == 'pending'){
                        return redirect('patient/homepage')->with('success', 'Your account is successfully created, wait for the administrator approval to used the full function of the system. Please check back later' );
                        break;
                    }
                    return redirect('patient/homepage');
                    break;
                default:
                    abort(401);
            }
        }
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
}
