<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    public function dataadmin()
    {
        $title = 'Data Admin';
        $admin = Admin::all();
        return view('admin.data-admin', compact('title', 'admin'));
    }

    public function tambahadmin()
    {
        $title = "Tambah Data Admin";
        return view('admin.tambah-data-admin', compact('title'));
    }

    public function kirimadmin(Request $request)
    {
        $validasi = $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|min:8'
        ]);
        $validasi['password'] = Hash::make($validasi['password']);
        Admin::create($validasi);
        return redirect('/admin/data-admin')->with('success', 'Data admin berhasil ditambahkan.');
    }

    public function editadmin($id)
    {
        $title = "Edit Data Admin";
        $admin = Admin::find($id);
        return view('admin.edit-data-admin', compact('title', 'admin'));
    }

    public function updateadmin(Request $request)
    {
        $idAdmin = $request->input('idAdmin');
        $admin = Admin::where('idAdmin', $idAdmin)->firstOrFail();
        $validasi = $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'nullable|min:8'
        ]);
        if (empty($request->input('password'))) {
            $validasi['password'] = $admin->password;
        } else {
            $validasi['password'] = Hash::make($request->input('password'));
        }
        $admin->update($validasi);
        return redirect('/admin/data-admin')->with('success', 'Data admin berhasil diubah.');
    }

    public function deleteadmin($id): RedirectResponse
    {
        Admin::where('idAdmin', $id)->delete();
        return redirect('/admin/data-admin')->with('success', 'Data admin berhasil dihapus.');
    }
}
