@php
    $user = session('user');
@endphp

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top">

    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="fas fa-user-clock me-2"></i>
            {{ Str::limit($user->namaLengkap, 20) }}
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pegawaiNavbar"
            aria-controls="pegawaiNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Collapse -->
        <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="pegawaiNavbar">
            <ul class="navbar-nav align-items-center gap-2 w-100 justify-content-lg-end text-center">
                <li class="nav-item">
                    <a class="nav-link" href="/pegawai/dashboard">
                        <i class="fas fa-home me-1"></i>Home Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pegawai/riwayat-absensi/{{ $user->nip }}">
                        <i class="fas fa-history me-1"></i>Riwayat Absensi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger fw-semibold" href="/logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
