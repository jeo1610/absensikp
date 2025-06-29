@php
    $user = session('user');
@endphp

@extends('pegawai.layouts.master')

@section('title', 'Scan QR Code')

@push('styles')
    <style>
        :root {
            --blue-dark: #0a3d62;
            --blue-light: #74b9ff;
            --text-dark: #2c3e50;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(to bottom right, var(--blue-light), #dbeeff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-title {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .qr-container {
            max-width: 400px;
            width: 100%;
            background-color: var(--white);
            padding: 2rem 1.5rem;
            border-radius: 1.25rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
        }

        .qr-box {
            width: 100%;
            padding-top: 100%;
            position: relative;
            border: 2px solid var(--blue-dark);
            border-radius: 1rem;
            background-color: #000;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        #qr-reader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }

        .info-user {
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .info-user p {
            margin: 0.3rem 0;
        }

        .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 600;
        }

        .btn-secondary {
            background-color: var(--blue-dark);
            border-color: var(--blue-dark);
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: var(--blue-light);
            border-color: var(--blue-light);
            color: #fff;
        }

        @media (max-width: 576px) {
            .dashboard-title {
                font-size: 1.5rem;
            }

            .qr-container {
                padding: 1.25rem 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <h2 class="dashboard-title">Scan QR Code untuk Absensi</h2>

    <div class="d-flex justify-content-center">
        <div class="qr-container text-center">
            <p class="text-muted small mb-3">
                Pastikan kamera aktif dan QR berada dalam kotak pemindaian
            </p>

            {{-- QR Scanner --}}
            <div class="qr-box">
                <div id="qr-reader"></div>
            </div>

            {{-- Informasi Pegawai --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center info-user">
                    <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-user-clock me-1"></i>Informasi Pegawai</h6>
                    <p><strong>Nama:</strong> {{ $user->namaLengkap }}</p>
                    <p><strong>NIP:</strong> {{ $user->nip }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/pegawai/dashboard" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
@endsection

@push('scripts')
    <script src="/js/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nip = "{{ $user->nip }}";
            const qrScanner = new Html5Qrcode("qr-reader");

            qrScanner.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: function(viewfinderWidth, viewfinderHeight) {
                        const minEdge = Math.min(viewfinderWidth, viewfinderHeight);
                        return {
                            width: minEdge * 0.8,
                            height: minEdge * 0.8,
                        };
                    }
                },
                function(decodedText) {
                    const url = decodedText.replace("nip=__NIP__", "nip=" + nip);
                    qrScanner.stop().then(() => {
                        window.location.href = url;
                    });
                },
                function(errorMessage) {
                    // console.error(errorMessage);
                }
            ).catch(err => {
                console.error("Kamera gagal dijalankan:", err);
                alert("Gagal mengakses kamera: " + err);
            });
        });
    </script>
@endpush
