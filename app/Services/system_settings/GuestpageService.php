<?php

namespace App\Services\system_settings;

use App\Services\AuditTrailService;
use Illuminate\Support\Facades\File;

class GuestpageService {

    public function update($guestpage, $request, $image){

        $path = public_path('guestpage/'.$guestpage->image) ;
    
        if($guestpage){
            $guestpage->title = $request['title'];
            $guestpage->content = $request['content']; 
    
            if($request['image_status'] == "remove"){
                if(File::exists($path)){
                    File::delete($path);
                }
                $guestpage->image = "";
            }
    
            if($image){
            
                if(File::exists($path)){
                    File::delete($path);
                }
                $filename = date('YmdHis'). '.' . $request['image']->getClientOriginalExtension();
                $request['image']->move(public_path('guestpage/'), $filename);
                $request['image'] = $filename;
                $guestpage->image = $filename;
            }
            
            $guestpage->save();

            (new AuditTrailService())->store("update guestpage");
    
            
        }

        return $guestpage;
    
    }

}