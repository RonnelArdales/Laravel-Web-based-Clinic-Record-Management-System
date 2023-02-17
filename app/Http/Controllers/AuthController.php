<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use App\Mail\SendOtp;
use App\Models\EmailOtp;
use App\Models\User;
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
        ]);
       $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();
       if($emailverify){
        if(Auth::user()->usertype == 'admin'){
            return redirect('admin/dashboard');
          }elseif(Auth::user()->usertype == 'patient'){
            return redirect('patient/homepage');
          }else{
            return redirect('secretary/dashboard');
          }
       }else{
        return redirect()->back()->with('error', 'Incorrect code' );
       }
    }

    public function confirm_email(Request $request){
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);
        $user = User::where('email','=', $request->input('email'))->first(); 
        if ($user) {
            auth()->login($user);
             $otp = rand(10, 99999);
             EmailOtp::create([
                'user_id' => Auth::user()->id,
                'email' => Auth::user()->email,
                'verifycode' => $otp,
             ]);
             Mail::to('ronnelardales2192@gmail.com')->send(new SendOtp($otp));
             
             return redirect('/verifycode');
        }
        return redirect()->back()->with('error', 'Email not found' );
        // return view('auth.passwords.confirm');
        }

    public function show_verifycode(){
        return view('auth.passwords.confirm');
    }

    public function reset_password(Request $request){
        $validated = $request->validate([
            'code' => ['required'],
        ]);
       $emailverify = EmailOtp::where('email', '=',  Auth::user()->email)->where('verifycode' , '=', $request->input('code')) ->first();
       if($emailverify){
        return redirect('/resetpage');
       }else{
        return redirect()->back()->with('error', 'Incorrect code' );
       }

        // return view('auth.passwords.reset');
    }

    public function update_password(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6'],
        ]);

        if(password_verify($request->input('current_password'), auth()->user()->password )){
                if($request->input('new_password') == $request->input('password_confirmation')){
                    $email = bcrypt($validated['new_password']);
                    User::where('id', Auth::user()->id)->update([
                        'password' => $email,
                    ]);
                    auth()->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('login');
                }else{
                    return redirect()->back()->with('error', 'Password mismatch');
                }
        }else{
            return redirect()->back()->with('error', 'The password did not match with the current password.');
        }
    }

    public function show_reset(){
        return view('auth.passwords.reset');
    }

}
