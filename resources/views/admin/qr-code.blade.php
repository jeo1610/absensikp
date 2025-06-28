@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title">Silakan Pilih Jenis Absensi</h2>

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
        @foreach ($absenlist as $absen)
            <div class="col">
                <a href="/admin/qr-absensi/{{ $absen->jenisAbsen }}/{{ $absen->idAbsen }}" class="text-decoration-none">
                    <div class="menu-card text-center h-100">
                        <i class="fas fa-qrcode menu-icon"></i>
                        <div class="menu-title text-capitalize">QR {{ $absen->jenisAbsen }}</div>
                    </div>
                </a>
            </div>
        @endforeach

        <div class="col">
            <a href="/admin/reset-absensi" class="text-decoration-none">
                <div class="menu-card text-center h-100">
                    <i class="fas fa-sync-alt menu-icon"></i>
                    <div class="menu-title">Reset Absensi</div>
                </div>
            </a>
        </div>
    </div>
@endsection
