@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title">QR Code Absensi {{ ucfirst($absensi->jenisAbsen) }}</h2>

    <div class="d-flex justify-content-center">
        <div class="qr-box text-center m-0">
            <p class="text-muted text-center" id="last-updated">Terakhir diperbarui: {{ date('H:i:s') }}</p>

            <div id="qr-code-wrapper">
                {!! QrCode::size(250)->generate($qrUrl) !!}
            </div>

        </div>
    </div>
    
    <p class="qr-text text-center mt-3">
        <i class="fas fa-link text-primary me-1"></i>
        <strong>Link QR:</strong><br>
        <span id="qr-link" class="badge bg-light text-dark px-3 py-2 d-inline-block mt-2 border rounded">
            {{ $qrUrl }}
        </span>
    </p>
    
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
            const qrLink = document.getElementById('qr-link');
            const lastUpdated = document.getElementById('last-updated');

            if (!qrWrapper || !qrLink || !lastUpdated) return;

            qrWrapper.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Memuat...</span>
            </div>`;

            fetch("/admin/qr-absensi/qr-code-refresh")
                .then(response => response.json())
                .then(data => {
                    qrWrapper.innerHTML = `${data.html}
                    <p class="qr-text text-${data.color}" id="qr-label">${data.label}</p>`;

                    qrLink.textContent = data.qrUrl;

                    const now = new Date();
                    lastUpdated.textContent = "Terakhir diperbarui: " + now.toLocaleTimeString('id-ID');
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
