<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Substansi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataSubstansiController extends Controller
{
    public function datasubstansi()
    {
        $title = 'Data Substansi';
        $substansi = Substansi::all();
        return view('/admin/data-substansi', compact('title', 'substansi'));
    }

    public function tambahsubstansi()
    {
        $title = "Tambah Data Substansi";
        return view('/admin/tambah-data-substansi', compact('title'));
    }

    public function kirimsubstansi(Request $request)
    {
        $validasi = $request->validate([
            'namaSubstansi' => 'required:string|max:100',
        ]);
        Substansi::create($validasi);
        return redirect('/admin/data-substansi')->with('success', 'Data substansi berhasil ditambahkan.');
    }

    public function editsubstansi($id)
    {
        $title = "Edit Data Substansi";
        $substansi = Substansi::find($id);
        return view('/admin/edit-data-substansi', compact('title', 'substansi'));
    }

    public function updatesubstansi(Request $request)
    {
        $idSubstansi = $request->input('idSubstansi');
        $substansi = Substansi::where('idSubstansi', $idSubstansi)->firstOrFail();
        $validasi = $request->validate([
            'namaSubstansi' => 'required|string|max:100',
        ]);
        $substansi->update($validasi);
        return redirect('/admin/data-substansi')->with('success', 'Data substansi berhasil diubah.');
    }

    public function deletesubstansi($id): RedirectResponse
    {
        $pegawaiCount = Pegawai::where('idSubstansi', $id)->count();
        if ($pegawaiCount > 0) {
            return redirect('/admin/data-substansi')->with('error', 'Data substansi tidak bisa dihapus karena masih digunakan oleh data pegawai.');
        }
        Substansi::where('idSubstansi', $id)->delete();
        return redirect('/admin/data-substansi')->with('success', 'Data substansi berhasil dihapus.');
    }
}
