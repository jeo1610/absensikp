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
        return view('/admin/dashboard', compact('title'));
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

    // public function cetak(Request $request)
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
    //     $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan-pdf', compact('title', 'laporan'));
    //     return $pdf->stream('laporan-absensi.pdf');
    // }
}
