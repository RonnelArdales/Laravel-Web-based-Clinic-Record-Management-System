<?php

namespace App\Services;

use App\Mail\Cancelappointment;
use App\Mail\reschedule_admintopatient;
use App\Mail\reschedule_patienttoadmin;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentService {

    public function getPendingStatusforDatatable(){
        $data = Appointment::where('status', 'pending')->orderby('created_at', 'desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<button style="margin-right:5px; padding-left:4px; padding-right:4px; font-size:14px" class="complete btn btn-sm btn-primary" data-id="' . $row->id . '" >Complete</button>';
                        $btn = $btn.'<button class="resched btn btn-sm btn-info" style="color:white; padding-left:4px; padding-right:4px; font-size:14px" data-id="' . $row->id . '">Reschedule</button> ' ;
                        $btn = $btn.'<button class="cancel btn btn-sm btn-danger" style="padding-left:4px;</br> padding-right:4px; font-size:14px" data-id="' . $row->id . '">Cancel</button>';
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

    public function getCompleteStatusforDatatable(){
        $data = Appointment::where('status', 'success')->orderby('created_at', 'desc');
        return Datatables::of($data)
                ->make(true);
    }

    public function getCancelStatusforDatatable(){
        $data = Appointment::where('status', 'cancel')->orderby('created_at', 'desc');
        return Datatables::of($data)
        ->make(true);
    }

    public function getTransactionforDatatable(){
        $data = Appointment::all();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if(Auth::user()->usertype == 'admin'){
                $btn = ' <a href="/admin/appointment/print/' . $row->id . '" class=" btn btn-sm btn-primary">Print</a>';  
            }else{
                $btn = ' <a href="/secretary/appointment/print/' . $row->id . '" class=" btn btn-sm btn-primary">Print</a>';  
            }
                return $btn; 
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    

    public function store($data){

        $time = Carbon::createFromFormat('h:i A', $data['time'])->format('H:i:s');
        $appointment = new Appointment();
        $appointment->user_id = $data['userid'];
        $appointment->fullname = $data['fullname'];
        $appointment->contact_no = $data['contactno'];
        $appointment->email = $data['email'];
        $appointment->date = $data['date'];
        $appointment->time = $time;
        $appointment->appointment_method = "walkin";
        $appointment->reschedule_limit = 1;
        $appointment->reservation_fee = $data['reservation_fee'];
        $appointment->mode_of_payment = $data['modeofpayment'];

        if($data['modeofpayment'] == 'cash'){
            $appointment->payment =$data['payment'];
            $appointment->change = $data['change'];
        }else{
            $appointment->reference_no = $data['reference_no'];
        }
        $appointment->status = "pending";
        $appointment->save();

        (new AuditTrailService())->store('Create an appointment');

        return $appointment;
    }

    public function update($data, $appointment){

        if($data['status'] == "Success"){

            $appointment->update(['status' => "success"]);

            (new AuditTrailService())->store('Change appointment status to success');

        }else if($data['status'] == "Cancel"){

            $appointment->update(['status' => "cancel"]);

            Mail::to($appointment->email)->send(new Cancelappointment($appointment->fullname, $appointment->date, $appointment->time));

            (new AuditTrailService())->store('Change appointment status to Cancel');

            return $appointment;

        }else{

            $time = Carbon::createFromFormat('h:i A', $data['time'])->format('H:i:s');

            if(Auth::user()->usertype === "admin" || Auth::user()->usertype === "secretary"){

                $appointment->update([ 'date' => $data['date'],
                                'time' => $time,  
                            ]);
                
                Mail::to($appointment->email)->send(new reschedule_admintopatient($appointment->fullname, $data['date'], $time));

                // (new AuditTrailService())->store('Reschedule Appointment');
                return $data['date'];

            }else{
          
            
                $appointment->update([ 'date' =>$data['date'],
                                'time' => $time,
                                'reschedule_limit' => 0,
                            ]);

                $users = User::whereIn('usertype', ['secretary', 'admin'])->where('status', 'verified')->get();
                
                foreach($users as $user){
                    Mail::to($user->email)->send(new reschedule_patienttoadmin($appointment->fullname, $data['date'], $time));
                }

                (new AuditTrailService())->store('Reschedule Appointment');

            }
        }

    }
}