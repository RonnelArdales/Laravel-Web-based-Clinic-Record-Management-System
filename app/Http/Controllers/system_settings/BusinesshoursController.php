<?php

namespace App\Http\Controllers\system_settings;

use App\Models\AuditTrail;
use App\Models\BusinessHour;
use App\Models\Dayoff_date;
use App\Services\system_settings\BusinessHoursService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\http\Controllers\Controller;
use App\Services\AuditTrailService;

class BusinesshoursController extends Controller
{
    public function index(){
        $hours = BusinessHour::where('day', 'Monday')->whereNotIn('from', ['23:59:00'])->orderBy('from', 'asc')->get();
        $day = BusinessHour::where('day', 'Monday')->select('day', 'off')->distinct()->get();
        $off_dates = Dayoff_date::get();
        return view('system_settings.businesshours', ['hours' =>$hours, "days" => $day, 'offdates' => $off_dates]);
    }

    public function store_businesshours_day(Request $request){
        $validator = Validator::make($request->all(), [
            'business_date'=>'required',
            'business_time' => 'required',
        ],[
            'business_date.required' => 'day is required',
            'business_time.required' => 'time is required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }else{

            (new BusinessHoursService())->store_hour($request->only(['business_date', 'business_time']));
          
            return response()->json(['status' => 'created successfully']);
        }

    }

    public function store_businesshours_date(Request $request){

        (new BusinessHoursService())->store_date($request->only('date'));

        return Response()->json('created successfully');
    }

    
    public function delete_businesshours_day(Request $request){

        $data = BusinessHour::whereIn('id', $request->day_id)->delete();

        (new AuditTrailService())->store('Delete business hours');

        return response()->json([
            "status" => "deleted successfully",
        ]);
    }

    public function delete_businesshours_date(Request $request){

        $data = Dayoff_date::whereIn('id', $request->date_id)->delete();

        (new AuditTrailService())->store('Delete dates');

        return response()->json([
                "status" => "deleted successfully",
            ]);
    }

    public function off_status(Request $request ){

        $status = (new BusinessHoursService())->off_status($request->only(['status', 'day_id']));

        return response()->json(['status' => $status ]);
    }

    public function get_hours(Request $request){
        $businessdays = $request->only('businessdays');
        $hours = BusinessHour::where('day', $businessdays)->whereNotIn('from', ['23:59:00'])->orderBy('from', 'asc')->get();
        $days = BusinessHour::where('day', $businessdays)->select('day', 'off')->distinct()->get();
        return view('pagination.businesshours_table', compact('hours', 'days'))->render();
    }    


}
