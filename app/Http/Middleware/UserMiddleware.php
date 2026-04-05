<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('masuk');
        }

        // Cek apakah user adalah user biasa (bukan admin)
        if (Auth::user()->role !== 'user') {
            return redirect()->route('dashboard')
                ->with('error', 'Halaman ini khusus untuk user biasa.');
        }

        return $next($request);
    }
}