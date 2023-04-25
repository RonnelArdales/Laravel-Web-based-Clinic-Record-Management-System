<?php

namespace App\Http\Controllers;

use App\Mail\patientbook;
use App\Models\Appointment;
use App\Models\Appointmentnew;
use App\Models\BusinessHour;
use App\Models\Discount;
use App\Models\Reservationfee;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FullCalendarController extends Controller
{
    public function index(Request $request)         
    {   
        $days = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $services = Service::all();
        $discounts = Discount::all();
        // $reservationfee = Reservationfee::first();
        // dd($reservationfee);
        $day_array = [];
        foreach($days as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        $day = BusinessHour::select('day', 'off')->distinct()->get();
        return view('calendar.appointment', compact('day', 'days', 'services', 'discounts'))->with('day_array', $day_array);
    }

    public function index_businesshour(){
        $businessHours = BusinessHour::all();
        $service = Service::all();
        return view('calendar.businesshour', compact('businessHours'))->with('services', $service);
    }
    public function store(Request $request){
        
        $start = $request->start;
        $date = date('m-d-Y', strtotime($start));
        $day = date('l', strtotime($start));
        $day_numeric = date('w', strtotime($start));
        $workinghours = BusinessHour::where('day', $day)->whereNotIn('from', ['23:59:00'])->pluck('from')->toArray();
        $currentappointment = Appointment::where('date', $start)->pluck('time')->toArray();
        $availablehours = array_diff($workinghours, $currentappointment);
        $offday = BusinessHour::select('day')->where('off', '1')->groupBy('day')->get();
        $day_array = [];
        foreach($offday as $day){
            $day_array[] = date('w', strtotime($day->day));
        }

        if(in_array($day_numeric, $day_array)){

            return response()->json(['status' => 405, 'message' => 'Sorry, this day is off' ]);

        }else{
            if( empty($availablehours) ){
                return response()->json([
                    'status' => 405,
                    'message' => "Sorry, no time available",
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

       
        // return response()->json(['status' => '405',
        //                          'message' => 'this day is off',
        //                          'day-numeric' => $day_numeric,
        //                         ]);

        
    // session([
    //     'datetodays' => $request->start,
    //     'workinghours' => $availablehours,
    //          'datetoday' => date('m-d-Y', strtotime($request->start)),
            
    //                                         ]);                                      

    // return url('/patient/appointment/business-hour');
            
    }

    public function getprice($servicename, Request $request){
            $price = Service::where('servicename', '=', $servicename )->get('price');
            if ($price){
                return response()->json([
                    'price' =>  $price,
                  ]);
            }
    }

    public function create(Request $request){

        $date =  $request->input('date');
        $try = date('Y-m-d');
        $Datename = Carbon::createFromFormat('Y-m-d', $date)->format('l');
        $businessHours = BusinessHour::select('from')->where('day', $Datename)->get();

        return response()->json(['datename' => $Datename, 'businesshours' => $businessHours]);
        //     $appointment->time = $request->input('time');

        // $validator = Validator::make($request->all(), [
        //     "service" => ['required'],
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json([
        //         'status'=>400,
        //         'errors'=> $validator->messages(),
        //     ]);
        // }else{

         
        //     $appointment = new Appointment();
        //     $appointment->user_id = Auth::user()->id;
        //     $appointment->fullname = Auth::user()->fname.' '.Auth::user()->mname.' '.Auth::user()->lname  ;
        //     $appointment->address =  Auth::user()->address;
        //     $appointment->email =  Auth::user()->email;
        //     $appointment->mobileno =  Auth::user()->mobileno;
        //     $appointment->date =  $request->input('date');
        //     $appointment->time = $request->input('time');
        //     $appointment->service = $request->input('service');
        //     $appointment->price = $request->input('price');
        //     $appointment->status = "Pending";
        //     $appointment->save();
        //     Mail::to('ronnelardales2192@gmail.com')->send(new patientbook);
        //     return url('/patient/homepage');
        // }

       
    }
}
