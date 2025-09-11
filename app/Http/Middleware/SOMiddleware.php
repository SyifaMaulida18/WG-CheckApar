<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- TAMBAHKAN BARIS INI
use Symfony\Component\HttpFoundation\Response;

class SOMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'so') {
            return $next($request);
        }

        // Redirect jika tidak memenuhi syarat sebagai SO
        return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya untuk Safety Officer.');
    }
}