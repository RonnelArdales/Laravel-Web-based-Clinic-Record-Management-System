<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\ModeOfPaymentRequest;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Mail\Cancelappointment;
use App\Mail\reschedule_admintopatient;
use App\Mail\reschedule_patienttoadmin;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\BusinessHour;
use App\Models\Dayoff_date;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Service;
use App\Models\User;
use App\Services\AppointmentService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

        protected $appointmentService;

        public function __construct(AppointmentService $appointmentService){

            $this->appointmentService = $appointmentService;
        }

//--------------- show tables -------------------------//
    public function index(Request $request){
        $days = BusinessHour::getBusinessHour();
        $dates = Dayoff_date::getDayoff_date();
        $day = BusinessHour::select('day', 'off')->distinct()->get();
        $services = Service::all();
        $mops = Modeofpayment::all();
        $fee = Reservationfee::getReservationfee();
        $date_array = [];
        $day_array = [];

        foreach($dates as $date){
            $date_array[] = $date->date;
        }
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        if ($request->ajax()) {
            return  $this->appointmentService->getPendingStatusforDatatable();
        }

        if(Auth::user()->usertype == 'admin'){

            return view('admin.appointment', compact( 'services', 'day', 'days', 'mops', 'fee'))->with('day_array', $day_array)->with('date_array', $date_array);
        }else{
            return view('secretary.appointment', compact('services', 'day', 'days', 'mops', 'fee' ))->with('day_array', $day_array)->with('date_array', $date_array);
        
    }

}

    public function complete_appointment_show(Request $request){
        if ($request->ajax()) {
            return  $this->appointmentService->getCompleteStatusforDatatable();
        }
    }

    public function cancel_appointment_show(Request $request){
        if ($request->ajax()) {
            return  $this->appointmentService->getCancelStatusforDatatable();
        }
    }

    public function trans_appointment_show(Request $request){
        if ($request->ajax()) {
            return  $this->appointmentService->getTransactionforDatatable();
        }
    }

    public function store(Request $request){

        $StoreAppointmentRequest = new StoreAppointmentRequest();
        $validator = Validator::make($request->all(), $StoreAppointmentRequest->rules(), $StoreAppointmentRequest->messages());

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
                'data' => $request->input('modeofpayment'),
            ]);
        }else{

            $input = $request->all();
            if($input['modeofpayment'] == "Cash"){
                $MopValidator = Validator::make($request->all(), [
                    'payment'=>'required|gte:reservation_fee',
                ],[
                    'payment.required'=> 'Payment  is required',
                ]);

            }else{
                $MopValidator = Validator::make($request->all(), [
                    'reference_no'=>'required',
                ],[
                   'reference_no.required'=> 'Reference no is required',
                ]);
            }

            if($MopValidator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $MopValidator->messages(),
                ]);
            }else{
              $appointment = $this->appointmentService->store($request->all());

              return response()->json([
                        'status' => 200,
                        'data' => $appointment,
                    ]);
            }
        }
    }

    public function update(Request $request, Appointment $appointment){

        $status = $request->status;
     
        if($status == "Success" || $status == "Cancel" ){

            $this->appointmentService->update($request->all(), $appointment);

        }else{
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
             
                'data' => $data,
            ]);
            }
        }
    }


}
