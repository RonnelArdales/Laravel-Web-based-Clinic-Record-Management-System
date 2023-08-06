<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\Dayoff_date;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{

    public function get_time(Request $request){
        
        $start = $request->start;
        $date = date('m-d-Y', strtotime($start));
        $day = date('l', strtotime($start));
        $day_numeric = date('w', strtotime($start));
        $workinghours = BusinessHour::where('day', $day)->whereNotIn('from', ['23:59:00'])->pluck('from')->toArray();
        $currentappointment = Appointment::where('date', $start)->where('status', 'pending' )->pluck('time')->toArray();
        $availablehours = array_diff($workinghours, $currentappointment);
        $offday = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($offday as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        if(in_array($day_numeric, $day_array)){

            return response()->json(['status' => 405, 'message' => 'This date is not available' ]);

        }else{
            if( empty($availablehours) ){
                return response()->json([
                    'status' => 405,
                    'message' => "Sorry, this date is full",
                    'working hours in specific day' => $workinghours,
                    'available time' => $availablehours
                ]);
            }else{
                return response()->json([
                    'date' => $date,
                    'day' => date('l', strtotime($start)),
                    'working hours in specific day' => $workinghours,
                    'current appointments in date' => $currentappointment,
                    'available_time' => $availablehours]);
            }
    
        }
    }

    public function getprice($servicename, Request $request){
        $price = Service::where('servicename', '=', $servicename )->get('price');
        if ($price){
            return response()->json([
                'price' =>  $price,
                ]);
        }
    }

}
