<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Absen;
use App\Models\Admin;
use App\Models\Melakukan;
use App\Models\Pegawai;
use App\Models\Substansi;
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

    public function laporan(Request $request)
    {
        $title = 'Laporan Absensi';

        $query = Melakukan::with(['pegawai.substansi', 'absen'])->orderBy('created_at', 'desc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $end = Carbon::parse($request->tanggal_selesai)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($request->filled('jenisAbsen')) {
            $query->whereHas('absen', function ($q) use ($request) {
                $q->where('jenisAbsen', $request->jenisAbsen);
            });
        }

        if ($request->filled('idSubstansi')) {
            $query->whereHas('pegawai', function ($q) use ($request) {
                $q->where('idSubstansi', $request->idSubstansi);
            });
        }

        $laporan = $query->get();

        $listJenisAbsen = Absen::select('jenisAbsen')->distinct()->pluck('jenisAbsen');
        $listSubstansi = Substansi::orderBy('namaSubstansi')->get();

        return view('admin.laporan', compact('title', 'laporan', 'listJenisAbsen', 'listSubstansi'));
    }

    public function cetak(Request $request)
    {
        $title = 'Laporan Absensi';
        $query = Melakukan::with(['pegawai.substansi', 'absen'])->orderBy('created_at', 'desc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $end = Carbon::parse($request->tanggal_selesai)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($request->filled('jenisAbsen')) {
            $query->whereHas('absen', function ($q) use ($request) {
                $q->where('jenisAbsen', $request->jenisAbsen);
            });
        }

        if ($request->filled('idSubstansi')) {
            $query->whereHas('pegawai', function ($q) use ($request) {
                $q->where('idSubstansi', $request->idSubstansi);
            });
        }

        $laporan = $query->get();

        $pdf = Pdf::loadView('admin.laporan-pdf', compact('title', 'laporan'));
        return $pdf->stream('laporan-absensi.pdf');
    }
}
