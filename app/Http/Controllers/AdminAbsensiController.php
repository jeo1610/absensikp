<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminAbsensiController extends Controller
{
    public function absensi()
    {
        $title = 'Absensi';
        $absensiMasuk = Absen::find(1);
        $absensiKeluar = Absen::find(2);
        return view('absensi', compact('title', 'absensiMasuk', 'absensiKeluar'));
    }

    public function qrcode()
    {
        $title = 'QR Code';
        $absenlist = Absen::all(); // ambil semua kolom termasuk idAbsen
        return view('admin.qr-code', compact('title', 'absenlist'));
    }

    public function qrCodeRefresh()
    {
        $absensi = Absen::where('statusQr', true)->first();

        if (!$absensi) {
            return response()->json([
                'html' => '<p class="text-danger fw-bold">QR Code tidak tersedia</p>',
                'label' => 'QR Code belum diaktifkan.',
                'color' => 'danger',
            ]);
        }

        $uniqueCode = Str::uuid();
        $url = url('/pegawai/scan-qr?idAbsensi=' . $absensi->idAbsen . '&code=' . $uniqueCode);

        $svg = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(250)->generate($url);
        $base64 = base64_encode($svg);
        $html = "<img src='data:image/svg+xml;base64,{$base64}' alt='QR Code' width='250' height='250' />";

        return response()->json([
            'html' => $html,
            'label' => 'QR Code Absensi ' . ucfirst($absensi->jenisAbsen) . ' Aktif',
            'color' => 'success',
            'qrUrl' => $url
        ]);
    }

    public function tampilkanQrAbsensi($jenis, $id)
    {
        $title = 'QR Code';
        $absensi = Absen::where('idAbsen', $id)
            ->where('jenisAbsen', $jenis)
            ->first();
        if (!$absensi) {
            return redirect('/admin/data-absen')->with('error', 'Data absensi tidak ditemukan.');
        }
        Absen::query()->update(['statusQr' => false]);
        $absensi->update(['statusQr' => true]);
        $qrUrl = url('/pegawai/scan-qr?idAbsensi=' . $absensi->idAbsen);
        return view('admin.qr-absensi', [
            'absensi' => $absensi,
            'qrUrl' => $qrUrl
        ], compact('title'));
    }

    public function resetAbsensi()
    {
        Absen::query()->update(['statusQr' => false]);
        return redirect('/admin/qr-code')->with('success', 'Semua QR absensi telah dinonaktifkan.');
    }
}
