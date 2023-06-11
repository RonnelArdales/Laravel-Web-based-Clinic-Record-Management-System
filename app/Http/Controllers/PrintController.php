<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Billing;
use App\Models\Consultation;
use App\Models\Consultationfile;
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
use Illuminate\Support\Facades\Hash;
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

        if($request->input('fullname')){
            $username =  $request->input('fullname');
            $audits = AuditTrail::where('username', 'LIKE', "%".$username."%")->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.audittrail', array('audits' => $audits));
            return $pdf->stream('Audit_trail.pdf');
        }elseif($request->input('status')){
            $status =  $request->input('status');
            $audits = AuditTrail::where('usertype', $status)->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.audittrail', array('audits' => $audits));
            return $pdf->stream('Audit_trail.pdf');
        }elseif($request->input('start_date') && $request->input('end_date')){
            $startDate = $request->input('start_date');
            $concatStart = $startDate . " " . "00:00:00";
          $endDate = $request->input('end_date');
          $concatEnd = $endDate . " " . "23:59:59";
            $audits =  AuditTrail::whereBetween('created_at', [$concatStart, $concatEnd])->get();
            $pdf = Pdf::loadView('print.audittrail', array('audits' => $audits));
            return $pdf->stream('Audit_trail.pdf');
        }else{
            $audits = DB::table('audit_trails')->orderby('created_at', 'DESC')->get();
            $pdf = Pdf::loadView('print.audittrail', array('audits' => $audits));
            return $pdf->stream('Audit_trail.pdf');
        }


     
    }

    public function print_appointment(Request $request){
       

        if($request->input('fullname')){
            $name =  $request->input('fullname');
            $appointments =  $appointments = Appointment::where('fullname', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.appointment', compact( 'appointments'))->setPaper('A4','landscape');
            return $pdf->stream('appointment.pdf');
        }elseif($request->input('status')){
            $status =  $request->input('status');
            $appointments = Appointment::where('status', $status)->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.appointment', compact( 'appointments'))->setPaper('A4','landscape');
            return $pdf->stream('appointment.pdf');
        }elseif($request->input('start_date') && $request->input('end_date')){
            $startDate = $request->input('start_date');
            $concatStart = $startDate . " " . "00:00:00";
          $endDate = $request->input('end_date');
          $concatEnd = $endDate . " " . "23:59:59";
            $appointments =  Appointment::whereBetween('created_at', [$concatStart, $concatEnd])->get();
            $pdf = Pdf::loadView('print.appointment', compact( 'appointments'))->setPaper('A4','landscape');
            return $pdf->stream('appointment.pdf');
        }else{
            $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('print.appointment', compact( 'appointments'))->setPaper('A4','landscape');
            return $pdf->stream('appointment.pdf');
        }


  


        // $pdf->setEncryption('123' );
        // $pdf->adminUsername('123' );
        // return $pdf->download('invoice.pdf');
        // $pdf = Pdf::loadFile(public_path().'/jg.png')->stream('try.pdf');

        // file_put_contents('output.pdf', $pdf->output());
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // $pdf->setEncryption($password);
        // return $pdf->download('invoice.pdf');
    }

    public function print_billing(Request $request){
    
        if($request->input('fullname')){

            $name =  $request->input('fullname');
            $billings = Transaction::where('fullname', 'LIKE', "%".$name."%")->orderBy('created_at', 'desc')->get();
            $sum = Transaction::where('fullname', 'LIKE', "%".$name."%")->sum('total');
            $pdf = Pdf::loadView('print.billing', compact('billings', 'sum'))->setPaper('A4','landscape');
            return $pdf->stream('billing.pdf');
        }elseif($request->input('status')){
            $status =  $request->input('status');
            $billings = Transaction::where('status', $status)->orderBy('created_at', 'desc')->get();
            $sum = Transaction::where('status', $status)->sum('total');
            $pdf = Pdf::loadView('print.billing', compact('billings', 'sum'))->setPaper('A4','landscape');
            return $pdf->stream('billing.pdf');
        }elseif($request->input('start_date') && $request->input('end_date')){
            $startDate = $request->input('start_date');
            $concatStart = $startDate . " " . "00:00:00";
          $endDate = $request->input('end_date');
          $concatEnd = $endDate . " " . "23:59:59";
           $billings =  Transaction::whereBetween('created_at', [$concatStart, $concatEnd])->get();
           $sum =  Transaction::whereBetween('created_at', [$concatStart, $concatEnd])->sum('total');
            $pdf = Pdf::loadView('print.billing', compact('billings', 'sum'))->setPaper('A4','landscape');
            return $pdf->stream('billing.pdf');
        }elseif($request->input('mop')){
            $mop =  $request->input('mop');
            $billings = Transaction::where('mode_of_payment', $mop)->orderBy('created_at', 'desc')->get();
            $sum = Transaction::where('mode_of_payment', $mop)->sum('total');
            $pdf = Pdf::loadView('print.billing', compact('billings', 'sum'))->setPaper('A4','landscape');
            return $pdf->stream('billing.pdf');
        }else{

            
            $billings = DB::table('transactions')->orderBy('created_at', 'desc')->get();
            $sum =  Transaction::sum('total');
            $pdf = Pdf::loadView('print.billing', compact('billings', 'sum'))->setPaper('A4','landscape');
            return $pdf->stream('billing.pdf');
        }
    }


    public function upload_download_transaction($id){

        if(Auth::user()->usertype == "admin"){
             $file = Transaction::Where('id', $id)->first();
             return response()->download(public_path('consultation/' . $file->file));
        }else{
            $file = Transaction::Where('id', $id)->first();
            return response()->download(public_path('consultation/' . $file->file));
        }
       
    }

    


    public function print_invoice($id){

        if(Auth::user()->usertype == "patient"){
            $infos = Transaction::with('user')->where('transno', $id)->first();
            $services = Transaction::where('transno', $id)->get();
            $pdf = Pdf::loadView('print.invoice', compact('services', 'infos'));
            return $pdf->stream('Invoice.pdf');
        }else{
            $infos = Transaction::with('user')->where('transno', $id)->first();
            $services = Transaction::where('transno', $id)->get();
            $pdf = new Dompdf();
            $options = new Options();
            $options->set('font_dir', public_path('fonts/Inter-VariableFont_slnt,wght.ttf'));
            $options->set('default_font', 'inter');
            $pdf->setOptions($options);

            $pdf = Pdf::loadView('print.invoice', compact('services', 'infos'));
            return $pdf->stream('Invoice.pdf');
        }

    }
    public function print_appointment_trans($id){
        if(Auth::user()->usertype == "patient"){
            $appointments = Appointment::Where('id', $id)->first();
            $pdf = Pdf::loadView('print.appointment_invoice', compact('appointments'));
            return $pdf->stream('Invoice.pdf');
        }else{
            $appointments = Appointment::Where('id', $id)->first();
            $pdf = Pdf::loadView('print.appointment_invoice', compact('appointments'));
            return $pdf->stream('Invoice.pdf');
        }
    }

    public function print_consultation_result($id, Request $request){
        $consultations = Consultation::where('id', $id)->first();
        $userinfo = User::where('id', $consultations->user_id)->first();
        $filename = $consultations->fullname . "_" . $consultations->date;    
        if($request->input('type') == 'encrypt'){
            $userpass = $request->input('userpass');
            $adminpass = $request->input('adminpass');
            $pdf = PDF::loadView('print.consultation_result', compact('consultations', 'userinfo'));
            $pdf->setEncryption($userpass, $adminpass);
            return $pdf->download($filename . '.pdf');
        }else{
            $pdf = PDF::loadView('print.consultation_result', compact('consultations', 'userinfo'));
             return $pdf->stream( $filename . '.pdf');
        }
        
    }

    public function download_transaction($id){

    $file = Consultationfile::where('id', $id)->first();

    return response()->download(public_path('consultation/' . $file->filename));

    }

}
