<?php

namespace App\Http\Controllers;

use App\Models\Guestpage;
use Illuminate\Http\Request;

class GuestpageController extends Controller
{
    public function index_guestpage(){
        $speak_with_you = Guestpage::where('title', 'speak with you')->select('content')->first() ;
        return view('Guest_homepage', ['speakwithyou' => $speak_with_you]);
    }

    public function aboutus(){
        return view('patient.about_us');
    }
}
