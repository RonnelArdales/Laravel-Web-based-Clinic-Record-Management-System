<?php

namespace App\Services\system_settings;

use App\Models\BusinessHour;
use App\Models\Dayoff_date;
use App\Services\AuditTrailService;
use Carbon\Carbon;

class BusinessHoursService {

    public function store_hour($data){

        $time = Carbon::createFromFormat('H:i', $data['business_time'])->format('H:i:s');

        $datas = [  'day' => $data['business_date'],
                    'from' => $time,
                    'to' => $time,
                    'step' => 30,
                ];

        $day = BusinessHour::where('day', $data['business_date'])->where('off', '1') ->select('off')->first();

        if($day){
            $datas['off'] = 1;
        }else{
            $datas['off'] = 0;
        }

        BusinessHour::create($datas);

        (new AuditTrailService())->store('Create new business hour');

        return response()->json(['status' => 'none', 'data' => $day]);
    }

    public function store_date($request){

        Dayoff_date::create($request);

    }

    public function off_status($request){
        $status = $request['status'];
        $day = implode($request['day_id']);
        
        if( $status == "checked"){
            BusinessHour::where('day', $day)->update(['off' => 0]);

            $message = "successfully remove off day";

        }else{

            BusinessHour::where('day', $day)->update(['off' => 1]);

            $message = "successfully add off day";

        }

        (new AuditTrailService())->store('Update business hour');

        return $message;
    }


}