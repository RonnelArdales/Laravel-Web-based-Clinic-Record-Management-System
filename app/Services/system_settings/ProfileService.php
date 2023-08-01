<?php

namespace App\Services\system_settings;

use App\Models\User;
use App\Services\AuditTrailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileService {
    public function update_profile($request){
        
        $user = User::where('id', Auth::user()->id )->first();
        $user->fname = $request['first_name'];
        $user->mname = $request['mname'];
        $user->lname = $request['last_name'];
        $user->birthday = $request['birthday'];
        $user->address = $request['address'];
        $user->age= $request['age'];
        $user->gender = $request['gender'];
        $user->mobileno = $request['mobileno'];
        $user->email = $request['email'];
        $user->save();

        (new AuditTrailService())->store('Update profile');
    }

    public function update_password($request){

        User::where('id', Auth::user()->id)->update(['password' => bcrypt($request['password'])]);

        (new AuditTrailService())->store('Change password');
    }

    public function update_profilepic($request){

        $path = public_path('profilepic/'.Auth::user()->profile_pic);

        if(File::exists($path)){
            File::delete($path);
        }
        $filename = date('YmdHis'). '.' . $request['profilepic']->getClientOriginalExtension();
        $request['profilepic']->move(public_path('profilepic/'), $filename) ;
        $request['profilepic'] = $filename;

        $user = User::where('id', Auth::user()->id)->update(['profile_pic' => $filename]);
    }
}