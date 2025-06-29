@extends('admin.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">
            <div class="d-flex align-items-center mb-4 border-bottom pb-2">
                <i class="fas fa-clipboard-list fa-lg text-primary me-2"></i>
                <h2 class="m-0 text-dark fw-semibold">Laporan Absensi</h2>
            </div>

            {{-- Filter Form --}}
            <form action="/admin/laporan-absensi" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                        class="form-control bg-light border-1">
                </div>
                <div class="col-md-4">
                    <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                        value="{{ request('tanggal_selesai') }}" class="form-control bg-light border-1">
                </div>
                <div class="col-md-4">
                    <label for="jenisAbsen" class="form-label fw-semibold">Jenis Absensi</label>
                    <select name="jenisAbsen" id="jenisAbsen" class="form-select bg-light border-1">
                        <option value="">-- Semua Jenis --</option>
                        @foreach ($listJenisAbsen as $jenis)
                            <option value="{{ $jenis }}" {{ request('jenisAbsen') == $jenis ? 'selected' : '' }}>
                                {{ ucfirst($jenis) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="idSubstansi" class="form-label fw-semibold">Substansi</label>
                    <select name="idSubstansi" id="idSubstansi" class="form-select bg-light border-1">
                        <option value="">-- Semua Substansi --</option>
                        @foreach ($listSubstansi as $substansi)
                            <option value="{{ $substansi->idSubstansi }}"
                                {{ request('idSubstansi') == $substansi->idSubstansi ? 'selected' : '' }}>
                                {{ $substansi->namaSubstansi }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-12 d-flex justify-content-between mt-2">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="/admin/cetak-absensi?{{ http_build_query(request()->all()) }}" class="btn btn-success">
                        <i class="fas fa-print me-1"></i> Cetak PDF
                    </a>
                </div>
            </form>

            {{-- Tabel Laporan --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 15%">NIP</th>
                            <th style="width: 25%">Nama Lengkap</th>
                            <th style="width: 15%">Jabatan</th>
                            <th style="width: 15%">Substansi</th>
                            <th style="width: 10%">Jenis Absen</th>
                            <th style="width: 10%">Tanggal</th>
                            <th style="width: 10%">Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $data)
                            <tr>
                                <td class="text-center">{{ $data->pegawai->nip ?? '-' }}</td>
                                <td>{{ $data->pegawai->namaLengkap ?? '-' }}</td>
                                <td>{{ $data->pegawai->jabatan ?? '-' }}</td>
                                <td>{{ $data->pegawai->substansi->namaSubstansi ?? '-' }}</td>
                                <td class="text-center">{{ $data->absen->jenisAbsen ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Tidak ada data absensi tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
