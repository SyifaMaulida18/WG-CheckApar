<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts dan CSS -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-image: url('/images/gedung-kantor.jpg'); /* Ganti dengan nama file Anda */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #f8f9fa; /* Warna fallback jika gambar gagal dimuat */
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.9); /* Tambahkan transparansi agar gambar latar terlihat */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .text-muted {
            color: #6c757d; /* Memastikan teks tetap terbaca dengan baik */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="jumbotron p-5 text-center">
                        <h1 class="display-4 mb-4 fw-bold">Selamat Datang di Sistem Monitoring APAR</h1>
                        <p class="lead mb-4 text-muted">
                            Aplikasi ini dirancang untuk mendigitalisasi dan mengoptimalkan proses inspeksi Alat Pemadam Api Ringan (APAR) di lokasi Anda.
                        </p>
                        <hr class="my-4">
                        <div class="d-flex justify-content-center my-4">
                            <div class="me-4">
                                <i class="fas fa-user-shield fa-2x text-success"></i>
                                <p class="mt-2 text-muted">Akses untuk Admin</p>
                            </div>
                            <div class="ms-4">
                                <i class="fas fa-fire-extinguisher fa-2x text-danger"></i>
                                <p class="mt-2 text-muted">Akses untuk Safety Officer</p>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Skrip -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
