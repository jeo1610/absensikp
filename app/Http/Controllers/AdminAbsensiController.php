<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminAbsensiController extends Controller
{
    public function absensi()
    {
        $title = 'Absensi';
        $absensiMasuk = Absensi::find(1);
        $absensiKeluar = Absensi::find(2);
        return view('absensi', compact('title', 'absensiMasuk', 'absensiKeluar'));
    }

    public function qrcode()
    {
        $title = 'QR Code';
        $absensiMasuk = Absensi::find(1);
        $absensiKeluar = Absensi::find(2);
        return view('admin.qr-code', compact('title', 'absensiMasuk', 'absensiKeluar'));
    }

    public function qrCodeRefresh()
    {
        $absensiMasuk = Absensi::find(1);
        $absensiKeluar = Absensi::find(2);

        $baseUrl = str_replace('http://', 'https://', request()->getSchemeAndHttpHost());
        $nip = session('user.nip', '1234567890');

        if ($absensiMasuk && $absensiMasuk->status_qr) {
            $idAbsensi = 1;
        } elseif ($absensiKeluar && $absensiKeluar->status_qr) {
            $idAbsensi = 2;
        } else {
            return response()->json([
                'html' => '<p class="text-danger fw-bold">QR Code tidak tersedia</p>',
                'label' => 'QR Code belum diaktifkan.',
                'color' => 'danger',
            ]);
        }

        // Bangun URL yang akan dikodekan ke QR
        $path = route('pegawai.scan.qr', ['idAbsensi' => $idAbsensi], false);
        $code = $baseUrl . $path;
        $qrUrl = "{$code}?code={$code}&idAbsensi={$idAbsensi}&nip={$nip}";

        // Generate QR dalam format SVG dan ubah jadi base64 untuk stabilitas
        $qrSvg = QrCode::format('svg')->size(250)->generate($qrUrl);
        $qrBase64 = base64_encode($qrSvg);
        $qrHtml = "<img src='data:image/svg+xml;base64,{$qrBase64}' alt='QR Code' width='250' height='250' />";

        return response()->json([
            'html' => $qrHtml,
            'label' => 'QR Code Absen ' . ($idAbsensi === 1 ? 'Masuk' : 'Keluar') . ' Aktif',
            'color' => $idAbsensi === 1 ? 'success' : 'warning',
        ]);
    }


    public function aktifkanAbsenMasuk()
    {
        Absensi::where('idAbsensi', 1)->update(['status_qr' => true]);
        Absensi::where('idAbsensi', 2)->update(['status_qr' => false]);
        return redirect()->route('admin.qr-code');
    }

    public function aktifkanAbsenKeluar()
    {
        Absensi::where('idAbsensi', 1)->update(['status_qr' => false]);
        Absensi::where('idAbsensi', 2)->update(['status_qr' => true]);
        return redirect()->route('admin.qr-code');
    }

    public function resetAbsensi()
    {
        Absensi::whereIn('idAbsensi', [1, 2])->update(['status_qr' => false]);
        return redirect()->route('admin.qr-code');
    }
}
