<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background-color: #0a3d62;">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="fas fa-user-shield me-2"></i> Admin Panel
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
            aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="adminNavbar">
            <ul class="navbar-nav align-items-center gap-2 w-100 justify-content-lg-end text-center">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">
                        <i class="fas fa-home me-1"></i>Home Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/data-admin">
                        <i class="fas fa-user-shield me-1"></i>Data Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/data-pegawai">
                        <i class="fas fa-user-clock me-1"></i>Data Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/qr-code">
                        <i class="fas fa-qrcode me-1"></i>QR Code
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/laporan-absensi">
                        <i class="fas fa-file-alt me-1"></i>Laporan Absensi
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
