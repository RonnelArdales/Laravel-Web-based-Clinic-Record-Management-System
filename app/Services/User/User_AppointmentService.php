<?php

namespace App\Services\User;

use App\Mail\Bookappointment;
use App\Mail\Cancelappointmentpatient;
use App\Mail\Cancelappointmentpatienttoadmin;
use App\Models\Appointment;
use App\Models\User;
use App\Services\AuditTrailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class User_AppointmentService{

    public function cancel_appointment($id){
        
        $appointment = Appointment::where('id', $id)->update(['status' => 'cancel',]);

        if($appointment){

            $user = Appointment::where('id', $id)->first();

            Mail::to($user->email)->send(new Cancelappointmentpatient($user->fullname, $user->date, $user->time));
    
            $admins = User::whereIn('usertype', ['secretary', 'admin'])->where('status', 'verified')->get();
     
             foreach($admins as $admin){
                Mail::to($admin->email)->send(new Cancelappointmentpatienttoadmin ($user->fullname, $user->date, $user->time));
             }

             (new AuditTrailService())->store('Cancel Appointment');
        }

        return $appointment;
    }

    public function store($request){

        $time = Carbon::createFromFormat('h:i A', $request['time'])->format('H:i:s');

        $appointment = new Appointment();
        $appointment->user_id = Auth::user()->id;
        $appointment->fullname = Auth::user()->fname . " " . Auth::user()->lname;
        $appointment->contact_no = Auth::user()->mobileno;
        $appointment->email = Auth::user()->email;
        $appointment->date = $request['date'];
        $appointment->time = $time;
        $appointment->appointment_method = "online";
        $appointment->reservation_fee = $request['reservation_fee'];
        $appointment->mode_of_payment = $request['mop'];
        $appointment->reference_no = $request['reference_no'] ;
        $appointment->reschedule_limit = 1;
        $appointment->status = 'pending';
        $appointment->save();

        $admins = User::where('usertype',['admin', 'secretary'] )->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new Bookappointment);
        }
        
        (new AuditTrailService())->store('Create an appointment');

        return $request;

    }
}