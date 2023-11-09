<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResetPasswordMiddleware
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
        if(session('isforgotpassword')){
            return redirect('forgot_password/select');
        }
        return $next($request);
    }
}
