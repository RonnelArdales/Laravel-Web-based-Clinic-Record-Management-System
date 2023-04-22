<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class PdfEncryptionMiddleware
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
        $user = Auth::user();
        $password = $user->password;

        $dompdf = new Dompdf();
        $dompdf->set_option('encryption', 'AES-256');
        $dompdf->set_option('user_password', $password);

        $request->attributes->set('dompdf', $dompdf);

        return $next($request);
       
    }
}
