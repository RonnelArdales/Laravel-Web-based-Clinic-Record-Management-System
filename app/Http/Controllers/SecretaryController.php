<?php

namespace App\Http\Controllers;

use App\Mail\Approveaccount;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\BusinessHour;
use App\Models\Consultation;
use App\Models\Dayoff_date;
use App\Models\Discount;
use App\Models\Guestpage;
use App\Models\Reservationfee;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class SecretaryController extends Controller
{


    public function dashboard(){
        
        $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
        ->orderBy('date', 'asc')->limit(3)->get();
        $latestuser = User::orderBy('created_at', 'desc')->take(7)->get();

        $transaction = Transaction::select(DB::raw('SUM(total) as total'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total');

        $transactionArray = $transaction->map(function ($item) {
            return (string) $item;
        })->toArray();

        $try = DB::select(DB::raw('
            SELECT SUM(total) as total, MONTH(created_at) as month FROM (
                SELECT total, created_at FROM transactions WHERE YEAR(created_at) = YEAR(NOW())
                UNION ALL
                SELECT reservation_fee, created_at FROM appointments WHERE YEAR(created_at) = YEAR(NOW())
            ) as combined_totals
            GROUP BY MONTH(created_at)
            ORDER BY MONTH(created_at)
        '));

        $totals = array_column($try, 'total', 'month');

        $gender_records = Consultation::selectRaw('primary_diag, 
        YEAR(created_at) as year,
        COUNT(CASE WHEN gender = "Male" THEN 1 ELSE NULL END) as "male", 
        COUNT(CASE WHEN gender = "Female" THEN 1 ELSE NULL END) as "female", 
        COUNT(*) as "all"')
        ->whereNotNull('primary_diag')
        ->whereYear('created_at', date('Y'))
        ->groupBy('primary_diag', 'year')
        ->get();

        $diagnosis=[];
        $male=[];
        $female=[];
        foreach($gender_records as $gender){
            $diagnosis[]=$gender->primary_diag;
            $male[]=$gender->male;
            $female[]=$gender->female;
        }

        $users = User::all()->count();
        $pending = Appointment::where('status', 'Pending')->count();
        $transaction = Transaction::whereDate('created_at', Carbon::today())->get();
        $appointment = Appointment::whereDate('created_at', Carbon::today())->get();
        $totalappointment = $appointment->sum('reservation_fee');
        $totalbilling = $transaction->sum('total');
        $totalsales = intval($totalappointment) + intval($totalbilling);
        $name= auth()->user()->fname;

        return view('secretary.dashboard', compact('totals', 'transactionArray'), ['diagnosis' => $diagnosis, 'males' => $male, 'females' =>$female])      ->with('name', $name)
        ->with('users', $users)
        ->with('pending', $pending)
        ->with('transaction', $totalsales)
        ->with('latests', $latestuser);

    }

  
}

