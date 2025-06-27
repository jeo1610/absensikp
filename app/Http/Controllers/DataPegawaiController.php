<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Substansi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DataPegawaiController extends Controller
{
    public function datapegawai()
    {
        $title = 'Data Pegawai';
        $pegawai = Pegawai::all();
        return view('admin.data-pegawai', compact('title', 'pegawai'));
    }

    public function tambahpegawai()
    {
        $title = "Tambah Data Pegawai";
        $substansilist = Substansi::all();
        return view('admin.tambah-data-pegawai', compact('title', 'substansilist'));
    }

    public function kirimpegawai(Request $request)
    {
        $validasi = $request->validate([
            'nip' => 'required|unique:pegawai,nip|digits:18',
            'idSubstansi' => 'required',
            'namaLengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:pegawai,email',
            'jabatan' => 'required|string|max:100',
            'password' => 'required|min:8'
        ]);
        $validasi['password'] = Hash::make($validasi['password']);
        Pegawai::create($validasi);
        return redirect('/admin/data-pegawai')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function editpegawai($id)
    {
        $title = "Edit Data Pegawai";
        $pegawai = Pegawai::find($id);
        $substansilist = Substansi::all();
        return view('admin.edit-data-pegawai', compact('title', 'pegawai', 'substansilist'));
    }

    public function updatepegawai(Request $request)
    {
        $nip_lama = $request->input('nip_lama');
        $pegawai = Pegawai::where('nip', $nip_lama)->firstOrFail();
        $validasi = $request->validate([
            'nip' => [
                'required',
                'digits:18',
                Rule::unique('pegawai', 'nip')->ignore($pegawai->nip, 'nip')
            ],
            'idSubstansi' => 'required',
            'namaLengkap' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('pegawai', 'email')->ignore($pegawai->nip, 'nip')
            ],
            'password' => 'nullable|min:8',
            'jabatan' => 'required|string|max:100',
        ]);
        if (empty($request->input('password'))) {
            $validasi['password'] = $pegawai->password;
        } else {
            $validasi['password'] = Hash::make($request->input('password'));
        }
        $pegawai->update($validasi);
        return redirect('/admin/data-pegawai')->with('success', 'Data pegawai berhasil diubah.');
    }

    public function deletepegawai($id): RedirectResponse
    {
        Pegawai::where('nip', $id)->delete();
        return redirect('/admin/data-pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
