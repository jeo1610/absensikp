@extends('admin.layouts.master')

@section('content')
    <div class="bg-white shadow rounded-4 p-4 p-md-5">
        <h4 class="mb-4 text-center text-dark fw-bold">
            <i class="fas fa-user-clock me-2"></i>Form Tambah Pegawai
        </h4>

        <form action="{{ url('/admin/data-pegawai/kirim') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-4">
                <label for="nip" class="form-label text-dark fw-semibold">NIP</label>
                <input type="text" id="nip" name="nip" class="form-control rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" value="{{ old('nip') }}"
                    placeholder="Masukkan NIP Pegawai" required>
            </div>

            <div class="mb-4">
                <label for="namaLengkap" class="form-label text-dark fw-semibold">Nama Lengkap</label>
                <input type="text" id="namaLengkap" name="namaLengkap" class="form-control rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" value="{{ old('namaLengkap') }}"
                    placeholder="Masukkan Nama Lengkap" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label text-dark fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" value="{{ old('email') }}"
                    placeholder="Masukkan Email Aktif" required>
            </div>

            <div class="mb-4">
                <label for="idSubstansi" class="form-label text-dark fw-semibold">Substansi</label>
                <select id="idSubstansi" name="idSubstansi" class="form-select rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" required>
                    <option value="" disabled selected>Pilih Substansi</option>
                    @foreach ($substansilist as $substansi)
                        <option value="{{ $substansi->idSubstansi }}">{{ $substansi->namaSubstansi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="jabatan" class="form-label text-dark fw-semibold">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control rounded-3 px-4 py-2 border-2"
                    style="background-color: #ffffff; border-color: #cccccc;" value="{{ old('jabatan') }}"
                    placeholder="Masukkan Jabatan" required>
            </div>

            <div class="mb-5">
                <label for="password" class="form-label text-dark fw-semibold">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control rounded-start-3 px-4 py-2 border-2" name="password"
                        id="password" style="background-color: #ffffff; border-color: #cccccc;"
                        placeholder="Masukkan Password">
                    <span class="input-group-text bg-white border-2 rounded-end-3 px-4" onclick="togglePassword()"
                        style="cursor: pointer;" title="Tampilkan Sandi">
                        <i id="toggleIcon" class="fa-solid fa-eye text-secondary"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('/admin/data-pegawai') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            toggleIcon.classList.toggle("fa-eye");
            toggleIcon.classList.toggle("fa-eye-slash");
        }

        // Efek fokus input field
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
