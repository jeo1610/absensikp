@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title">Silakan Pilih Jenis Absensi</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">
        <div class="col">
            <a href="/absensi-masuk" class="text-decoration-none">
                <div class="menu-card text-center h-100">
                    <i class="fas fa-sign-in-alt menu-icon"></i>
                    <div class="menu-title">Absen Masuk</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="/absensi-keluar" class="text-decoration-none">
                <div class="menu-card text-center h-100">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    <div class="menu-title">Absen Keluar</div>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="/reset-absensi" class="text-decoration-none">
                <div class="menu-card text-center h-100">
                    <i class="fas fa-sync-alt menu-icon"></i>
                    <div class="menu-title">Reset Absensi</div>
                </div>
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="qr-box" id="qr-container">
            <div id="qr-code-wrapper">
                <div id="qr-code">
                    @if (isset($absensiMasuk) && $absensiMasuk->status_qr)
                        {!! QrCode::size(250)->generate('/pegawai/scan-qr?idAbsensi=1') !!}
                        <p class="qr-text text-success">QR Code Absen Masuk Aktif</p>
                    @elseif (isset($absensiKeluar) && $absensiKeluar->status_qr)
                        {!! QrCode::size(250)->generate('/pegawai/scan-qr?idAbsensi=2') !!}
                        <p class="qr-text text-warning">QR Code Absen Keluar Aktif</p>
                    @else
                        <p class="qr-text text-danger">QR Code belum diaktifkan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <p class="mt-3 text-muted text-center" id="last-updated">Terakhir diperbarui: {{ date('H:i:s') }}</p>
@endsection

@push('scripts')
    <script>
        function refreshQrCode() {
            const qrWrapper = document.getElementById('qr-code-wrapper');

            qrWrapper.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Memuat...</span>
                </div>
            `;

            fetch("/absensi/qr-code-refresh")
                .then(response => response.json())
                .then(data => {
                    qrWrapper.innerHTML = data.html +
                        `<p class="qr-text text-${data.color}" id="qr-label">${data.label}</p>`;

                    const now = new Date();
                    const timeString = now.toLocaleTimeString('id-ID');
                    document.getElementById('last-updated').innerText = "Terakhir diperbarui: " + timeString;
                })
                .catch(err => {
                    qrWrapper.innerHTML = `<p class="text-danger fw-bold">Gagal memuat QR Code.</p>`;
                    console.error("Gagal memperbarui QR Code", err);
                });
        }

        refreshQrCode();
        setInterval(refreshQrCode, 10000);
    </script>
@endpush
