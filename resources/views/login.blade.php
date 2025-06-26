<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-dark: #0a3d62;
            --blue-light: #74b9ff;
            --bg-gradient: linear-gradient(135deg, var(--blue-light), #dbeeff);
            --white: #ffffff;
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* Marquee */
        .marquee-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            background-color: var(--blue-dark);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .marquee-container {
            white-space: nowrap;
            overflow: hidden;
        }

        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 18s linear infinite;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--white);
            padding: 0.75rem 0;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .card {
            border-radius: 1rem;
            background-color: var(--white);
            border: none;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h4 {
            color: var(--blue-dark);
            font-weight: 600;
        }

        .form-label {
            color: var(--blue-dark);
            font-weight: 500;
        }

        .form-control,
        .form-select {
            background-color: #f8fbff;
            border-color: #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--blue-dark);
            box-shadow: 0 0 0 0.2rem rgba(10, 61, 98, 0.25);
        }

        .input-group-text {
            background-color: #f8fbff;
            border-left: 0;
            cursor: pointer;
            color: var(--blue-dark);
        }

        .input-group .form-control {
            border-right: 0;
        }

        .btn {
            transition: all 0.2s ease-in-out;
            font-weight: 500;
            border-radius: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--blue-dark);
            border-color: var(--blue-dark);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--blue-light);
            border-color: var(--blue-light);
        }

        .btn-secondary {
            background-color: var(--blue-light);
            border-color: var(--blue-light);
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: var(--blue-dark);
            border-color: var(--blue-dark);
        }

        .alert-danger {
            background-color: #ffe5e5;
            border-color: #ffcccc;
            color: #a94442;
            font-size: 0.95rem;
            border-radius: 0.5rem;
        }

        @media (max-width: 576px) {
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-grid.gap-2 {
                gap: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="marquee-wrapper">
        <div class="marquee-container">
            <span class="marquee-text">
                Selamat datang di Sistem Absensi Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu!
                Silakan lakukan absensi Anda.
            </span>
        </div>
    </div>

    <div class="card mt-5">
        <h4 class="text-center mb-4">Login Sistem</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username / NIP</label>
                <input type="text" class="form-control" name="username" id="username"
                    placeholder="Masukkan username atau NIP" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="••••••••"
                        required>
                    <span class="input-group-text" onclick="togglePassword()" title="Tampilkan Sandi">
                        <i id="toggleIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">Peran</label>
                <select name="role" class="form-select" id="role" required>
                    <option value="" disabled selected>-- Pilih Peran --</option>
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </button>

                <a class="btn btn-secondary text-center" href="/">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            toggleIcon.classList.toggle("fa-eye");
            toggleIcon.classList.toggle("fa-eye-slash");
        }
    </script>
</body>

</html>
