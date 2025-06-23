<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BerandaController extends Controller
{
    public function beranda()
    {
        $title = 'Beranda';
        return view('dashboard', compact('title'));
    }
}
