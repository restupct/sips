<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="{{ url('template/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <style>
        .nav-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .nav-icon i {
            font-size: 1.5rem;
        }
        .nav-icon span {
            margin-top: -5px;
            font-size: 0.75rem; /* Ubah ukuran teks sesuai kebutuhan */
        }
    </style>
    @yield('css')

    @livewireStyles
</head>

<body>

    <nav class="navbar navbar-expand bg-primary navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid justify-content-center">
            <div class="navbar-brand fw-bold fs-2" href="#">
                @if(request()->routeIs('home')) Home
                @elseif(request()->routeIs('shop.cart')) Keranjang
                @elseif(request()->routeIs('riwayat.pesanan')) Riwayat Pesanan
                @elseif(request()->routeIs('detail.riwayat.pesanan')) Detail Riwayat Pesanan
                @elseif(request()->routeIs('profile')) Profile
                @endif
            </div>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <div class="mb-5 pt-2"></div>

    <nav class="navbar navbar-expand navbar-dark bg-primary fixed-bottom p-0">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-around">
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <div class="nav-icon">
                                <i class="bi bi-house-door-fill"></i>
                                <span>Home</span>
                            </div>
                        </a>
                    </li>
                        @livewire('shop.cartnav')
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->routeIs('riwayat.pesanan') || request()->routeIs('detail.riwayat.pesanan') ? 'active' : '' }}" href="{{ route('riwayat.pesanan') }}">
                            <div class="nav-icon">
                                <i class="bi bi-clock-fill"></i>
                                <span>Riwayat</span>
                            </div>
                            </a>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item ms-3">
                            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                                <div class="nav-icon">
                                    <i class="bi bi-person-fill"></i>
                                    <span>Profile</span>
                                </div>
                                </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts
</body>

</html>
