<?php

namespace App\Http\Controllers\system_settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\system_settings\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    protected $profileService;

    public function __construct(ProfileService $profileService){
        $this->profileService = $profileService;
    }
    public function profile_index(){
        return view('profile.index');
      
    }

    public function changepassword_index(){
        return view('profile.changepass');
    }

    public function profile_edit(){  
        return view('profile.edit');
    }

    public function profile_update(UpdateProfileRequest $request){

        $this->profileService->update_profile($request->validated());
        
        if(Auth::user()->usertype === "admin"){
            return redirect('/admin/myprofile')->with('success', 'Updated successfully');
        }else{
            return redirect('/secretary/myprofile')->with('success', 'Updated successfully');
        }
    }

    public function password_update(Request $request){

        $input = $request->all();
                
        if(password_verify($input['oldpassword'], Auth::user()->password)){
            $validated = $request->validate([
                "password" => 'required|confirmed|min:8',
            ],[
                'password.required' => 'Password is required',
                'password.confirmed' => 'Password did not match',
            ]);

            $this->profileService->update_password($request->only('password'));

            return redirect()->back()->with('success', 'Updated successfully')->withInput();
                
        }else{
            return redirect()->back()->with('oldpassword', 'The password did not match with the current password.')->withInput();
        }

    }

    public function profile_pic(Request $request){
        $validated = $request->validate([
            "profilepic" => 'required|mimes:png,jpg,jpeg',

        ],[
            "profilepic" =>'The picture must be a file of type: png, jpg, jpeg.'
        ]);

        $this->profileService->update_profilepic($request->only('profilepic'));

        if(Auth::user()->usertype === "admin"){
            return redirect('/admin/myprofile');
        }else{
            return redirect('/secretary/myprofile');
        }
    }

}
