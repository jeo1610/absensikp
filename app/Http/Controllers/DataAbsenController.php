<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Melakukan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataAbsenController extends Controller
{
    public function dataabsen()
    {
        $title = 'Data Absen';
        $absen = Absen::all();
        return view('admin.data-absen', compact('title', 'absen'));
    }

    public function tambahabsen()
    {
        $title = "Tambah Data Absen";
        return view('admin.tambah-data-absen', compact('title'));
    }

    public function kirimabsen(Request $request)
    {
        $validasi = $request->validate([
            'jenisAbsen' => 'required|string|max:100',
            'statusQr' => 'required|boolean',
        ]);
        Absen::create($validasi);
        return redirect('/admin/data-absen')->with('success', 'Data absen berhasil ditambahkan.');
    }

    public function editabsen($id)
    {
        $title = "Edit Data Absen";
        $absen = Absen::find($id);
        return view('admin.edit-data-absen', compact('title', 'absen'));
    }

    public function updateabsen(Request $request)
    {
        $idAbsen = $request->input('idAbsen');
        $absen = Absen::where('idAbsen', $idAbsen)->firstOrFail();
        $validasi = $request->validate([
            'jenisAbsen' => 'required|string|max:100',
        ]);
        $absen->update($validasi);
        return redirect('/admin/data-absen')->with('success', 'Data absen berhasil diubah.');
    }

    public function deleteabsen($id): RedirectResponse
    {
        $melakukanCount = Melakukan::where('idAbsen', $id)->count();
        if ($melakukanCount > 0) {
            return redirect('/admin/data-absen')->with('error', 'Data absen tidak bisa dihapus karena memiliki riwayat absensi.');
        }
        Absen::where('idAbsen', $id)->delete();
        return redirect('/admin/data-absen')->with('success', 'Data absen berhasil dihapus.');
    }
}
