@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title">Selamat Datang, Admin!</h2>

    @if (session('error'))
        <div class="alert alert-danger text-center mt-3 mb-0 rounded-0">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success text-center mt-3 mb-0 rounded-0">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <a href="/admin/data-admin" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-user-shield menu-icon"></i>
                    <div class="menu-title">Data Admin</div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/data-pegawai" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-user-clock menu-icon"></i>
                    <div class="menu-title">Data Pegawai</div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/qr-code" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-qrcode menu-icon"></i>
                    <div class="menu-title">QR Code</div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/laporan-absensi" class="text-decoration-none">
                <div class="menu-card text-center">
                    <i class="fas fa-file-alt menu-icon"></i>
                    <div class="menu-title">Laporan Absensi</div>
                </div>
            </a>
        </div>
    </div>
@endsection
