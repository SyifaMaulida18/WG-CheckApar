<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-image: url('/images/gedung-kantor.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #f8f9fa;
            overflow: hidden;
            display: flex; 
        }
        .transparent-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); 
            z-index: 0;
        }
        .main-content {
            flex-grow: 1;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .content-container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.7); 
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
            min-height: 600px;
        }
        .text-section {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .image-section {
            flex: 1;
            background-color: #e0f2ff; /* Warna latar belakang untuk area gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .image-section img {
            max-width: 100%;
            height: auto;
            position: absolute;
            bottom: 0; /* Posisikan gambar di bagian bawah */
            transform: translateY(10%); /* Geser ke atas sedikit dari bawah */
        }
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }
        p {
            font-size: 1.1rem;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.8rem 2.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .dark-mode-toggle {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            z-index: 20;
        }
    </style>
</head>
<body>
    <div class="transparent-overlay"></div>
    <main class="main-content">
        <div class="content-container">
            <div class="text-section">
                <h1>Digitalisasi<br>Checklist APAR</h1>
                <p>Aplikasi ini dirancang untuk mendigitalisasi dan mengoptimalkan proses inspeksi Alat Pemadam Api Ringan (APAR) di lokasi Proyek Pembangunan Bangunan Wing 1 dan Kawasan Kantor Kementerian PUPR PT Wijauya Karya Gedung.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
            </div>
            <div class="image-section">
                <img src="/images/illustration.png" alt="Ilustrasi"> </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>