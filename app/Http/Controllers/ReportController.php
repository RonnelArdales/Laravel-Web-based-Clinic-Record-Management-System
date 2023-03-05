<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function view_user(){
        $users = User::all();
        return view('reports.users', compact('users'));
    }


}
