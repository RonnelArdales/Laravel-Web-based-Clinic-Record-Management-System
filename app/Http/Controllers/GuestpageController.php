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
        $about_us_1 = Guestpage::where('title', 'about us 1')->first();
        $about_us_2 = Guestpage::where('title', 'about us 2')->first();
    
        return view('patient.about_us')->with('aboutus1', $about_us_1);
    }
}
