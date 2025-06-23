<?php

namespace App\Http\Controllers;

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
        return view('pegawai.dashboard', compact('title', 'user'));
    }

    public function riwayat($nip)
    {
        $title = 'Riwayat Absensi';
        $user = session('user');
        $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
        $absensi = Melakukan::where('nip', $nip)
            ->with('absensi')
            ->orderByDesc('created_at')
            ->get();
        return view('pegawai.riwayat', compact('title', 'user', 'pegawai', 'absensi'));
    }

    public function scanQr(Request $request)
    {
        $idAbsensi = $request->query('idAbsensi');
        $nip = session('user.nip');
        if (!in_array($idAbsensi, ['1', '2']) || !$nip) {
            return redirect('/pegawai/dashboard');
        }
        $absensi = Absensi::find($idAbsensi);
        if (!$absensi || !$absensi->status_qr) {
            return redirect()->route('pegawai.dashboard');
        }
        $title = 'Scan QR Code';
        return view('pegawai.scan-qr', compact('title', 'idAbsensi', 'nip'));
    }

    public function prosesAbsensi(Request $request)
    {
        $code = $request->query('code');
        $idAbsensi = $request->query('idAbsensi');
        $nip = $request->query('nip');
        if (!$code || !$idAbsensi || !$nip) {
            return redirect()->route('pegawai.dashboard');
        }
        $expectedPath = parse_url(route('pegawai.scan.qr', ['idAbsensi' => $idAbsensi]), PHP_URL_PATH);
        $parsedCodePath = parse_url($code, PHP_URL_PATH);
        if ($parsedCodePath !== $expectedPath) {
            return redirect()->route('pegawai.dashboard');
        }
        $absensi = Absensi::find($idAbsensi);
        if (!$absensi || !$absensi->status_qr) {
            return redirect()->route('pegawai.dashboard');
        }
        $alreadyAbsen = Melakukan::where('nip', $nip)
            ->where('idAbsensi', $idAbsensi)
            ->whereDate('created_at', now()->toDateString())
            ->exists();
        if ($alreadyAbsen) {
            return redirect()->route('pegawai.dashboard');
        }
        Melakukan::create([
            'nip' => $nip,
            'idAbsensi' => $idAbsensi,
        ]);
        return redirect()->route('pegawai.dashboard');
    }
}
