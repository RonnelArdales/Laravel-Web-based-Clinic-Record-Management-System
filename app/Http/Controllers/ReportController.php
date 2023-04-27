<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Billing;
use App\Models\Modeofpayment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function view_user(){
        $users = DB::table('users')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
        return view('reports.users', compact('users'));
    }

    public function view_auditTrail(){
        $audits = DB::table('audit_trails')->orderBy('created_at', 'desc')->paginate(12, ['*'], 'audits');

        return view('reports.audittrail', compact('audits'));
        
    }


    public function view_appointment(Request $request){
        $mops = Modeofpayment::all();
        $appointments = Appointment::orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments');
        return view('reports.appointment', compact('appointments', 'mops'));
    }
    public function view_Billing(){
        $mops = Modeofpayment::all();
        $billings = Transaction::orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings');
        return view('reports.billing', compact('billings', 'mops'));
    }
}
