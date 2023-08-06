<?php

namespace App\Http\Controllers;

use App\Mail\Bookappointment;
use App\Models\Appointment;
use App\Models\Guestpage;
use App\Models\Modeofpayment;
use App\Models\Reservationfee;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{

    public function homepage(){
      
        $speak_with_you = Guestpage::where('title', 'speak with you')->select('content')->first() ;
        $about_us_1 = Guestpage::where('title', 'about us 1')->first();
        $about_us_2 = Guestpage::where('title', 'about us 2')->first();
        $doctors_info = Guestpage::where('title', 'doctor info')->first();
        $speakingup = Guestpage::where('title', 'why speaking up is important important?')->first();
        return view('patient.homepage' , ['speakwithyou' => $speak_with_you])->with('aboutus1', $about_us_1)
                                                                            ->with('aboutus2', $about_us_2)
                                                                            ->with('doctorsinfo', $doctors_info)
                                                                            ->with('speakingup', $speakingup);
    }

    public function index_billing(){
        $billings =  DB::table('transactions')->where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8, ['*'], 'billing');
        return view('patient.billing.index', compact('billings'));
    }

    public function get_mop($id){
        $mop = Modeofpayment::where('modeofpayment', $id)->first();
        return response()->json(['mop' => $mop]);
    }

}
