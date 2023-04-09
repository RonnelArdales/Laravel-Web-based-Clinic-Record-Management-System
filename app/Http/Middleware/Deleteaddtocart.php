<?php

namespace App\Http\Middleware;

use App\Models\Addtocartservice;
use Closure;
use Illuminate\Http\Request;

class Deleteaddtocart
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
        $addtocart = Addtocartservice::count();
        if($addtocart != 0){
            Addtocartservice::truncate();
            return $next($request);  
        }else{
            return $next($request);  
        }
    }
}
