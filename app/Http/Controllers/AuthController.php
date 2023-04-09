<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use App\Mail\SendOtp;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function verifyemail(){
        return view('auth.verify');
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
       $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();

       if($emailverify){
            if($emailverify->expire_at > Carbon::now()){
                User::where('id', Auth::user()->id)->update([
                    'status' => 'active',
                ]);
                if(Auth::user()->usertype == 'active'){
                    return redirect('admin/dashboard');
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


    //    if($emailverify->expire_at > Carbon::now()){
    //     return redirect('/resetpage');
    // }else{
    //   
    // }
    }

    public function confirm_email(Request $request){
       
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email','=', $request->input('email'))->first(); 
        if ($user) {
            auth()->login($user);
             $otp = rand(10, 99999);
             $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'verifycode' => $otp,
                'expire_at' =>$time,
             ]);
             Mail::to('ronnelardales2192@gmail.com')->send(new SendOtp($otp));
             
             return redirect('/verifycode');
        }
        return redirect()->back()->with('error', 'Email not found' );
      
        }

    public function show_verifycode(){
        return view('auth.passwords.confirm');
    }

    public function resend_code(){
        $user = User::where('email','=', Auth::user()->email)->first(); 
        if ($user) {
             $otp = rand(10, 99999);
             $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'verifycode' => $otp,
                'expire_at' =>$time,
             ]);
             Mail::to('ronnelardales2192@gmail.com')->send(new SendOtp($otp));
             
             return redirect()->back();
        }
        return redirect()->back()->with('error', 'Email not send, please try again' );
        // return view('auth.passwords.confirm');
        
    }

    public function reset_password(Request $request){
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

        // return view('auth.passwords.reset');
    }

    public function update_password(Request $request){
        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:6'],
        ], [
            'new_password.required' => 'Password is required',
            'new_password.min' => 'Password is minimun of 6 characters',
        ]);
                if($request->input('new_password') == $request->input('password_confirmation')){
                    $password = bcrypt($validated['new_password']);
                    User::where('id', Auth::user()->id)->update([
                        'password' => $password,
                    ]);
                    if(Auth::check()){
                        if(Auth::user()->usertype == 'admin'){
                            return redirect('admin/dashboard');
                          }elseif(Auth::user()->usertype == 'patient'){
                            return redirect('patient/homepage');
                          }else{
                            return redirect('secretary/dashboard');
                          }
                    }
                }else{
                    return redirect()->back()->with('error', 'Password mismatch');
                }
    
    }
    public function show_reset(){
        return view('auth.passwords.reset');
    }

}
