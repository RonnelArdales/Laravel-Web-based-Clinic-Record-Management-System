<?php

namespace App\Http\Controllers\User;
use App\http\Controllers\Controller;
use App\Mail\Bookappointment;
use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\Dayoff_date;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AppointmentService;
use App\Services\AuditTrailService;
use App\Services\User\User_AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;

class User_AppointmentController extends Controller
{

    protected $appointmentService;
    protected $User_AppointmentService;

    public function __construct(AppointmentService $appointmentService, User_AppointmentService $User_AppointmentService){

        $this->appointmentService = $appointmentService;
        $this->User_AppointmentService = $User_AppointmentService;
    }

    public function index(){
        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $walkins = BusinessHour::select('day')->where('off', '1')->where('appointment_method', 'walkin')->groupBy('day')->get();
        $dates = Dayoff_date::select('date')->get();
        $day_array = [];
        $date_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        foreach($dates as $date){
            $date_array[] = $date->date;
        }

        $walkin_array = [];
        foreach ($walkins as $walkin){
            $walkin_array[] = date('w', strtotime($walkin->day));
        } 

        $day = BusinessHour::select('day', 'off')->distinct()->get();
        return view('patient.appointment', compact('day', 'days'))->with('day_array', $day_array)->with('walkin_array', $walkin_array)->with('date_array', $date_array);
    }

    public function create(Request $request){
        $input = $request->all();
 
        $time = Carbon::createFromFormat('h:i A', $input['time'])->format('H:i:s');
        $date = Carbon::createFromFormat('m-d-Y', $input['date'])->format('Y-m-d');

        $billinginfo = array(
                            'date' => $request->input('date'),
                            'time' => $request->input('time'),
                        );

        $mops = Modeofpayment::all();
        $fee = Reservationfee::first();

        return view('patient.billing.billing_payment')->with('info', $billinginfo)
                                                    ->with('mops', $mops)
                                                    ->with('fee', $fee);
    }

    public function store(Request $request){

        $request->validate([
            "reference_no" => ['required'],
            "mop" => ['required'],
        ], [
            'reference_no.required' => 'Reference code is required',
            'mop' => 'Mode of payment is required',
        ]);

       $data = $this->User_AppointmentService->store($request->only(['reservation_fee', 'mop', 'date', 'time', 'reference_no' ]));

        return redirect('patient/homepage')->with('success', 'Created Successfully, Please wait for your appointment');
    }

    public function update(Request $request, Appointment $appointment){

        $validator = Validator::make($request->all(), [
        'date' => 'required',
        'time' => 'required',
        
        ],[
            'date.required' => 'Appointment date is required',
            'time.required' => 'Appointment time is required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $data =   $this->appointmentService->update($request->all(), $appointment);

            return response()->json([
                'data' => $appointment,
                "user" => $data,
            ]);
        }
       
    }

    public function cancel_appointment($id){

        $this->User_AppointmentService->cancel_appointment($id);

    }

    public function resched_count($id){
        $appointment = Appointment::where('id', $id)->first();
        if($appointment->reschedule_limit == 1){
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['status' => 400]);
        }
    }
}

