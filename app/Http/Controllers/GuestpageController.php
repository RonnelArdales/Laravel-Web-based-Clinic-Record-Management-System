<?php

namespace App\Http\Controllers;

use App\Models\Guestpage;
use Illuminate\Http\Request;

class GuestpageController extends Controller
{
    public function index_guestpage(){
        $speak_with_you = Guestpage::where('title', 'speak with you')->select('content')->first() ;
        $about_us_1 = Guestpage::where('title', 'about us 1')->first();
        $about_us_2 = Guestpage::where('title', 'about us 2')->first();
        $doctors_info = Guestpage::where('title', 'doctor info')->first();
        $speakingup = Guestpage::where('title', 'why speaking up is important important?')->first();

        return view('Guest_homepage', ['speakwithyou' => $speak_with_you])->with('aboutus1', $about_us_1)
                                                                          ->with('aboutus2', $about_us_2)
                                                                          ->with('doctorsinfo', $doctors_info)
                                                                          ->with('speakingup', $speakingup);
    }

    public function aboutus(){
        $about_us_1 = Guestpage::where('title', 'about us 1')->first();
        $about_us_2 = Guestpage::where('title', 'about us 2')->first();
    
        return view('patient.about_us')->with('aboutus1', $about_us_1)->with('aboutus2', $about_us_2);
    }
}
