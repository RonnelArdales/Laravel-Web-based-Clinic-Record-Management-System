<?php

namespace App\Http\Controllers\system_settings;
use App\Http\Controllers\Controller;
use App\Models\Reservationfee;
use App\Services\AuditTrailService;
use Illuminate\Http\Request;

class ReservationfeeController extends Controller
{
    public function index(){
        $reservationfee = Reservationfee::first();
        return view('system_settings.reservationfee', compact('reservationfee'));
    }

    public function update(Reservationfee $reservationfee, Request $request){
        $validated = $request->validate([
            "newfee" => ['required'],
        ],[
            'newfee.required' => 'Reservation fee is required',
        ]);
     
        $reservationfee->update(['reservationfee' => $request->input('newfee')]);
        
        (new AuditTrailService())->store('Update reservation fee');

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
