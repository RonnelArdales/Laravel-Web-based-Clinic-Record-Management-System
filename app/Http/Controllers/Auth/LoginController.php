<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Mail\SendVerifycode;
use App\Models\EmailOtp;
use App\Models\User;
use App\Services\AuditTrailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function process(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'email is required',
            'password.required' => 'password is required',
        ])->stopOnFirstFailure(true);

        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();

        }else{  

            $email = $request->input('email');
            $password = $request->input('password');
            $user = User::where('email','=', $email)->first();

            if($user){
                if(Hash::check($request->password, $user->password)){

                    if($user->status == 'inactive'){
                        return  redirect()->back()->with('error', 'Your account has been inactive, please contact the admin');
                    }else {
                        if($user->emailstatus == 'unverified'){
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
                        }else{
                            auth()->login($user);
                            
                            (new AuditTrailService())->store("Login");

                            if($user->usertype == 'admin'){
                            return redirect('admin/dashboard');
                            }elseif($user->usertype == 'patient'){

                             // Alert::success('success Title', 'Success Message');

                           return redirect('patient/homepage');
                           }else{
                                return redirect('secretary/dashboard');
                           }
                        }
                    }
                }else{
                    return redirect()->back()->withInput()->with('error', 'Password not matches' );
                }
            }else{
                return redirect()->back()->withInput()->with('error', 'The email is not registered' );
            }
        }
    }
    
}
