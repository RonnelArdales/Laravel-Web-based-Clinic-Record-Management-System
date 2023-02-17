<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function profileshow(){
        $user = Auth::user();
        return view('patient.profile.profile' );
    }

    public function edit_profile(){
        return view('patient.profile.editprofile');
    }

    public function update_profile($id, Request $request){
        $validated = $request->validate([
            "fname" => ['required', 'min:4'],
            "mname" => ['min:4'],
            "lname" => ['required', 'min:4'],
            "birthday" => ['required'],
            "address" => ['required', 'min:4'],
            "address" => ['required', 'min:4'],
            "gender" => ['required'],
            "mobileno" => ['required', 'min:4'],
            "email" => ['required', 'email' ],
        ]);
    

        $update = User::where('id', $id)->update($validated);
        if($update){
            return redirect('/patient/profile')->with('message', 'updated successfully');
        }else{
            return 'updated successfully';
        }
        
    }
}
