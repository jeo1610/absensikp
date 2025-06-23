@extends('pegawai.layouts.master')

@section('title', $title)

@push('styles')
    <style>
        .qr-box {
            width: 100%;
            max-width: 320px;
            margin: auto;
            padding: 0;
            border: 2px dashed var(--blue-dark);
            border-radius: 12px;
            background-color: #fff;
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        #qr-reader {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-custom {
            min-width: 140px;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .qr-box {
                max-width: 280px;
            }

            .btn-custom {
                font-size: 0.9rem;
                min-width: 120px;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush


@section('content')
    <h2 class="dashboard-title text-center my-4">Scan QR Code untuk Absensi</h2>

    {{-- Spinner --}}
    <div id="loading" class="text-center mb-4" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Mengaktifkan kamera...</p>
    </div>

    {{-- QR Reader --}}
    <div class="d-flex justify-content-center mb-4">
        <div class="qr-box shadow" id="qr-container">
            <div id="qr-reader"></div>
        </div>
    </div>

    {{-- Tombol --}}
    <div class="text-center mb-4">
        <button id="start-camera" class="btn btn-primary me-2">Aktifkan Kamera</button>
        <button id="stop-camera" class="btn btn-danger" style="display: none;">Matikan Kamera</button>
    </div>

    {{-- Informasi --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="menu-card text-center shadow p-4 rounded">
                <i class="fas fa-qrcode menu-icon fa-3x text-primary mb-3"></i>
                <div class="menu-title fs-5 mb-2">
                    {{ $idAbsensi == 1 ? 'Absensi Masuk' : 'Absensi Keluar' }}
                </div>
                <p class="mb-1"><strong>NIP:</strong> {{ $nip }}</p>
                <p class="mb-0">
                    <strong>Status QR:</strong>
                    <span class="{{ \App\Models\Absensi::find($idAbsensi)?->status_qr ? 'text-success' : 'text-danger' }}">
                        {{ \App\Models\Absensi::find($idAbsensi)?->status_qr ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startBtn = document.getElementById("start-camera");
            const stopBtn = document.getElementById("stop-camera");
            const loading = document.getElementById("loading");

            let qrReader = null;

            startBtn.addEventListener("click", function() {
                startBtn.disabled = true;
                stopBtn.style.display = "inline-block";
                loading.style.display = "block";

                if (!qrReader) {
                    qrReader = new Html5Qrcode("qr-reader");
                }

                qrReader.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: function(viewfinderWidth, viewfinderHeight) {
                            const minEdge = Math.min(viewfinderWidth, viewfinderHeight);
                            return {
                                width: minEdge * 0.8,
                                height: minEdge * 0.8
                            };
                        },
                        aspectRatio: 1.0
                    },
                    function(decodedText) {
                        qrReader.stop().then(() => {
                            const url =
                                `/pegawai/proses-absensi?code=${encodeURIComponent(decodedText)}&idAbsensi={{ $idAbsensi }}&nip={{ $nip }}`;
                            window.location.href = url;
                        });
                    },
                    function(errorMessage) {
                        // Bisa diabaikan
                    }
                ).then(() => {
                    loading.style.display = "none";
                }).catch(err => {
                    alert("Tidak bisa mengakses kamera: " + err);
                    startBtn.disabled = false;
                    stopBtn.style.display = "none";
                    loading.style.display = "none";
                });
            });

            stopBtn.addEventListener("click", function() {
                if (qrReader) {
                    qrReader.stop().then(() => {
                        qrReader.clear();
                        startBtn.disabled = false;
                        stopBtn.style.display = "none";
                    });
                }
            });
        });
    </script>
@endpush
