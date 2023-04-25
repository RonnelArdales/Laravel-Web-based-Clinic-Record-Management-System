<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifycode;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
      
      $validator = Validator::make($request->all(), [
          // "content" => 'bail|required',
          'email' => 'bail|required',
          'password' => 'bail|required',
          ],[
            'email.required' => 'email is required',
            'password.required' => 'password is required',
              ])->stopOnFirstFailure(true);

          if($validator->fails()){
            return Redirect::back()->withErrors($validator);
          }else{

              $email = $request->input('email');
              $password = $request->input('password');

              $user = User::where('email','=', $email)->first(); 
              if($user){
                if(Hash::check($request->password, $user->password)){
             
                  if($user->status == 'active'){
                    auth()->login($user);
                        if($user->usertype == 'admin'){
                          return redirect('admin/dashboard');
                        }elseif($user->usertype == 'patient'){
                          return redirect('patient/homepage');
                        }else{
                          return redirect('secretary/dashboard');
                        }
                  }elseif($user->status == 'not verified'){
                    auth()->login($user);
                    $otp = rand(10, 99999);
                    $time = Carbon::now()->addMinute(5);
                         EmailOtp::create([
                            'user_id' => Auth::user()->id,
                            'email' =>  Auth::user()->email,
                            'verifycode' => $otp,
                            'expire_at' => $time ,
                         ]); 
                         //create ng bagong user account dahil crypt ng nagamit
                         Mail::to('ronnelardales2192@gmail.com')->send(new SendVerifycode($otp));
                      return redirect('/verify-email');
                  }else{
                    return redirect('/')->with('error', 'Password not matches' );
                  }
                }else{
                  return redirect()->back()->with('error', 'Password not matches' );
                }
              }else{
                return redirect()->back()->with('error', 'The email is not registered' );
              }

          }

      
      }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "age" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" => ['required'],
            "email" => ['required', 'email', Rule::unique('users', 'email') ],
            "username" => ['required', 'regex:/\w*$/', 'min:8', Rule::unique('users', 'username')],
            "password" => 'required|confirmed|min:8',
        ],[
          'first_name.required' => 'First name is required',
          'last_name.required' => 'Last name is required',
          'birthday.required' => 'Birthday is required',
          'age.required' => 'Age is required',
          'address.required' => 'Address is required',
          'gender.required' => 'gender is required',
          'mobile_number.required' => 'Mobile number is required',
          'email.required' => ' Email is required',
          'username.required' => 'Username name is required',
          'password.required' => 'Password is required',
          'password.confirmed' => 'Password did not match',
        ]);

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
            $user->status = "not verified";
            $user->save();
        $userauth = User::where('email','=', $request->input('email'))->first(); 
        auth()->login($userauth);
        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'user_id' => Auth::user()->id,
                'email' =>  Auth::user()->email,
                'verifycode' => $otp,
                'expire_at' => $time ,
             ]); 
             //create ng bagong user account dahil crypt ng nagamit
             Mail::to('ronnelardales2192@gmail.com')->send(new SendVerifycode($otp));
        return redirect('/verify-email');
    }
}
