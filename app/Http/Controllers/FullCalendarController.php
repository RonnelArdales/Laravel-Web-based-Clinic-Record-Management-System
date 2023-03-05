<?php

namespace App\Http\Controllers;

use App\Mail\patientbook;
use App\Models\Appointment;
use App\Models\Appointmentnew;
use App\Models\BusinessHour;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FullCalendarController extends Controller
{
    public function index()
    {
        return view('calendar.appointment');
        // $businessHours = BusinessHour::all();
        // return view('appointments.business_hours', compact('businessHours'));
    }

    public function index_businesshour(){
        $businessHours = BusinessHour::all();
        $appointment = Appointmentnew::select('time', 'date')->get();
        $service = Service::all();
        return view('calendar.businesshour', compact('businessHours'))->with('services', $service)->with('appointments', $appointment);
    }

    public function store(Request $request){
        // dd($request);
        // return view('full-calendar');
        
        $start = $request->start;
        
        $day = date('l', strtotime($start));
        $try = date('Y-m-d', strtotime($start));
        
        $workinghours = BusinessHour::where('day', '=', $day)->get();

        
    session([
        'datetodays' => $request->start,
        'workinghours' => $workinghours,
             'datetoday' => date('m-d-Y', strtotime($request->start)),
            
                                            ]);                                      

    return url('/patient/appointment/business-hour');
            
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

        $validator = Validator::make($request->all(), [
            "service" => ['required'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{

         
            $appointment = new Appointment();
            $appointment->user_id = Auth::user()->id;
            $appointment->fullname = Auth::user()->fname.' '.Auth::user()->mname.' '.Auth::user()->lname  ;
            $appointment->address =  Auth::user()->address;
            $appointment->email =  Auth::user()->email;
            $appointment->mobileno =  Auth::user()->mobileno;
            $appointment->date =  $request->input('date');
            $appointment->time = $request->input('time');
            $appointment->service = $request->input('service');
            $appointment->price = $request->input('price');
            $appointment->status = "Pending";
            $appointment->save();
            Mail::to('ronnelardales2192@gmail.com')->send(new patientbook);
            return url('/patient/homepage');
        }

       
    }
}
