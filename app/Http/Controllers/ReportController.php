<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function view_user(){
        $users = User::all();
        return view('reports.users', compact('users'));
    }

    public function view_auditTrail(){
        $audits = DB::table('audit_trails')->orderby('created_at', 'DESC')->get();

        return view('reports.audittrail', compact('audits'));
        
    }

    public function view_appointment(){
        $appointments = Appointment::all();
        return view('reports.appointment', compact('appointments'));
    }


}
