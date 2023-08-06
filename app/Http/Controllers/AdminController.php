<?php

namespace App\Http\Controllers;

use App\Models\Addtocartservice;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;

class AdminController extends Controller
{

    public function dashboard(){

        $appointments =  DB::table('appointments')->where('status', 'Booked')->whereDate('date', '>', date('Y-m-d'))
        ->orderBy('date', 'asc')->limit(3)->get();

        $latestuser = User::orderBy('created_at', 'desc')->take(7)->get();

        $transaction = Transaction::select(DB::raw('SUM(total) as total'))->whereYear('created_at', date('Y'))->groupBy(DB::raw('MONTH(created_at)'))->pluck('total');

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
            MONTH(created_at) as month, 
            COUNT(CASE WHEN gender = "Male" THEN 1 ELSE NULL END) as "male", 
            COUNT(CASE WHEN gender = "Female" THEN 1 ELSE NULL END) as "female", 
            COUNT(*) as "all"')
            ->whereNotNull('primary_diag')
            ->whereYear('created_at', '=',  date('Y') )
            ->groupBy('primary_diag', 'month')
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
        $totaltransaction = Transaction::whereDate('created_at', Carbon::today())->sum('total');
        $totalappointment = Appointment::whereDate('created_at', Carbon::today())->sum('reservation_fee');
        $totalsales = intval($totalappointment) + intval($totaltransaction);
        $name = auth()->user()->fname;

        return view('admin.dashboard', compact('totals', 'transactionArray'), ['diagnosis' => $diagnosis, 'males' => $male, 'females' =>$female]) ->with('name', $name)
        ->with('users', $users)
        ->with('pending', $pending)
        ->with('transaction', $totalsales)
        ->with('latests', $latestuser)
        ;
    }

    public function get_filterdata(Request $request){

        $query = Appointment::query();

        if ($request->has('name')) {
            $query->where('fullname', 'like', '%' . $request->input('name') . '%');
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('reports.searchresult.appointment_result', compact('appointments'))->render();
    }

    public function backup_database(){
        
        $databaseHost = env('DB_HOST');
        $databasePort = env('DB_PORT');
        $databaseName = env('DB_DATABASE');
        $databaseUser = env('DB_USERNAME');
        $databasePassword = env('DB_PASSWORD');

        $mysqli = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);

        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $tables = array();
        $result = $mysqli->query("SHOW TABLES");
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }

        $backupPath = public_path('/backup.sql');
        $backupFile = fopen($backupPath, 'w');

        foreach ($tables as $table) {
            $result = $mysqli->query("SELECT * FROM $table");
            $numColumns = $result->field_count;

            fwrite($backupFile, "DROP TABLE IF EXISTS $table;\n");
            $createTableQuery = $mysqli->query("SHOW CREATE TABLE $table");
            $createTable = $createTableQuery->fetch_assoc();
            fwrite($backupFile, $createTable['Create Table'] . ";\n");

            while ($row = $result->fetch_array()) {
                $rowValues = array();
                for ($i = 0; $i < $numColumns; $i++) {
                    $rowValues[] = "'" . $mysqli->real_escape_string($row[$i]) . "'";
                }
                fwrite($backupFile, "INSERT INTO $table VALUES (" . implode(',', $rowValues) . ");\n");
            }

            fwrite($backupFile, "\n");
        }

        fclose($backupFile);
        $mysqli->close();

        return response()->download($backupPath)->deleteFileAfterSend(true);
    }

}