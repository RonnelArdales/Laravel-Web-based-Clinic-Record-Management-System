<?php

namespace App\Http\Middleware;

use App\Mail\SendVerifycode;
use App\Models\EmailOtp;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if(Auth::user()->emailstatus == 'unverified'){
            $latest_verification_code = EmailOtp::where('email', Auth::user()->email)->latest()->first();
            if($latest_verification_code->expire_at <  Carbon::now()){
                $otp = rand(10, 99999);
                $time = Carbon::now()->addMinute(5);
                EmailOtp::create([
                                    'email' =>  Auth::user()->email,
                                    'verifycode' => $otp,
                                    'expire_at' => $time,
                                ]); 
                Mail::to(Auth::user()->email)->send(new SendVerifycode($otp));
            }
            return redirect('/verify-email-auth');
        }

        if(Auth::user()->status == 'inactive'){
            abort(401);
        }

        return $next($request); 
    }
}
