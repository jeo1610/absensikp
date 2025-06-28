@extends('admin.layouts.master')

@section('content')
    <h2 class="dashboard-title text-center mb-4">
        QR Code Absensi {{ ucfirst($absensi->jenisAbsen) }}
    </h2>

    <div class="d-flex justify-content-center">
        <div class="qr-box text-center m-0 p-4 shadow bg-white rounded" style="max-width: 360px; width: 100%;">
            {{-- Waktu update --}}
            <p class="text-muted small mb-3" id="last-updated">
                Terakhir diperbarui: {{ date('H:i:s') }}
            </p>

            {{-- QR Code --}}
            <div id="qr-code-wrapper" class="mb-3">
                {!! QrCode::size(250)->generate($qrUrl) !!}
            </div>

            {{-- Status --}}
            <p class="qr-text text-success mb-3" id="qr-label">
                QR Code Absensi {{ ucfirst($absensi->jenisAbsen) }} Aktif
            </p>

            {{-- Link QR --}}
            <div class="text-start">
                <label class="fw-semibold text-primary mb-1">
                    <i class="fas fa-link me-1"></i>Link QR:
                </label>
                <div id="qr-link" class="bg-light text-dark p-2 rounded border small"
                    style="word-wrap: break-word; overflow-wrap: break-word;">
                    {{ $qrUrl }}
                </div>
                <button class="btn btn-outline-primary btn-sm mt-2" onclick="copyLink()">Salin Link</button>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/admin/qr-code" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        function refreshQrCode() {
            const qrWrapper = document.getElementById('qr-code-wrapper');
            const qrLink = document.getElementById('qr-link');
            const qrLabel = document.getElementById('qr-label');
            const lastUpdated = document.getElementById('last-updated');

            if (!qrWrapper || !qrLink || !qrLabel || !lastUpdated) return;

            qrWrapper.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Memuat...</span>
            </div>`;

            fetch("/admin/qr-absensi/qr-code-refresh")
                .then(response => response.json())
                .then(data => {
                    qrWrapper.innerHTML = data.html;
                    qrLabel.textContent = data.label;
                    qrLabel.className = `qr-text text-${data.color} mb-3`;
                    qrLink.textContent = data.qrUrl;
                    lastUpdated.textContent = "Terakhir diperbarui: " + new Date().toLocaleTimeString('id-ID');
                })
                .catch(err => {
                    qrWrapper.innerHTML = `<p class="text-danger fw-bold">Gagal memuat QR Code.</p>`;
                    console.error("Gagal memperbarui QR Code", err);
                });
        }

        function copyLink() {
            const linkText = document.getElementById("qr-link").innerText;
            navigator.clipboard.writeText(linkText).then(() => {
                alert("Link QR berhasil disalin!");
            });
        }

        refreshQrCode();
        setInterval(refreshQrCode, 10000);
    </script>
@endpush
