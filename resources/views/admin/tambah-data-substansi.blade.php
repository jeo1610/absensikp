@extends('admin.layouts.master')

@section('content')
    <div class="bg-white shadow rounded-4 p-4 p-md-5">
        <h4 class="mb-4 text-center text-dark fw-bold">
            <i class="fas fa-building me-2"></i>Form Tambah Substansi
        </h4>

        <form action="/admin/data-substansi/kirim" method="POST" autocomplete="off">
            @csrf

            <div class="mb-4">
                <label for="namaSubstansi" class="form-label text-dark fw-semibold">Nama Substansi</label>
                <input type="text" id="namaSubstansi" name="namaSubstansi"
                    class="form-control rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" value="{{ old('namaSubstansi') }}"
                    placeholder="Masukkan Nama Substansi" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/admin/data-substansi" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Fokus efek biru gelap pada input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.style.borderColor = '#0a3d62';
                input.style.boxShadow = '0 0 0 0.2rem rgba(10, 61, 98, 0.25)';
            });
            input.addEventListener('blur', () => {
                input.style.borderColor = '#cccccc';
                input.style.boxShadow = 'none';
            });
        });
    </script>
@endpush
