<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $timeout = config('session.lifetime') * 60;
            $lastActivity = Session::get('lastActivityTime');
            $currentTime = now()->timestamp;

            if ($lastActivity && ($currentTime - $lastActivity > $timeout)) {
                Auth::logout();
                Session::flush();
                return redirect('/')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            Session::put('lastActivityTime', $currentTime);
        }

        return $next($request);
    }
}
