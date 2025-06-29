<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Melakukan;
use App\Models\Pegawai;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Pegawai';
        $user = Session::get('user');
        $absenlist = Absen::where('statusQr', true)->get();
        return view('/pegawai/dashboard', compact('title', 'user', 'absenlist'));
    }

    public function riwayat($nip)
    {
        $title = 'Riwayat Absensi';
        $user = session('user');
        $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
        $absen = Melakukan::where('nip', $nip)
            ->with('absen')
            ->orderByDesc('created_at')
            ->get();
        return view('/pegawai/riwayat', compact('title', 'user', 'pegawai', 'absen'));
    }

    public function scanQr()
    {
        $title = 'Scan QR Code';
        $nip = session('user.nip');
        return view('pegawai.scan-qr', compact('title', 'nip'));
    }


    public function prosesAbsensi(Request $request)
    {
        $code = $request->query('code');
        $nip = $request->query('nip');
        if (!$code || !$nip) {
            return redirect('/pegawai/dashboard')->with('error', 'QR Code tidak valid.');
        }
        $absen = \App\Models\Absen::where('statusQr', true)->first();
        if (!$absen) {
            return redirect('/pegawai/dashboard')->with('error', 'Absensi tidak aktif.');
        }
        $sudahAbsen = \App\Models\Melakukan::where('nip', $nip)
            ->where('idAbsen', $absen->idAbsen)
            ->whereDate('created_at', now()->toDateString())
            ->exists();
        if ($sudahAbsen) {
            return redirect('/pegawai/dashboard')->with('error', 'Anda sudah melakukan absensi hari ini.');
        }
        \App\Models\Melakukan::create([
            'nip' => $nip,
            'idAbsen' => $absen->idAbsen
        ]);
        return redirect('/pegawai/dashboard')->with('success', 'Absensi berhasil dicatat.');
    }
}
