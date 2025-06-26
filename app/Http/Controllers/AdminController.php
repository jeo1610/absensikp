<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Absensi;
use App\Models\Admin;
use App\Models\Melakukan;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';
        return view('admin.dashboard', compact('title'));
    }

    // public function laporan(Request $request)
    // {
    //     $title = 'Laporan Absensi';

    //     $query = Melakukan::with(['pegawai', 'absensi'])->orderBy('created_at', 'desc');

    //     if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
    //         $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
    //         $end = Carbon::parse($request->tanggal_selesai)->endOfDay();
    //         $query->whereBetween('created_at', [$start, $end]);
    //     }

    //     if ($request->filled('jenis_absensi')) {
    //         $query->whereHas('absensi', function ($q) use ($request) {
    //             $q->where('jenisAbsensi', $request->jenis_absensi);
    //         });
    //     }

    //     $laporan = $query->get();

    //     // Ambil daftar jenis absensi unik untuk dropdown
    //     $listJenisAbsensi = Absensi::select('jenisAbsensi')->distinct()->pluck('jenisAbsensi');

    //     return view('admin.laporan', compact('title', 'laporan', 'listJenisAbsensi'));
    // }

    public function cetak(Request $request)
    {
        $title = 'Laporan Absensi';
        $query = Melakukan::with(['pegawai', 'absensi'])->orderBy('created_at', 'desc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $end = Carbon::parse($request->tanggal_selesai)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($request->filled('jenis_absensi')) {
            $query->whereHas('absensi', function ($q) use ($request) {
                $q->where('jenisAbsensi', $request->jenis_absensi);
            });
        }

        $laporan = $query->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan-pdf', compact('title', 'laporan'));
        return $pdf->stream('laporan-absensi.pdf');
    }

    public function datapegawai()
    {
        $title = 'Data Pegawai';
        $pegawai = Pegawai::all();
        return view('admin.data-pegawai', compact('title', 'pegawai'));
    }

    public function tambahpegawai()
    {
        $title = "Tambah Data Pegawai";
        return view('admin.tambah-data-pegawai', compact('title'));
    }

    public function kirimpegawai(Request $request)
    {
        $validasi = $request->validate([
            'nip' => 'required|unique:pegawai,nip|digits:18',
            'namaLengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:pegawai,email',
            'jabatan' => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
            'password' => 'required|min:8'
        ]);
        $validasi['password'] = Hash::make($validasi['password']);
        Pegawai::create($validasi);
        return redirect('/admin/data-pegawai');
    }

    public function editpegawai($id)
    {
        $title = "Edit Data Pegawai";
        $pegawai = Pegawai::find($id);
        return view('admin.edit-data-pegawai', compact('title', 'pegawai'));
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
            'namaLengkap' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('pegawai', 'email')->ignore($pegawai->nip, 'nip')
            ],
            'password' => 'nullable|min:8',
            'jabatan' => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
        ]);
        if (empty($request->input('password'))) {
            $validasi['password'] = $pegawai->password;
        } else {
            $validasi['password'] = Hash::make($request->input('password'));
        }
        $pegawai->update($validasi);
        return redirect('/admin/data-pegawai');
    }

    public function deletepegawai($id): RedirectResponse
    {
        Pegawai::where('nip', $id)->delete();
        return redirect('/admin/data-pegawai');
    }
}
