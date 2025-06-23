@extends('pegawai.layouts.master')

@section('title', 'Dashboard Pegawai')

@section('content')

    <h2 class="dashboard-title">Silakan Pilih Jenis Absensi</h2>

    <div class="row g-4">
        <!-- Absen Masuk -->
        <div class="col-md-4">
            <a href="{{ route('pegawai.scan.qr', ['idAbsensi' => 1, 'nip' => $user->nip]) }}" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-sign-in-alt menu-icon"></i>
                    <div class="menu-title">Absen Masuk</div>
                </div>
            </a>
        </div>

        <!-- Absen Keluar -->
        <div class="col-md-4">
            <a href="{{ route('pegawai.scan.qr', ['idAbsensi' => 2, 'nip' => $user->nip]) }}" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    <div class="menu-title">Absen Keluar</div>
                </div>
            </a>
        </div>

        <!-- Riwayat -->
        <div class="col-md-4">
            <a href="/pegawai/riwayat-absensi/{{ $user->nip }}" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-qrcode menu-icon"></i>
                    <div class="menu-title">Riwayat Absensi</div>
                </div>
            </a>
        </div>
    </div>
@endsection
