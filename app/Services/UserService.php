<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class UserService {

    public function getPatients(){
        $patients = DB::table('users')->where('usertype', 'patient')->whereNotIn('status', ['pending'])->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
        return $patients;
    }

    public function getSecretaries(){
        $secretaries = DB::table('users')->where('usertype', 'secretary')->whereNotIn('status', ['pending'])->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
        return $secretaries;
    }

    public function getAdmins(){
      $admins =     $admins = DB::table('users')->where('usertype', 'admin')->whereNot('status', 'pending')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin');
      return $admins; 
    }

    public function store(array $data){
        
        $user = ['fname' => $data['first_name'],
            'mname' => $data['mname'],
            'lname' => $data['last_name'],
            'birthday' => $data['birthday'],
            'age' => $data['age'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'mobileno' => $data['mobile_number'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
            'emailstatus' => 'unverified',
        ];

        if (Auth::user()->usertype === "admin"){
            $user['usertype'] = $data['usertype'];
        }else{
            $user['usertype'] = "patient";
        }

        User::create($user);

        (new AuditTrailService())->store("Create User");
    }


    public function   update($User,$request){

        $data = ['fname' =>$request['first_name'],
        'mname' => $request['mname'],
        'lname' => $request['last_name'], 
        'birthday' => $request['birthday'], 
        'age' => $request['age'],
        'address' => $request['address'],
        'gender' => $request['gender'],
        'mobileno' => $request['mobile_number'], 
        'email' => $request['email'], 
        'status' => $request['status'],
        ];

        if(Auth::user()->usertype == 'admin'){
            $data['usertype'] = $request['usertype'];
            if($request['password'] !== null ){
                $encrypt =  bcrypt($request['password']);

                $data['password'] = $encrypt;
            }
        }

        $User->update($data);
        
        (new AuditTrailService())->store('Update User');

        return $data;

    }

    public function fetchUser($data){
        $data =  User::where('usertype', 'patient')->where('status', 'verified')->latest('created_at')->get();;

        if (!empty($data['search.value'])){
            $searchValue = $data['search.value'];
            $data->where(function ($query) use ($searchValue) {
                $query->where('fname', 'like', '%' . $searchValue . '%')
                      ->orWhere('lname', 'like', '%' . $searchValue . '%');
            });
        }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('fullname', function($row){
                        $fullname = $row->fname . " " . $row->lname;
                            return $fullname;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn btn-sm btn-danger" id="select"  data-id="' . $row->id . '">Select</button>';         
                            return $btn;
                    })
                    ->rawColumns(['action', 'fullname'])
                    ->make(true);
    }

}