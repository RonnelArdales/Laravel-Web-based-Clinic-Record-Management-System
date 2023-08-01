<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){

        $patients = $this->userService->getPatients();
        $secretaries = $this->userService->getSecretaries();
        $admins = $this->userService->getAdmins();

        if (Auth::user()->usertype === 'admin') {
            return view('admin.user', compact('patients', 'secretaries', 'admins'));
        } else {
            $patients = DB::table('users')->where('usertype', 'patient')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            return view('secretary.user', compact('patients'));
        }
    }


    public function store(Request $request){

        $storeUserRequest = new StoreUserRequest();

        $validator = Validator::make($request->all(), $storeUserRequest->rules(), $storeUserRequest->messages());
        
            if($validator->fails()){
                return response()->json([
                    'status'=>400,
                    'errors'=> $validator->messages(),
                ]);
            }else{

                $this->userService->store($request->all());
        
                return response()->json([
                    'status'=>200,
             
                ]);
            }
    }

    public function edit(User $user){
     
        return response()->json([
            'status'=>200,
            'user' => $user->toArray(),
        ]); 
     
    }

    public function update( Request $request, User $user){
        
        $UpdateUserRequest = new UpdateUserRequest();

        $validator = Validator::make($request->all(), $UpdateUserRequest->rules($user), $UpdateUserRequest->messages());

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

           if ($request->input('password') !== null) {
                $validator = Validator::make($request->all(), [
                    'password' => [ 'min:8']
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status'=>400,
                        'errors'=>$validator->messages(),
                    ]);
                }
            }

            $this->userService->update($user, $request);
    
            return response()->json([
                'status'=>200,
            ]);
        }
   
    }

    public function profile_paginate(Request $request){
        
        if(Auth::user()->usertype == 'admin'){

            $usertype = $request->input('usertypetable');
            $patients = DB::table('users')->where('usertype', 'patient')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            $secretaries = DB::table('users')->where('usertype', 'secretary')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
            $admins = DB::table('users')->where('usertype', 'admin')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin');
            
            if($usertype == "patient"){
                return view('pagination.pagination_patient', compact('patients'))->render();
            }elseif ($usertype == "secretary") {
                return view('pagination.pagination_secretary', compact('secretaries'))->render();
            }else{
                return view('pagination.pagination_admin', compact('admins' ))->render();
            }

        }else{

            $patients = DB::table('users')->where('usertype', 'patient')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
            return view('pagination.pagination_patient', compact('patients'))->render();
        }
    }

    public function getUser(User $user){
        return response()->json([
            'users' => $user,
            'fullname' => $user->fname . ' ' . $user->lname,
        ]);
    }

    public function fetch_user(Request $request){

        if ($request->ajax()) {
            return (new UserService())->fetchUser($request->all());
        }
    }   

}
