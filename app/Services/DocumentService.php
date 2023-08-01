<?php

namespace App\Services;

use App\Mail\PatientDocument;
use App\Models\Consultationfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class DocumentService {

    public function getDocumentforDatatable(){
        $data = DB::table('consultationfiles')->orderby('created_at','desc');
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="view btn btn-sm btn-primary" data-id="' . $row->id . '">View</button>';
                    $btn = $btn.'<button class="edit btn btn-sm btn-info" style="margin-left: 5px;color:white ;margin-right: 5px;" data-id="' . $row->id . '">Edit</button>';
                    $btn = $btn.'<button class="delete btn btn-sm btn-danger" data-id="' . $row->id . '">Delete</button>';
                    $size = '<div style="width: 200px">' . $btn . '</div>';                
                        return $size;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getSuccessAppointmentforDatatable(){
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
                })->setColumnStyle([
                    'time' => 'width: 150px;',
                    'date' => 'width: 200px;',
                ])
                ->addColumn('action', function($row){
                    $btn = '<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 30px; " class=" select btn  " id="select"  data-id="' . $row->id . '">Select</button>';   
                    $size = '<div style="width: 150px">' . $btn . '</div>';          
                        return $size;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function store($data){
        $filename = date('YmdHis'). '.' . $data['pdf']->getClientOriginalExtension();
        $data['pdf']->move(public_path('consultation/'), $filename);
        $data['pdf'] = $filename;

        $date = Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');
        $documents = new Consultationfile();
        $documents->appointment_id = $data['appointment_id'];
        $documents->appointment_date = $date;
        $documents->user_id = $data['user_id'];
        $documents->fullname = $data['fullname'];
        $documents->documenttype = $data['doc_type'];
        $documents->filename = $data['pdf'];
        $documents->note = $data['note'];
        $documents->save();

        $user = User::where('id', $data['user_id'])->first();
        
        Mail::to($user->email)->send(new PatientDocument ($data['fullname'], $date));
        
        (new AuditTrailService())->store('Create document');
    }

    public function update($id, $data, $pdf){
        $document = Consultationfile::where('id', $id)->first();
        $path = public_path('consultation/'.$document->filename);

        if($document){
            $document->note = $data['note'];
            $document->documenttype = $data['doc_type'];
            if($pdf){
            
                if(File::exists($path)){
                    File::delete($path);
                }
                $filename = date('YmdHis'). '.' . $data['pdf']->getClientOriginalExtension();
                $data['pdf']->move(public_path('consultation/'), $filename);
                $input['pdf'] = $filename;
                $document->filename = $filename;
            }
                
            $document->save();

            (new AuditTrailService())->store('Update document');

            return response()->json([
                    'status'=> 200,
                    'message'=> 'updated successfully',
            ]);

        }else{
            return response()->json([
                'status'=>404,
                'errors'=> 'no file found',
            ]);
        }
    }

    public function destroy($id){
        $document = Consultationfile::where('id', $id)->first();
        $path = public_path('consultation/'.$document->filename) ;
        DB::table('consultationfiles')->where('id', $id)->delete();
        if(File::exists($path)){
                File::delete($path);
            }
  
        (new AuditTrailService())->store('Delete document');
    }
 
}