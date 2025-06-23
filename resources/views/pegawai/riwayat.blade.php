@extends('pegawai.layouts.master')

@section('title', $title)

@section('content')
    <div class="container my-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">
            <div class="d-flex align-items-center mb-4 border-bottom pb-2">
                <i class="fas fa-calendar-alt fa-lg text-primary me-2"></i>
                <h2 class="m-0 text-dark fw-semibold">Riwayat Absensi - {{ $user->namaLengkap }}</h2>
            </div>

            <div class="mb-3">
                <a href="{{ route('pegawai.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th class="align-middle text-center" style="width: 20%">Tanggal</th>
                            <th class="align-middle text-center" style="width: 20%">Jenis Absensi</th>
                            <th class="align-middle text-center" style="width: 30%">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi as $row)
                            <tr>
                                <td class="text-center fw-medium">
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                </td>
                                <td class="text-center text-capitalize">
                                    {{ $row->absensi->jenisAbsensi }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada riwayat absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
