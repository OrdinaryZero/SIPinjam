<?php

namespace App\Http\Middleware; // <--- INI WAJIB ADA DAN BENAR

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user LOGIN dan ROLE-nya ADMIN
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'ANDA BUKAN ADMIN! DILARANG MASUK.');
        }

        return $next($request);
    }
}