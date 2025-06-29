@php
    $user = session('user');
@endphp

@extends('pegawai.layouts.master')

@section('content')
    <h2 class="dashboard-title">Selamat Datang, {{ Str::limit($user->namaLengkap, 20) }}!</h2>


    <div class="text-center mb-4">
        @if (session('error'))
            <div class="alert alert-danger text-center mt-3 mb-0 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success text-center mt-3 mb-0 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">
        @forelse ($absenlist as $absen)
            <div class="col">
                <a href="/pegawai/scan-qr" class="text-decoration-none">
                    <div class="menu-card text-center h-100">
                        <i class="fas fa-qrcode menu-icon"></i>
                        <div class="menu-title text-capitalize">QR {{ $absen->jenisAbsen }}</div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-4">
                <p>Tidak ada jenis absensi tersedia saat ini.<br>Silakan hubungi administrator</p>
            </div>
        @endforelse

        <div class="col-md-4">
            <a href="/pegawai/riwayat-absensi/{{ $user->nip }}" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-qrcode menu-icon"></i>
                    <div class="menu-title">Riwayat Absensi</div>
                </div>
            </a>
        </div>
    @endsection
