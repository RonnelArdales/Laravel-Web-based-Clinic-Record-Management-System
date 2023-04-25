<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile(){
        
        if(Auth::user()->usertype == 'admin'){

            $patients = DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            $secretaries = DB::table('users')->where('usertype', 'secretary')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
            $admins = DB::table('users')->where('usertype', 'admin')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin'); 
            return view('admin.profile', compact('patients', 'secretaries', 'admins'));

        }else{

            $patients = DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            $secretaries = DB::table('users')->where('usertype', 'secretary')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
            $admins = DB::table('users')->where('usertype', 'admin')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin'); 
            return view('secretary.profile', compact('patients', 'secretaries', 'admins'));

        }

    }

    public function store_user(Request $request){

        if(Auth::user()->usertype == 'admin'){

            $validator = Validator::make($request->all(), [
                  "first_name" => ['required'],
                  "mname" => [''],
                  "last_name" => ['required',],
                  "birthday" => ['required'],
                  "age" => ['required'],
                  "address" => ['required'],
                  "gender" => ['required'],
                  "mobile_number" =>'required|numeric',
                  "email" => ['required', 'email', Rule::unique('users', 'email') ],
                  "username" => ['required', 'regex:/\w*$/', 'min:8', Rule::unique('users', 'username')],
                  "password" => 'required|confirmed|min:8',
                  "usertype" => ['required'],
                  "status" => ['required'],
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
                  'usertype.required' => 'Usertype is required',
                  'status.required' => 'status is required',
                ]);
      
              if($validator->fails())
              {
                  return response()->json([
                      'status'=>400,
                      'errors'=> $validator->messages(),
                  ]);
              }else{
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
                  $user->status = $request->input('status');
                  $user->usertype = $request->input('usertype');
                  $user->save();
      
                  $audit_trail = new AuditTrail();
                  $audit_trail->user_id = Auth::user()->id;
                  $audit_trail->username = Auth::user()->username;
                  $audit_trail->activity = 'Create new account ';
                  $audit_trail->usertype = Auth::user()->usertype;
      
              $audit_trail->save();
                  return response()->json([
                      'status'=>200,
                      'message' => 'audit trail',
                  ]);
              }

        }else{



            $validator = Validator::make($request->all(), [
                "first_name" => ['required'],
                "mname" => [''],
                "last_name" => ['required',],
                "birthday" => ['required'],
                "address" => ['required'],
                "age" => ['required'],
                "gender" => ['required'],
                "mobile_number" =>'required|numeric',
                "email" => ['required', 'email', Rule::unique('users', 'email') ],
                "username" => ['required', 'regex:/\w*$/', 'min:8', Rule::unique('users', 'username')],
                "password" => 'required|confirmed|min:8',
                "status" => ['required'],
            ],[
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'birthday.required' => 'Birthday is required',
                'address.required' => 'Address is required',
                'gender.required' => 'gender is required',
                'age.required' => ' Age is required',
                'mobile_number.required' => 'Mobile number is required',
                'email.required' => ' Email is required',
                'username.required' => 'Username name is required',
                'password.required' => 'Password is required',
                'password.confirmed' => 'Password did not match',
                'status.required' => 'status is required',
              ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'errors'=> $validator->messages(),
                ]);
            }else{
         
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
                $user->status = $request->input('status');
                $user->usertype = "patient";
                $user->save();
    
                $audit_trail = new AuditTrail();
                $audit_trail->user_id = Auth::user()->id;
                $audit_trail->username = Auth::user()->username;
                $audit_trail->activity = 'Create new account ';
                $audit_trail->usertype = Auth::user()->usertype;
    
                $audit_trail->save();
                
                return response()->json([
                    'status'=>200,
                    'message' => 'audit trail',
                ]);
            }



        }

     
      
    }

    public function update_user($id, Request $request){

        
        if(Auth::user()->usertype == 'admin'){
            $validator = Validator::make($request->all(), [
                  "first_name" => ['required'],
                  "last_name" => ['required'],
                  "birthday" => ['required'],
                  "age" => ['required'],
                  "address" => ['required'],
                  "gender" => ['required'],
                  "mobile_number" => ['required', 'min:4'],
                  "email" => ['required', 'email' ],
                  "password" => ['confirmed'],
                  "usertype" => ['required'],
                  "status" => ['required'],
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
                  'password.confirmed' => 'Password did not match',
                  'usertype.required' => 'Usertype is required',
                  'status.required' => 'status is required',
                ]);
      
              if($validator->fails())
              {
                  return response()->json([
                      'status'=>400,
                      'errors'=> $validator->messages(),
                  ]);
              }else
              {
                  if($request->input('password') == null){
                      $arrItem = array(
                          'fname' =>$request->get('first_name'),
                          'mname' => $request->get('mname'),
                          'lname' => $request->get('last_name'),
                          'birthday' => $request->get('birthday'),
                          'age' => $request->get('age'),
                          'address' => $request->get('address'),
                          'gender' => $request->get('gender'),
                          'mobileno' => $request->get('mobile_number'),
                          'email' => $request->get('email'),
                          'usertype' => $request->get('usertype'),
                          'status' => $request->get('status'),
                      );
                      DB::table('users')->where('id', $id)->update($arrItem);
                      return response()->json([
                          'status'=>200,
                              'message' => 'discount updated successfully without updated password',
                          
                      ]);
      
                  }else{
                       $encrypt = bcrypt($request->input('password'));
                          $arrItem = array(
                              'fname' =>$request->get('first_name'),
                              'mname' => $request->get('mname'),
                              'lname' => $request->get('last_name'),
                              'birthday' => $request->get('birthday'),
                              'age' => $request->get('age'),
                              'address' => $request->get('address'),
                              'gender' => $request->get('gender'),
                              'mobileno' => $request->get('mobile_number'),
                              'email' => $request->get('email'),
                              'password' => $encrypt,
                              'usertype' => $request->get('usertype'),
                              'status' => $request->get('status'),
                          );
                          DB::table('users')->where('id', $id)->update($arrItem);
                          return response()->json([
                              'status'=>200,
                              'message' => 'discount updated successfully with  updated password',
                              
                          ]);
                     
                  }
              }

        }else{

            $validator = Validator::make($request->all(), [
                "first_name" => ['required'],
                "last_name" => ['required'],
                "birthday" => ['required'],
                "age" => ['required'],
                "address" => ['required'],
                "gender" => ['required'],
                "mobile_number" => ['required', 'min:4'],
                "email" => ['required', 'email' ],
                "password" => ['confirmed'],
                "usertype" => ['required'],
                "status" => ['required'],
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
                'password.confirmed' => 'Password did not match',
                'usertype.required' => 'Usertype is required',
                'status.required' => 'status is required',
              ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'errors'=> $validator->messages(),
                ]);
            }else
            {
                if($request->input('password') == null){
                    $arrItem = array(
                        'fname' =>$request->get('first_name'),
                        'mname' => $request->get('mname'),
                        'lname' => $request->get('last_name'),
                        'birthday' => $request->get('birthday'),
                        'age' => $request->get('age'),
                        'address' => $request->get('address'),
                        'gender' => $request->get('gender'),
                        'mobileno' => $request->get('mobile_number'),
                        'email' => $request->get('email'),
                        'usertype' => $request->get('usertype'),
                        'status' => $request->get('status'),
                    );
                    DB::table('users')->where('id', $id)->update($arrItem);
                    return response()->json([
                        'status'=>200,
                            'message' => 'discount updated successfully without updated password',
                        
                    ]);
    
                }else{
                     $encrypt = bcrypt($request->input('password'));
                        $arrItem = array(
                            'fname' =>$request->get('first_name'),
                            'mname' => $request->get('mname'),
                            'lname' => $request->get('last_name'),
                            'birthday' => $request->get('birthday'),
                            'age' => $request->get('age'),
                            'address' => $request->get('address'),
                            'gender' => $request->get('gender'),
                            'mobileno' => $request->get('mobile_number'),
                            'email' => $request->get('email'),
                            'password' => $encrypt,
                            'usertype' => $request->get('usertype'),
                            'status' => $request->get('status'),
                        );
                        DB::table('users')->where('id', $id)->update($arrItem);
                        return response()->json([
                            'status'=>200,
                            'message' => 'discount updated successfully with  updated password',
                            
                        ]);
                   
                }
            }
            
        }
      
    }

    //delete user 
    public function delete_user($id)
    {

        
        if(Auth::user()->usertype == 'admin'){

            DB::table('users')->where('id', $id)->delete();
            return response()->json([
                'status'=>200,
                    'message' => 'deleted successfully',
            ]);

        }else{

            DB::table('users')->where('id', $id)->delete();
            return response()->json([
                'status'=>200,
                    'message' => 'deleted successfully',
            ]);
            
        }
   
    }


    //show user data in edit page
    public function edit_user($id){

        
        if(Auth::user()->usertype == 'admin'){

            $user = User::where('id', $id )->get();
            if($user){
             return response()->json([
                 'status'=>200,
                 'user' => $user,
             ]);
            }else{
             return response()->json([
                 'status'=>404,
                 'message' => 'user not found',
             ]);
            }

        }else{

            
            $user = User::where('id', $id )->get();
            if($user){
             return response()->json([
                 'status'=>200,
                 'user' => $user,
             ]);
            }else{
             return response()->json([
                 'status'=>404,
                 'message' => 'user not found',
             ]);
            }
            
        }


       
    }

    public function profile_paginate(Request $request){

        
        if(Auth::user()->usertype == 'admin'){

            $usertype = $request->input('usertypetable');
            $patients = DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            $secretaries = DB::table('users')->where('usertype', 'secretary')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
            $admins = DB::table('users')->where('usertype', 'admin')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin');
            
            if($usertype == "patient"){
                return view('pagination.pagination_patient', compact('patients'))->render();
            }elseif ($usertype == "secretary") {
                return view('pagination.pagination_secretary', compact('secretaries'))->render();
            }else{
                return view('pagination.pagination_admin', compact('admins' ))->render();
            }

        }else{
            
        }
  
       
    }
}
