<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function print_user(Request $request){
        if($request->input('fullname')){
            $name =  $request->input('fullname');
            $users = User::where('fname', 'LIKE', '%'.$name.'%' )->orWhere('mname', 'LIKE', '%'.$name.'%')->orWhere('lname', 'LIKE', '%'.$name.'%')->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users));
            return $pdf->stream('invoice.pdf');
        }

        if($request->input('usertype')){
            $usertype =  $request->input('usertype');
            $users = User::Where('usertype', $usertype)->get();
            $pdf = Pdf::loadView('print.users', array('userss' => $users));
            return $pdf->stream('invoice.pdf');
        }
    }

    public function upload_download_transaction($id){
    //            return response()->download(public_path('consultation/' . $file));
    // $file = Pdf::loadFile(public_path('consultation/' . $file))->stream('download.pdf');
    // dd($file);
    }

    
    public function upload_view_transaction($id){
        $data = Transaction::where('id', $id)->first();
        return view('admin.viewconsultation', compact('data'));
    }
}
