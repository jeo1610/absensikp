<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role  Role yang diizinkan (admin atau pegawai)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!Session::has('logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($role && Session::get('role') !== $role) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
