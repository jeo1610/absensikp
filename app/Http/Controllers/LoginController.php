<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Pegawai;

class LoginController extends Controller
{
    public function showLogin()
    {
        $title = 'Login';
        return view('login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,pegawai',
        ]);
        $username = $request->username;
        $password = $request->password;
        $role = $request->role;
        if ($role === 'admin') {
            $admin = Admin::where('username', $username)->first();
            if ($admin && Hash::check($password, $admin->password)) {
                Session::put('logged_in', true);
                Session::put('role', 'admin');
                Session::put('user', $admin);
                return redirect('/admin/dashboard');
            }
        }
        if ($role === 'pegawai') {
            $pegawai = Pegawai::where('nip', $username)->first();
            if ($pegawai && Hash::check($password, $pegawai->password)) {
                Session::put('logged_in', true);
                Session::put('role', 'pegawai');
                Session::put('user', $pegawai);
                return redirect('/pegawai/dashboard');
            }
        }
        return redirect()->back();
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
