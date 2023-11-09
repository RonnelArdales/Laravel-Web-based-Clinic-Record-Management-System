<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Services\AuditTrailService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    
    public function logout(Request $request){
        
        (new AuditTrailService())->store("Logout");

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
