<?php

namespace App\Services;

use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;

class ConsultationService {

    public function getConsultationForDatatable(){
        $data = DB::table('consultations')->select('user_id', 'fullname', 'age' ,'gender' )->oldest('created_at')->distinct()->orderby('created_at','desc');
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = ' <a href="/admin/consultation/viewrecords/' . $row->user_id . '" class=" btn btn-sm btn-primary">View</a>';          
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getSuccessAppointmentForDatatable(){
        $data = DB::table('appointments')->where('status', 'success')->orderby('created_at', 'desc');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('time', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $time = Carbon::parse($event->time);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $time->format('h:i A');
                })
                ->addColumn('date', function ($event) {
                    // Convert the start_time to a Carbon instance
                    $date = Carbon::parse($event->date);
        
                    // Format the time as desired, e.g. "h:i A" for 12-hour time format
                    return $date->format('M d, Y');
                })
            
                ->addColumn('action', function($row){
                    $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn btn-sm btn-danger" id="select"  data-id="' . $row->id . '">Select</button>';         
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function store($data){
        $date = Carbon::createFromFormat('m/d/Y',$data['date'])->format('Y-m-d');
        $time = Carbon::createFromFormat('h:i A', $data['time'])->format('H:i:s');
        $consultation = new Consultation();
        $consultation->appointment_id = $data['appoint_id'];
        $consultation->user_id = $data['userid'];
        $consultation->fullname = $data['fullname'];
        $consultation->gender = $data['gender'];
        $consultation->age = $data['age'];
        $consultation->date = $date;
        $consultation->time = $time;
        $consultation->service = $data['service'];
        $consultation->primary_diag = $data['primary_diag'];
        $consultation->behavioral_observation = $data['observation'];
        $consultation->brief_summary_encounter = $data['summary'];
        $consultation->clinical_impression = $data['impression'];
        $consultation->treatment_given = $data['treatment'];
        $consultation->recommendation = $data['recommendation'];
        $consultation->save();
    }

    public function update($consultation, $data){
      
        $consultation->update([ 'primary_diag' => $data['primary_diag'] ?? 'n/a',
                                'behavioral_observation' => $data['observation'] ?? 'n/a',
                                'brief_summary_encounter' => $data['summary']  ?? 'n/a',
                                'clinical_impression' => $data['impression'] ?? 'n/a' ,
                                'treatment_given' => $data['treatment'] ?? 'n/a' ,
                                'recommendation' => $data['recommendation'] ?? 'n/a' ,
                            ]);
    }
}