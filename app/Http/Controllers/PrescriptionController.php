<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function show_prescription(){
        $patients = DB::table('users')->where('usertype', 'patient')->paginate(2, ['*'], 'patient');
        return view('admin.prescription', compact('patients'));
    }
}
