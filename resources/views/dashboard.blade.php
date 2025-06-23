<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-dark: #0a3d62;
            --blue-light: #74b9ff;
            --text-dark: #2c3e50;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--blue-light), #dbeeff);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            padding-top: 50px;
            /* offset untuk marquee */
        }

        h1,
        h2,
        h3 {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Marquee Fixed */
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
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .center-container {
            min-height: calc(100vh - 70px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            gap: 2rem;
        }

        .btn-login {
            font-size: 1.5rem;
            padding: 0.7rem 1.8rem;
            border-radius: 0.75rem;
            background-color: var(--blue-dark);
            color: #fff;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-login:hover {
            background-color: var(--blue-light);
            transform: translateY(-2px);
            color: #fff;
        }

        @media (max-width: 768px) {
            .marquee-text {
                font-size: 1rem;
                padding: 0.6rem 1rem;
            }

            .btn-login {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>

    <!-- Marquee -->
    <div class="marquee-wrapper">
        <div class="marquee-container">
            <span class="marquee-text py-3">
                Selamat datang di Sistem Absensi Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu!
                Silakan lakukan absensi Anda.
            </span>
        </div>
    </div>

    <!-- Konten Utama -->
    <main class="container">
        <div class="center-container">
            <h1>Absensi Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</h1>
            <a class="btn btn-login" href="/login">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </a>
        </div>
    </main>

</body>

</html>
