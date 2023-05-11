<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\BusinessHour;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

//--------------- show tables -------------------------//

    public function appointment_show(Request $request){
        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }
        $day = BusinessHour::select('day', 'off')->distinct()->get();
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
        $patients =  DB::table('users')->where('usertype', 'patient')->where('status', 'verified')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        $services = Service::all();
        $mops = Modeofpayment::all();
        $fee = Reservationfee::select('reservationfee')->first();

        if(Auth::user()->usertype == 'admin'){
            if ($request->ajax()) {
                $data = Appointment::where('status', 'pending')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){

                            $currentDate = now()->toDateString();
                            $appointmentDate = date('Y-m-d', strtotime($row->date));
                            $btn = '';
                    
                            $oneDayBefore = date('Y-m-d', strtotime('-1 day', strtotime($appointmentDate)));
                            

                            if ($currentDate >= $oneDayBefore) {
                                $btn = '<button style="margin-right:5px" class="complete btn btn-sm btn-primary" data-id="' . $row->id . '" >Complete</button>';
                                $btn = $btn.'<button class="cancel btn btn-sm btn-danger" data-id="' . $row->id . '">Cancel</button>';
                         
                            }else{
                                $btn = '<button style="margin-right:5px; padding-left:4px; padding-right:4px; font-size:14px" class="complete btn btn-sm btn-primary" data-id="' . $row->id . '" >Complete</button>';
                                $btn = $btn.'<button class="resched btn btn-sm btn-info" style="color:white; padding-left:4px; padding-right:4px; font-size:14px" data-id="' . $row->id . '">Reschedule</button> ' ;
                                $btn = $btn.'<button class="cancel btn btn-sm btn-danger" style="padding-left:4px;</br> padding-right:4px; font-size:14px" data-id="' . $row->id . '">Cancel</button>';
                            }
                                $size = '<div style="margin:0px">' . $btn . '</div>';                
                                    return $size;
                                    
                        })    ->editColumn('user_id', function ($row) {
                            return '<div style="width: 50px">' . $row->user_id . '</div>';
                        }) ->editColumn('status', function ($row) {
                            return '<div style="width: 50px">' . $row->status . '</div>';
                        })
                        
                    
                        ->rawColumns(['action', 'user_id', 'status'])
                        ->make(true);

            }

            return view('admin.appointment', compact('appointments', 'patients', 'services', 'day', 'days', 'mops', 'fee'))->with('day_array', $day_array);
        }else{

            if ($request->ajax()) {
                $data = Appointment::where('status', 'pending')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $currentDate = now()->toDateString();
                            $appointmentDate = date('Y-m-d', strtotime($row->date));
                            $btn = '';
                    
                            $oneDayBefore = date('Y-m-d', strtotime('-2 day', strtotime($appointmentDate)));
                            

                            if ($currentDate >= $oneDayBefore) {
                                $btn = '<button style="margin-right:5px" class="complete btn btn-sm btn-primary" data-id="' . $row->id . '" >Complete</button>';
                                $btn = $btn.'<button class="cancel btn btn-sm btn-danger" data-id="' . $row->id . '">Cancel</button>';
                         
                            }else{
                                $btn = '<button style="margin-right:5px; padding-left:4px; padding-right:4px; font-size:14px" class="complete btn btn-sm btn-primary" data-id="' . $row->id . '" >Complete</button>';
                                $btn = $btn.'<button class="resched btn btn-sm btn-info" style="color:white; padding-left:4px; padding-right:4px; font-size:14px" data-id="' . $row->id . '">Reschedule</button> ' ;
                                $btn = $btn.'<button class="cancel btn btn-sm btn-danger" style="padding-left:4px;</br> padding-right:4px; font-size:14px" data-id="' . $row->id . '">Cancel</button>';
                            }
                                $size = '<div style="margin:0px">' . $btn . '</div>';                
                                    return $size;
                       })  ->editColumn('user_id', function ($row) {
                            return '<div style="width: 50px">' . $row->user_id . '</div>';
                        }) ->editColumn('status', function ($row) {
                            return '<div style="width: 50px">' . $row->status . '</div>';
                        })
                        ->rawColumns(['action', 'user_id', 'status'])
                        ->make(true);
            }
            return view('secretary.appointment', compact('appointments', 'patients', 'services', 'day', 'days', 'mops', 'fee' ))->with('day_array', $day_array);
  
        }
    }

    public function complete_appointment_show(Request $request){

        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }
        $day = BusinessHour::select('day', 'off')->distinct()->get();
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
        $patients =  DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        $services = Service::all();

        if(Auth::user()->usertype == 'admin'){
            if ($request->ajax()) {
                $data = Appointment::where('status', 'success')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->make(true);
            }


        }else{
            if ($request->ajax()) {
                $data = Appointment::where('status', 'success')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->make(true);
            }

            //secretary side
  
        }
    }

    public function cancel_appointment_show(Request $request){
      
        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }
        $day = BusinessHour::select('day', 'off')->distinct()->get();
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
        $patients =  DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        $services = Service::all();

        if(Auth::user()->usertype == 'admin'){
            if ($request->ajax()) {
                $data = Appointment::where('status', 'cancel')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->make(true);
            }


        }else{

            if ($request->ajax()) {
                $data = Appointment::where('status', 'cancel')->orderby('created_at', 'desc');
                return Datatables::of($data)
                        ->make(true);
            }
  
        }
    }

    public function trans_appointment_show(Request $request){
        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }
        $day = BusinessHour::select('day', 'off')->distinct()->get();
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
        $patients =  DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        $services = Service::all();

        if(Auth::user()->usertype == 'admin'){
            if ($request->ajax()) {
                $data = Appointment::all();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <a href="/admin/appointment/print/' . $row->id . '" class=" btn btn-sm btn-primary">Print</a>';          
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }else{

            if ($request->ajax()) {
                $data = Appointment::all();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <a href="/secretary/appointment/print/' . $row->id . '" class=" btn btn-sm btn-primary">Print</a>';          
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
  
        }
    }

    public function store_appointment(Request $request){
        $validator = Validator::make($request->all(), [
            'userid'=>'required',
            'date' => 'required',
            'time' => 'required',
            'modepayment' => 'required',
            
        ],[
            'userid.required'=>'Patient information is required',
            'date.required' => 'Appointment date is required',
            'time.required' => 'Appointment time is required',
            'modepayment.required' => 'Mode of payment is required', 
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $input = $request->all();
           $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
            $appointment = new Appointment();
            $appointment->user_id = $input['userid'];
            $appointment->fullname = $input['fullname'];
            $appointment->contact_no = $input['contactno'];
            $appointment->email = $input['email'];
            $appointment->date =  $input['date'];
            $appointment->time = $time;
            $appointment->appointment_method = "walk-in";
            $appointment->reschedule_limit = 1;
            $appointment->reservation_fee = $input['reservation_fee'];
            $appointment->mode_of_payment = $input['modepayment'];
            if($input['modepayment'] == "Cash"){
                $validator = Validator::make($request->all(), [
                    'payment'=>'required',
                ],[
                    'payment.required'=> 'Payment  is required',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages(),
                    ]);
                }else{
                    $appointment->payment = $input['payment'];
                    $appointment->change = $input['change'];
                }
            }else{
                $validator = Validator::make($request->all(), [
                    'reference_no'=>'required',
                ],[
                    'reference_no.required'=> 'Reference no is required',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status' => 400,
                        'errors' => $validator->messages(),
                    ]);
                }else{
                    $appointment->reference_no = $input['reference_no'];
                }
            }
            $appointment->status = "pending";
            $appointment->save();

            $audit_trail = new AuditTrail();
            $audit_trail->user_id = Auth::user()->id;
            $audit_trail->username = Auth::user()->username;
            $audit_trail->activity = 'Create an appointment';
            $audit_trail->usertype = Auth::user()->usertype;
            $audit_trail->save();
            //send to patient
            // Mail::to('ronnelardales2192@gmail.com')->send(new patientbook);
      
            return response()->json([
                'status' => 200,
                'message' => "Created Successfully",
                'time' => $appointment,
          
            ]);
        }

 
    }
     
}
