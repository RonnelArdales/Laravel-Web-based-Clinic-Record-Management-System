<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class User_ProfileService{

    public function update($request, $id){
        $data = [  "fname" => $request['fname'],
                    "mname" => $request['mname'],
                    "lname" => $request['lname'],
                    "birthday" => $request['birthday'],
                    "address" => $request['address'],
                    "gender" => $request['gender'],
                    "mobileno" =>$request['mobileno'],
                    "email" => $request['email'], 
                ];
        if($request["password"] !== null){
            $encrypt = bcrypt($request["password"]);
            $data['password'] = $encrypt;
        }

        User::where('id', Auth::user()->id)->update($data);

    }
}