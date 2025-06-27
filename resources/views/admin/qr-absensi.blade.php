@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title">QR Code Absensi {{ ucfirst($absensi->jenisAbsen) }}</h2>

    <div class="d-flex justify-content-center mt-5">
        <div class="qr-box text-center m-0 pt-5">
            <div id="qr-code-wrapper">
                {!! QrCode::size(250)->generate($qrUrl) !!}
            </div>
            <p class="text-muted text-center m-0" id="last-updated">Terakhir diperbarui: {{ date('H:i:s') }}</p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/admin/qr-code" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        function refreshQrCode() {
            const qrWrapper = document.getElementById('qr-code-wrapper');
            if (!qrWrapper) return;
            qrWrapper.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Memuat...</span>
            </div>`;
            fetch("/admin/qr-absensi/qr-code-refresh")
                .then(response => response.json())
                .then(data => {
                    qrWrapper.innerHTML = `
                    ${data.html}
                    <p class="qr-text text-${data.color}" id="qr-label">${data.label}</p>
                `;
                    const now = new Date();
                    const timeString = now.toLocaleTimeString('id-ID');
                    const lastUpdated = document.getElementById('last-updated');
                    if (lastUpdated) {
                        lastUpdated.innerText = "Terakhir diperbarui: " + timeString;
                    }
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
