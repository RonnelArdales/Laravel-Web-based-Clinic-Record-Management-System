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
      $encrypt = bcrypt($request->input('password'));
      $user = new User();
            $user->fname = $request->input('first_name');
            $user->mname = $request->input('mname');
            $user->lname = $request->input('last_name');
            $user->birthday = $request->input('birthday');
            $user->address = $request->input('address');
            $user->gender = $request->input('gender');
            $user->mobileno = $request->input('mobile_number');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = $encrypt;
            $user->usertype = 'patient'; //usertype
            $user->save();
             return redirect('/login');
        // $userauth = User::where('email','=', $request->input('email'))->first(); 
        // auth()->login($userauth);
        // $otp = rand(10, 99999);
        //      EmailOtp::create([
        //         'user_id' => Auth::user()->id,
        //         'email' =>  Auth::user()->email,
        //         'verifycode' => $otp,
        //      ]);
        //      Mail::to(Auth::user()->email)->send(new SendVerifycode($otp));
        // return redirect('/verify-email');
    }
}
