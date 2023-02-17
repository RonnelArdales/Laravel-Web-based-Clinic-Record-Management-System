<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifycode;
use App\Models\EmailOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ClinicuserController extends Controller {

  //routes
    public function confirmemail(){
      return view('auth.confirmemail');
    }

    public function identify(){
      return view('/');
    }

    //logout function
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');

    }

    //login function   
    public function process(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        //if user is valid then check if verified if not go to verification page if verify check the user type of the user 
          $user = User::where('email','=', $email)->first(); 
          if($user){
            if(Hash::check($request->password, $user->password)){
                      if($user->usertype == 'admin'){
                        auth()->login($user);
                        return redirect('admin/dashboard');
                      }elseif($user->usertype == 'patient'){
                        auth()->login($user);
                        return redirect('patient/homepage');
                      }else{
                        auth()->login($user);
                        return redirect('secretary/dashboard');
                      }
            }else{
              return redirect()->back()->with('error', 'Password not matches' );
            }
          }else{
            return redirect()->back()->with('error', 'The email is not registered' );
          }
      }

    public function store(Request $request)
    {

        $validated = $request->validate([
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "address" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" => ['required'],
            "email" => ['required', 'email' ],
            "username" => ['required'],
            "password" => 'required|confirmed',
            "usertype" => ['min:4'],
  
        ]);

        //hashing of password
        $validated['password'] = bcrypt($validated['password']);
        $validated['usertype'] = 'patient';
        //kunin yung data galing model ("Clinicusers")
        User::create($validated);
        $user = User::where('email','=', $request->input('email'))->first(); 
        auth()->login($user);
        $otp = rand(10, 99999);
             EmailOtp::create([
                'user_id' => Auth::user()->id,
                'email' =>  Auth::user()->email,
                'verifycode' => $otp,
             ]);
             Mail::to(Auth::user()->email)->send(new SendVerifycode($otp));
        return redirect('/verify-email');
        //$email = $request->input('email');
        // return redirect('/verify')->with('email', $email);
        // auth()->login($clinicuser);
    }
}
