<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
        //search user
        public function search_user(Request $request){

            if($request->ajax()){
                    $name =  $request->input('search');
                    $users = DB::table('users')->whereRaw("concat(fname, ' ',mname,' ' , lname) like '%" .$name. "%' ")
                                    ->orWhereRaw("concat(fname, ' ', lname) like '%" .$name. "%' ")->get();
                    return response()->json(['data'=> $users ]);
            }else{
                $users = User::all();
                return view ('reports.users' , compact('users'));
            }
        }
        public function search_usertype(Request $request){

            if($request->input('usertype')){
                $usertype =  $request->input('usertype');
                $users = User::Where('usertype', $usertype)->get();
                return response()->json(['data' => $users ]);
            }
        }

        public function profile_search_user(Request $request){

            if($request->ajax()){
                $name =  $request->input('search');
                $usertype =  $request->input('usertype');

                if($usertype == "patient"){
                    $patients = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->paginate(9, ['*'], 'patient');
                    if($patients->count() >= 1){
                        return view('pagination.pagination_patient', compact('patients'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
                    
                }elseif ($usertype == "secretary") {
                    $secretaries = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->paginate(9, ['*'], 'secretary');
                    if($secretaries->count() >= 1){
                        return view('pagination.pagination_secretary', compact('secretaries'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
                }else{
                    $admins = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->paginate(9, ['*'], 'admin');
                    if($admins->count() >= 1){
                        return view('pagination.pagination_admin', compact('admins'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
                }
           }
        }

        public function appointment_search_user(Request $request){
            $name = $request->search;
            $appointments = DB::table('appointments')->where('fullname' , 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(6, ['*'], 'appointment');
            
            if($appointments->count() >= 1){
                return view('pagination.pagination_appointment', compact('appointments'))->render();
            }else{
                return response()->json(['message' => 'Nofound']);
            }
         
        }

        public function modal_profile(Request $request){
                $fullname = $request->search;

                $patients =  DB::table('users')->where('usertype', 'patient')->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$fullname."%")->paginate(2, ['*'], 'patient');
                if($patients->count() >= 1){
                    return view('pagination.pagination_modalpatient', compact('patients'))->render();
                }else{
                    return response()->json(['message' => 'Nofound']);
                }
                // return response()->json(['search' => $fullname]);
        }
        public function queuing_fullname(Request $request){
                $fullname = $request->search;
                
                $appointments =  DB::table('appointments')->where('fullname' , 'LIKE', "%".$fullname."%")->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
                ->orderBy('date', 'asc')->paginate(1, ['*'], 'queuing');
          
                if($appointments->count() >= 1){
                    return view('pagination.pagination_queuing', compact('appointments'))->render();
                }else{
                    return response()->json(['message' => 'Nofound']);
                }
             
        }
        
}
