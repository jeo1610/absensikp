<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- HTML5 QR Code Scanner -->
    <script src="/js/html5-qrcode.min.js" defer></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/css/pegawai-style.css">

</head>

<body>
    @include('pegawai/layouts/navbarpegawai')

    <div class="container py-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>
