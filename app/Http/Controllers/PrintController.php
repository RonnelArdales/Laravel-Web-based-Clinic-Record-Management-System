<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use Dompdf\Dompdf;
use DOMPDF\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PrintController extends Controller
{
    public function print_user(Request $request){
        if($request->input('fullname')){
            $name =  $request->input('fullname');
            $users = DB::table('users')->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users ))->setPaper('A4','landscape');
            return $pdf->stream('User report.pdf');
        }elseif($request->input('status')){
            $status =  $request->input('status');
            $users = DB::table('users')->where('status', $status)->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users ))->setPaper('A4','landscape');
            return $pdf->stream('User report.pdf');
        }elseif($request->input('usertype')){
            $usertype =  $request->input('usertype');
            $users = DB::table('users')->where('usertype', $usertype)->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users ))->setPaper('A4','landscape');
            return $pdf->stream('User report.pdf');
        }else{
            $users = DB::table('users')->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users ))->setPaper('A4','landscape');
            return $pdf->stream('User report.pdf');
        }
        // if($request->input('fullname')){
        //     $name =  $request->input('fullname');
        //     $users = User::where('fname', 'LIKE', '%'.$name.'%' )->orWhere('mname', 'LIKE', '%'.$name.'%')->orWhere('lname', 'LIKE', '%'.$name.'%')->get();
        //     $pdf = Pdf::loadView('print.users', array('userss' => $users))->setPaper('landscape');
        //     return $pdf->stream('invoice.pdf');
        // }else if($request->input('usertype')){
        //     $usertype =  $request->input('usertype');
        //     $users = User::Where('usertype', $usertype)->get();
        //     $pdf = Pdf::loadView('print.users', array('userss' => $users))->setPaper('landscape');
        //     return $pdf->stream('invoice.pdf');
        // }else{
        //     $users = User::all();
        //     // $options = new Options();
        //     // $options->set('isRemoteEnabled',true);      
        //     // $dompdf = new Dompdf( $options );

        //     // $dompdf
        
        //     // $contxt = stream_context_create([ 
        //     //     'ssl' => [
        //     //         'verify_peer' => FALSE,
        //     //         'verify_peer_name' => FALSE,
        //     //         'allow_self_signed'=> TRUE
        //     //     ]
        //     // ]);
        //     // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        //     // $pdf->getDomPDF()->setHttpContext($contxt);

        //     // $contxt = stream_context_create([ 
        //     //     'ssl' => [
        //     //         'verify_peer' => FALSE,
        //     //         'verify_peer_name' => FALSE,
        //     //         'allow_self_signed'=> TRUE
        //     //     ]
        //     // ]);
        //     // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        //     // $pdf->getDomPDF()->setHttpContext($contxt);


           
        //     $pdf = Pdf::loadView('print.users', array('userss' => $users ))->setPaper('A4','landscape');
        //     return $pdf->stream('invoice.pdf');
        // }
    }

    public function print_auditTrail(Request $request){
        $audits = DB::table('audit_trails')->orderby('created_at', 'DESC')->get();
        $pdf = Pdf::loadView('print.audittrail', array('audits' => $audits));
        return $pdf->stream('invoice.pdf');
    }

    public function print_appointment(Request $request){
        $appointments = Appointment::all();
        $image = base64_encode(file_get_contents(public_path('gcash.png')));
        $pdf = Pdf::loadView('print.appointment', compact('image', 'appointments'));
        return $pdf->stream('appointment.pdf');
        // $pdf->setEncryption('123' );
        // $pdf->adminUsername('123' );
        // return $pdf->download('invoice.pdf');
        // $pdf = Pdf::loadFile(public_path().'/jg.png')->stream('try.pdf');

        // file_put_contents('output.pdf', $pdf->output());
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // $pdf->setEncryption($password);
        // return $pdf->download('invoice.pdf');
    }


    public function upload_download_transaction($id){

        if(Auth::user()->usertype == "admin"){
             $file = Transaction::Where('id', $id)->first();
             return response()->download(public_path('consultation/' . $file->file));
        }else{
            $file = Transaction::Where('id', $id)->first();
            return response()->download(public_path('consultation/' . $file->file));
        }
       
        // $pdf = Pdf::loadFile(public_path('consultation/' . $file->file));
        // $pdf->setEncryption('123' );
        // // file_put_contents('output.pdf', $pdf->output());
        // // return $pdf->download('invoice.pdf');
        // // return $pdf->stream('invoice.pdf');
        // // $pdf = PDF::loadView('pdf.invoice', $data);
        // // $pdf->setEncryption($password);
        // return $pdf->download('invoice.pdf');
     
    //     if(Auth::user()->usertype == "admin"){
    //     }else{  
    //         $file = Transaction::Where('id', $id)->first();
    // //         //    dd($file->file);
    //         //  return response()->download(public_path('consultation/' . $file->file));
    //             return Pdf::loadFile(public_path('consultation/' . $file->file))->stream('download.pdf');
    // //     }
    // //            return response()->download(public_path('consultation/' . $file));
    // // $file = Pdf::loadFile(public_path('consultation/' . $file))->stream('download.pdf');
    // // dd($file);
    }

    
    public function upload_view_transaction($id){
            $file = Transaction::Where('id', $id)->first();
            return Response::make(file_get_contents(public_path('consultation/' . $file->file)), 200, [
                'content-type'=>'application/pdf',
            ]);
    
    }
}
