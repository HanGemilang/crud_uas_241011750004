<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StartingVano')</title>
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bg-navy { 
            background-color: #0f1d3a; 
        } 
        .text-blue { 
            color: #d1b442; /* StartingVano Gold Accent */
        }
        .nav-link { 
            font-weight: 600; 
            font-size: 0.85rem; 
            letter-spacing: 1px; 
            transition: 0.3s; 
        }
        .nav-link:hover { 
            color: #d1b442 !important; 
        }
        .footer-text { 
            color: #b0bec5; 
            font-size: 0.9rem; 
            line-height: 1.8; 
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- HEADER & NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" height="45" class="me-3 bg-white p-1 rounded">
                <div>
                    <h5 class="mb-0 fw-bold tracking-wide">STARTINGVANO</h5>
                    <h6 style="font-size: 0.65rem; color: #d1b442;">COMPANY PROFILE & ATLET DATABASE</h6>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2 align-items-center">
                    <li class="nav-item"><a href="/" class="nav-link text-white @if(Request::is('/')) active fw-bold @endif">Home</a></li>
                    <li class="nav-item"><a href="/players" class="nav-link text-white @if(Request::is('players') || Request::is('players/*')) active fw-bold @endif">Data Atlet</a></li>
                    <li class="nav-item"><a href="/about" class="nav-link text-white @if(Request::is('about')) active fw-bold @endif">Tentang</a></li>
                    <li class="nav-item ms-lg-3"><a href="/contact" class="btn btn-sm text-white fw-bold px-4 py-2 @if(Request::is('contact')) active @endif" style="background-color: #d1b442; border-radius: 50px;">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="pt-5 pb-2 text-white mt-auto" style="background-color: #0a1128;">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6 pe-lg-5 mb-4 mb-lg-0">
                    <h5 class="fw-bold text-white mb-2">
                        <img src="{{ asset('images/logo.png') }}" height="30" class="me-2 bg-white p-1 rounded"> STARTINGVANO
                    </h5>
                    <p class="text-blue fw-bold mb-3 small">Company Profile & Atlet Database</p>
                    <p class="footer-text text-justify mb-0">StartingVano merupakan platform berbasis Laravel yang digunakan untuk mengelola serta menampilkan informasi atlet dari berbagai cabang olahraga secara modern, cepat, dan mudah dikelola melalui halaman administrator.</p>
                </div>
                <div class="col-lg-6 ps-lg-4">
                    <h5 class="fw-bold text-white mb-4" style="border-bottom: 2px solid #d1b442; display: inline-block; padding-bottom: 5px;">CONTACT INFO</h5>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-3 d-flex"><i class="bi bi-geo-alt-fill text-blue fs-5 me-3"></i> 
                        <div><strong class="text-white">Headquarters:</strong><br> Jakarta, Indonesia</div></li>
                        <li class="mb-3 d-flex align-items-center"><i class="bi bi-telephone-fill text-blue fs-5 me-3"></i> 
                        <div><strong class="text-white">Call Us:</strong> +62 21 1234 5678</div></li>
                        <li class="d-flex align-items-center"><i class="bi bi-envelope-fill text-blue fs-5 me-3"></i> 
                        <div><strong class="text-white">Email:</strong> info@startingvano.com</div></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid pt-3 mt-3 border-top border-secondary text-center">
            <small class="text-white-50">&copy; 2026 StartingVano. All rights reserved.</small>
        </div>
    </footer>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>