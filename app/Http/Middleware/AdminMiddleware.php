<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('masuk')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}