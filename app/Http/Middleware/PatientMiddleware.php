<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientMiddleware
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
                //middleware  for checking the usertype if admin
                if(Auth::check()) {
                    if(Auth::user()->usertype =='patient'){
                        return $next($request);
                    }else{
                        abort(404);
                    }
                }else{
                    return redirect('/login')->with('message', 'you are not admin');
                }
        return $next($request);
    }
}
