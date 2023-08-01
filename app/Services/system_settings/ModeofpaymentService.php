<?php

namespace App\Services\system_settings;

use App\Models\Modeofpayment;
use App\Services\AuditTrailService;
use Illuminate\Support\Facades\File;

class ModeofpaymentService {

    public function store($request, $image){

        $mop = new Modeofpayment();

        if ($image){
            $filename = date('YmdHis'). '.' . $request['image']->getClientOriginalExtension();
            $request['image']->move(public_path('modeofpayment/'), $filename);
            $request['image'] = $filename;
            $mop->image = $request['image'];
        }
    
        $mop->modeofpayment = $request['mop'];
        $mop->save();

        (new AuditTrailService())->store('Create new mode of payment');

        return $request;
    }

    public function update($id, $request, $image){

        $mop = Modeofpayment::where('id', $id)->first();
        $path = public_path('modeofpayment/'.$mop->image);
        
        if($mop){
            $mop->modeofpayment = $request['mop'];
            if($image){
                
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    
                    $filename = date('YmdHis'). '.' . $request['image']->getClientOriginalExtension();
                    $request['image']->move(public_path('modeofpayment/'), $filename);
                    $request['image'] = $filename;
                    $mop->image = $filename;
            }
            $mop->save();

            (new AuditTrailService())->store('Update mode of payment');
            return $path;   
        }
    }

    public function delete($id){
        $mop = Modeofpayment::where('id', $id)->first();
        $path = public_path('modeofpayment/'.$mop->image);
        Modeofpayment::where('id', $id)->delete();

        if(File::exists($path)){
            File::delete($path);
        }

        (new AuditTrailService())->store('Delete mode of payment');

    }
}