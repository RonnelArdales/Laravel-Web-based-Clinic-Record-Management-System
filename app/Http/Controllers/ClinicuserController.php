<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifycode;
use App\Models\AuditTrail;
use App\Models\Consultation;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

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

      $audit_trail = new AuditTrail();
      $audit_trail->user_id = Auth::user()->id;
      $audit_trail->username = Auth::user()->username;
      $audit_trail->activity = 'Logout';
      $audit_trail->usertype = Auth::user()->usertype;
      $audit_trail->save();

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    

        return redirect('/login');

    }

    //login function   
    public function process(Request $request)
    {
      
      $validator = Validator::make($request->all(), [
          // "content" => 'bail|required',
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


                         $audit_trail = new AuditTrail();
                         $audit_trail->user_id = Auth::user()->id;
                         $audit_trail->username = Auth::user()->username;
                         $audit_trail->activity = 'Login';
                         $audit_trail->usertype = Auth::user()->usertype;
                         $audit_trail->save();

                 

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
            "mobile_number" => ['required', Rule::unique('users', 'mobileno') ],
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

          session(['first_name' => $request->input('first_name'),
          'mname' => $request->input('mname'),
          'last_name' => $request->input('last_name'),
          'birthday' => $request->input('birthday'),
          'age' => $request->input('age'),
          'address' => $request->input('address'),
          'gender' => $request->input('gender'),
          'mobile_number' => $request->input('mobile_number'),
          'email' => $request->input('email'),
          'username' => $request->input('username'),
          'password' => $request->input('password'),
          'usertype' => 'patient',
          'status' => 'pending',
          'emailstatus' => "unverified", 
                      ]);

        $otp = rand(10, 99999);
        $time = Carbon::now()->addMinute(5);
             EmailOtp::create([
                'email' =>  $request->input('email'),
                'verifycode' => $otp,
                'expire_at' => $time ,
             ]); 
            Mail::to($request->input('email'))->send(new SendVerifycode($otp));

            return redirect('/verify-email');
    }

}
