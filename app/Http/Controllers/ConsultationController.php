<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Service;
use App\Models\User;
use App\Services\ConsultationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{   
    protected $consultationService;

    public function __construct(ConsultationService $consultationService){
        $this->consultationService = $consultationService;
    }

    public function index(Request $request){

        if ($request->ajax()) {
           return $this->consultationService->getConsultationForDatatable();
        }

        return view('admin.consultation.index');
    }

    public function create(){

        $services = Service::all();

        return view('admin.consultation.create', compact('services'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
                "appoint_id" => ['required'],
                "service" => ['required'],
            ],[
                'appoint_id.required' => 'Please select patient appointment',
                'service.required' => 'please insert service',
            ])->stopOnFirstFailure(true);

        if($validator->fails()) {
            
            return Redirect::back()->withErrors($validator);
            
        }else{
            $this->consultationService->store($request->all());

            return redirect()->route('consultation.index');
        }

    }

    public function edit(Consultation $consultation){
        $userinfo = User::where('id', $consultation['user_id'])->first();
        $last = Consultation::where('user_id', $consultation['user_id'])->latest()->first();
        $consultations = Consultation::where('id', $consultation['id'])->first();
        return view('admin.consultation.edit', compact('userinfo', 'consultations', 'last'));
    }

    public function update(Consultation $consultation, Request $request){

        $this->consultationService->update($consultation, $request->all());

        return redirect('/admin/consultation/viewrecords/'. $request->input('user_id'))->with('success', 'Consultation updated successfully');                                                            
    }

    public function fetch_success_appointment(Request $request){

        if ($request->ajax()) {
          return $this->consultationService->getSuccessAppointmentForDatatable();
        }

        return view('admin.consultation.create');
    }

    public function get_appointment_information($id){
        $appointment = Appointment::with('user')->where('id', $id)->first();
        return response()->json([   'appointment' => $appointment,
                                    'gender' => $appointment->user->gender,
                                    'age' => $appointment->user->age,
                                ]);
    }

    public function patient_consultation_history($id, Request $request){
        $userinfo = User::where('id', $id)->first();
        $consultations =  DB::table('consultations')->where('user_id', $id)->orderby('created_at', 'desc')->paginate(5);
        $last = Consultation::where('user_id', $id)->latest()->first();

        return view('admin.consultation.patienthistory', compact('userinfo', 'consultations', 'last'));
    }

    public function show(Consultation $consultation){

        $userinfo = User::where('id', $consultation['user_id'])->first();
        $last = Consultation::where('user_id', $consultation['user_id'])->latest()->first();
        $consultations = Consultation::where('id', $consultation['id'])->first();

        return view('admin.consultation.view', compact('userinfo', 'consultations', 'last'));
    }


}
