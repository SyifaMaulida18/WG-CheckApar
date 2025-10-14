<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* CSS untuk menyesuaikan tampilan sidebar dan konten utama */
        body {
            overflow-x: hidden; /* Mencegah overflow horizontal pada body */
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            overflow-y: auto; /* Agar sidebar bisa di-scroll jika kontennya panjang */
            transition: transform .3s ease-in-out; /* Animasi untuk sidebar */
            transform: translateX(-100%); /* Sembunyikan sidebar secara default di mobile */
        }
        .sidebar.show {
            transform: translateX(0%); /* Tampilkan sidebar */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /* Penyesuaian untuk konten utama */
        main {
            padding-top: 48px; /* Offset for fixed navbar */
        }

        /* Media queries untuk tampilan desktop */
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0%); /* Selalu tampil di desktop */
                top: 56px; /* Turunkan sedikit agar tidak bertabrakan dengan navbar */
            }
            main {
                margin-left: 17%; /* Berikan ruang untuk sidebar */
            }
        }
        
        .navbar-brand img {
            height: 30px; /* Sesuaikan tinggi logo sesuai kebutuhan */
            width: auto;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                {{-- Tombol untuk menampilkan/menyembunyikan sidebar di mobile --}}
                <button class="navbar-toggler d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
                    {{-- Opsional: Tambahkan teks jika gambar logo tidak dimuat --}}
                    {{-- <span class="d-none d-sm-inline">{{ config('app.name', 'Laravel') }}</span> --}}
                </a>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                    @include('layouts.sidebar')
                @endauth
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>