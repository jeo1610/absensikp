@extends('admin.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">
            <div class="d-flex align-items-center mb-4 border-bottom pb-2">
                <i class="fas fa-table fa-lg text-primary me-2"></i>
                <h2 class="m-0 text-dark fw-semibold">Data Absen</h2>
            </div>

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

            <div class="mb-3 d-flex justify-content-between">
                <a href="/admin/data-absen/tambah" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Absen
                </a>
                <a href="/admin/dashboard" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 30%">Nama Absen</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absen as $row)
                            <tr>
                                <td class="text-center">{{ $row->jenisAbsen }}</td>
                                <td class="text-center">
                                    <a href="/admin/data-absen/edit/{{ $row->idAbsen }}"
                                        class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/data-absen/delete/{{ $row->idAbsen }}"
                                        class="btn btn-sm btn-outline-danger" title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus absen ini?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Tidak ada data susbtansi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
