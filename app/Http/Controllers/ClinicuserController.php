<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ClinicuserController extends Controller {

  //routes
    public function confirmemail(){
      return view('auth.confirmemail');
    }

    public function identify(){
      return view('/');
    }

}
