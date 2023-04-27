<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginationController extends Controller
{
    public function appointment_paginate(Request $request){
        $appointments = DB::table('appointments')->orderBy('created_at', 'desc')->paginate(9, ['*'], 'appointment');
            return view('pagination.pagination_appointment', compact('appointments'))->render();
    }

    public function patient_paginate(){
        $patients =  DB::table('users')->where('usertype', 'patient')->orderBy('created_at', 'desc')->paginate(6, ['*'], 'patient');
        return view('pagination.pagination_modalpatient', compact('patients'))->render();
    }

    public function queuing_paginate(){
        $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
        ->orderBy('date', 'asc')->paginate(9, ['*'], 'queuing');
        return view('pagination.pagination_queuing', compact('appointments'))->render();
    }

    public function report_user_paginate(){
        $users =  DB::table('users')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users');
        return view('pagination.report.user', compact('users'))->render();
    }

    public function report_appointment_paginate(){
        $appointments = Appointment::orderBy('created_at', 'desc')->paginate(10, ['*'], 'appointments');
        return view('pagination.report.appointment', compact('appointments'))->render();
    }

    public function report_billing_paginate(){
        $billings = Transaction::orderBy('created_at', 'desc')->paginate(10, ['*'], 'billings');
        return view('pagination.report.billing', compact('billings'))->render();
    }

    public function report_audits_paginate(){
        $audits = DB::table('audit_trails')->orderBy('created_at', 'desc')->paginate(3, ['*'], 'audits');

        return view('pagination.report.audittrail', compact('audits'))->render();
    }

    
}
