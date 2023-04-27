<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
        //search user
        public function search_user(Request $request){
                    $name =  $request->input('search');
                   $users = DB::table('users')->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
                    if($users->count() >= 1){
                        return view('pagination.report.user', compact('users'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
        }

        public function search_user_status(Request $request){
            $status =  $request->input('status');
            $users = DB::table('users')->where('status', $status)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
            if(empty($status)){
                $users = DB::table('users')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
            }else{
                if($users->count() >= 1){
                    return view('pagination.report.user', compact('users'))->render();
                }else{
                    return response()->json(['message' => 'Nofound']);
                }
            }
          
        }

        public function search_user_usertype(Request $request){
            $usertype =  $request->input('usertype');
        
            $users = DB::table('users')->where('usertype', $usertype)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
        
                if($users->count() >= 1){
                    return view('pagination.report.user', compact('users'))->render();
                }else{
                    return response()->json(['message' => 'Nofound']);
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
                    $patients = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(9, ['*'], 'patient');
                    if($patients->count() >= 1){
                        return view('pagination.pagination_patient', compact('patients'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
                    
                }elseif ($usertype == "secretary") {
                    $secretaries = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(9, ['*'], 'secretary');
                    if($secretaries->count() >= 1){
                        return view('pagination.pagination_secretary', compact('secretaries'))->render();
                    }else{
                        return response()->json(['message' => 'Nofound']);
                    }
                }else{
                    $admins = DB::table('users')->where('usertype', $usertype)->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(9, ['*'], 'admin');
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

                $patients =  DB::table('users')->where('usertype', 'patient')->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$fullname."%")->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
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


        public function search_appointment_user(Request $request){
            $name =  $request->input('search');
           $appointments = Appointment::where('fullname', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments')->withQueryString();
            if($appointments->count() >= 1){
                return view('pagination.report.appointment', compact('appointments'))->render();
            }else{
                return response()->json(['message' => 'Nofound']);
            }
}


public function search_appointment_date(Request $request){
    $startDate = $request->input('start_date');
    $concatStart = $startDate . " " . "00:00:00";
  $endDate = $request->input('end_date');
  $concatEnd = $endDate . " " . "23:59:59";
   $appointments =  Appointment::whereBetween('created_at', [$concatStart, $concatEnd])->paginate(10, ['*'], 'appointments')->withQueryString();
    if($appointments->count() >= 1){
        return view('pagination.report.appointment', compact('appointments'))->render();
    }else{
        return response()->json(['message' => 'Nofound']);
    }
}


public function search_appointment_status(Request $request){
    $status =  $request->input('status');
    $appointments = DB::table('appointments')->where('status', $status)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments');
    if(empty($status)){
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments');
    }else{
        if($appointments->count() >= 1){
            return view('pagination.report.appointment', compact('appointments'))->render();
        }else{
            return response()->json(['message' => 'Nofound']);
        }
    }
}


public function search_appointment_mop(Request $request){
    $name =  $request->input('search');
   $appointments = Appointment::where('fullname', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments')->withQueryString();
    if($appointments->count() >= 1){
        return view('pagination.report.appointment', compact('appointments'))->render();
    }else{
        return response()->json(['message' => 'Nofound']);
    }
}

public function search_billing_user(Request $request){

    $name =  $request->input('search');
    $billings = Transaction::where('fullname', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings')->withQueryString();
     if($billings->count() >= 1){
         return view('pagination.report.billing', compact('billings'))->render();
     }else{
         return response()->json(['message' => 'Nofound']);
     }
}

public function search_billing_date(Request $request){
    $startDate = $request->input('start_date');
    $concatStart = $startDate . " " . "00:00:00";
  $endDate = $request->input('end_date');
  $concatEnd = $endDate . " " . "23:59:59";

   $billings =  Transaction::whereBetween('created_at', [$concatStart, $concatEnd])->paginate(10, ['*'], 'billings')->withQueryString();
    if($billings->count() >= 1){
        return view('pagination.report.billing', compact('billings'))->render();
    }else{
        return response()->json(['message' => 'Nofound']);
    }
}

public function search_billing_status(Request $request){
    $status =  $request->input('status');
    $billings = Transaction::where('status', $status)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings')->withQueryString();
    if(empty($status)){
        $billings = DB::table('transactions')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings');
    }else{
        if($billings->count() >= 1){
            return view('pagination.report.billing', compact('billings'))->render();
        }else{
            return response()->json(['message' => 'Nofound']);
        }
    }

}

public function search_billing_mop(Request $request){
    
    $mop =  $request->input('mop');
    $billings = Transaction::where('mode_of_payment', $mop)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings')->withQueryString();
        if($billings->count() >= 1){
            return view('pagination.report.billing', compact('billings'))->render();
        }else{
            return response()->json(['message' => 'Nofound']);
        }
   
}

public function search_audittrail_user(Request $request){
    $name =  $request->input('search');
    $audits = AuditTrail::where('username', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->paginate(12, ['*'], 'audits')->withQueryString();
     if($audits->count() >= 1){
         return view('pagination.report.audittrail', compact('audits'))->render();
     }else{
         return response()->json(['message' => 'Nofound']);
     }
}

public function search_audittrail_date(Request $request){
    $startDate = $request->input('start_date');
    $concatStart = $startDate . " " . "00:00:00";
  $endDate = $request->input('end_date');
  $concatEnd = $endDate . " " . "23:59:59";

   $audits =  AuditTrail::whereBetween('created_at', [$concatStart, $concatEnd])->paginate(12, ['*'], 'billings')->withQueryString();
    if($audits->count() >= 1){
        return view('pagination.report.audittrail', compact('audits'))->render();
    }else{
        return response()->json(['message' => 'Nofound']);
    }
}

public function search_audittrail_usertype(Request $request){
    $usertype =  $request->input('usertype');
    $audits = AuditTrail::where('usertype', $usertype)->orderBy('created_at', 'desc')->paginate(12, ['*'], 'audits')->withQueryString();
     if($audits->count() >= 1){
         return view('pagination.report.audittrail', compact('audits'))->render();
     }else{
         return response()->json(['message' => 'Nofound']);
     }
}
        
}
