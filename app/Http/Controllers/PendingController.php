<?php

namespace App\Http\Controllers;


use App\Services\PendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingController extends Controller
{

    protected $pendingService;

    public function __construct(PendingService $pendingService)
    {
        $this->pendingService = $pendingService;
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->pendingService->getDataForDatatables();
        }
        if(Auth::user()->usertype == 'admin'){
            return view('admin.pendinguser');
        }else{
            return view('secretary.pendinguser');
        }
    }

    public function update($id){

        $user = $this->pendingService->update($id);

        return response()->json($user);

    }
}
