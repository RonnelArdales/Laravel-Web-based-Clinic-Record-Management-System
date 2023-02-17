<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Discount;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{



    // view urls
    public function dashboard(){
            $name= auth()->user()->fname;
            return view('admin.dashboard')->with('name', $name);
    }

    //profile page
    public function profile(){
        return view('admin.profile');
    }

    public function create_user_page(){
        return view('admin.profile.createuser');
    }

    public function store_user(Request $request){

        $validator = Validator::make($request->all(), [
            "first_name" => ['required'],
            "mname" => [''],
            "last_name" => ['required',],
            "birthday" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" =>'required|numeric',
            "email" => ['required', 'email' ],
            "username" => ['required'],
            "password" => 'required|confirmed|',
            "usertype" => ['required'],
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
            $user->fname = $request->input('fname');
            $user->mname = $request->input('mname');
            $user->lname = $request->input('lname');
            $user->birthday = $request->input('birthday');
            $user->address = $request->input('address');
            $user->gender = $request->input('gender');
            $user->mobileno = $request->input('mobileno');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = $encrypt;
            $user->usertype = $request->input('usertype');
            $user->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
      



        //hashing of password
        // $validated['password'] = bcrypt($validated['password']);
        // //kunin yung data galing model ("Clinicusers")
        // User::create($validated);
        // return redirect('/admin/profile');
        //$email = $request->input('email');
        // return redirect('/verify')->with('email', $email);
        // auth()->login($clinicuser);
    }

    public function update_user($id, Request $request){
        
        $validator = Validator::make($request->all(), [
            "first_name" => ['required'],
            "last_name" => ['required'],
            "birthday" => ['required'],
            "address" => ['required'],
            "gender" => ['required'],
            "mobile_number" => ['required', 'min:4'],
            "email" => ['required', 'email' ],
            "password" => 'confirmed|',
            "usertype" => ['required'],
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
                // $encrypt = bcrypt($request->input('password'));
                $arrItem = array(
                    
                    'fname' =>$request->get('first_name'),
                    'mname' => $request->get('mname'),
                    'lname' => $request->get('last_name'),
                    'birthday' => $request->get('birthday'),
                    'address' => $request->get('address'),
                    'gender' => $request->get('gender'),
                    'mobileno' => $request->get('mobile_number'),
                    'email' => $request->get('email'),
                    // 'password' => $encrypt,
                    'usertype' => $request->get('usertype'),
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
                        'address' => $request->get('address'),
                        'gender' => $request->get('gender'),
                        'mobileno' => $request->get('mobile_number'),
                        'email' => $request->get('email'),
                        'password' => $encrypt,
                        'usertype' => $request->get('usertype'),
                    );
                    DB::table('users')->where('id', $id)->update($arrItem);
                    return response()->json([
                        'status'=>200,
                        'message' => 'discount updated successfully with  updated password',
                        
                    ]);
               
            }
        }
    }

    //delete user 
    public function delete_user($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    //show user data in edit page
    public function edit_user($id){
        $user = User::where('id', $id )->get();
           if($user){
            return response()->json([
                'status'=>200,
                'user' => $user,
            ]);
           }else{
            return response()->json([
                'status'=>404,
                'message' => 'discount not found',
            ]);
           }

        // $user = User::findOrFail($id);
        // return view('admin.profile.updateuser', ['user' => $user]);
    }

    // discount
    public function discount_show(){
        $data = Discount::all();
        return view('admin.discount', ['discounts' => $data]);
    }

    public function fetch_discount(){
        $data = Discount::all();
        return response()->json([
            'discounts'=> $data,
        ]);
    }

    //show discount create form
    public function create_discount(){
        return view('admin.discount.creatediscount');
    }

    public function store_discount(Request $request){

        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            $discount = new Discount;
            $discount->discountname = $request->input('discountname');
            $discount->percentage = $request->input('percentage');
            $discount->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
    }
    public function edit_discount($discountcode){
           $discount = Discount::where('discountcode', $discountcode )->get();
           if($discount){
            return response()->json([
                'status'=>200,
                'discount' => $discount,
            ]);
           }else{
            return response()->json([
                'status'=>404,
                'message' => 'discount not found',
            ]);
           }
    }
    public function update_discount($discountcode ,Request $request){

        $validator = Validator::make($request->all(), [
            'discountname'=>'required',
            'percentage' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {
            $arrItem = array(
                'discountname' =>$request->get('discountname'),
                'percentage' => $request->get('percentage'),
            );

            DB::table('discounts')->where('discountcode', $discountcode)->update($arrItem);

            return response()->json([
                'status'=>200,
                    'message' => 'discount updated successfully',
                
            ]);

        }
    }
    
    public function delete_discount($discountcode)
    {   
        DB::table('discounts')->where('discountcode', $discountcode)->delete();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    //service
    public function service_show(){
        $service = Service::all();
        return view('/admin/service', ['services' => $service]);
    }

public function fetch_service(){
    
    $data = Service::all();
    return response()->json([
        'services'=> $data,
    ]);
}

    //create
    public function store_service(Request $request){

        $validator = Validator::make($request->all(), [
            'servicename'=>'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {

            $service = new Service;
            $service->servicename = $request->input('servicename');
            $service->price = $request->input('price');
            $service->save();
            return response()->json([
                'status'=>200,
                'message' => 'discount added successfully',
            ]);
        }
    }

    //show edit service
    public function edit_service($servicecode){

        $service = Service::where('servicecode', $servicecode )->get();
        if($service){
         return response()->json([
             'status'=>200,
             'service' => $service,
         ]);
        }else{
         return response()->json([
             'status'=>404,
             'message' => 'discount not found',
         ]);
        }
    }

    //update service
    public function update_service($servicecode ,Request $request){
        $validator = Validator::make($request->all(), [
            'servicename'=>'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {
            $arrItem = array(
                'servicename' =>$request->get('servicename'),
                'price' => $request->get('price'),
            );

            $upadted = DB::table('services')->where('servicecode', $servicecode)->update($arrItem);
            if($upadted){
                return response()->json([
                    'status'=>200,
                        'message' => 'service updated successfully',
                    
                ]);
            }else{
                return response()->json([
                    'status'=>400,
                        'message' => 'service updated unsuccessfully',
                    
                ]);
            }
        }
    }

    public function delete_service($servicecode){
        DB::table('services')->where('servicecode', $servicecode)->delete();

        return response()->json([
            'status'=>200,
                'message' => 'deleted successfully',
            
        ]);
    }

    //appointment
    public function appointment_show(){
        return view('admin.appointment');
    }


}

