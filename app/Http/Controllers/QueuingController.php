<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class QueuingController extends Controller
{
     //----------------------quueing ------------------------//
     public function view_queuing(Request $request){

        if ($request->ajax()) {
            $data = DB::table('appointments')->where('status', 'pending')->whereDate('date', '=', date('Y-m-d'))->whereDate('time', '>', date('H:i:s'))
            ->orderBy('time', 'asc');
            return Datatables::of($data)
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
                    ->make(true);
        }
        
        return view('admin_secretary.queuing');
    }

    public function upcoming_queuing(Request $request){

            if ($request->ajax()) {
                $data = DB::table('appointments')->where('status', 'pending')->whereDate('date', '>', date('Y-m-d'))->whereDate('time', '>', date('H:i:s'))
                ->orderBy('date', 'asc');
                return Datatables::of($data)
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
                ->make(true);
            }
    }
}
