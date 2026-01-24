<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // إذا مش مسجل دخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // إذا مسجل دخول بس مش admin
        if (Auth::user()->role !== 'admin') {

            // Logout فعلي
            Auth::logout();

            // تنظيف السيشن
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // رجوع للاندينج
            return redirect('/')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}

