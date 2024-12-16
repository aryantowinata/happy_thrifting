<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            HAPPY THRIFTING</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" aria-current="page" href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product_page') ? 'active' : '' }}" href="{{route('product_page')}}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{route('about')}}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.cart') ? 'active' : '' }}" href="{{route('user.cart')}}">Keranjang</a>
                </li>

                <!-- Jika pengguna belum login -->
                @guest
                <li class="nav-item">
                    <a class="btn btn-outline-light ms-3" href="{{ route('user.login') }}">Masuk</a>
                </li>
                @endguest

                <!-- Jika pengguna sudah login -->
                @auth
                @if(Auth::user()->role == 'user')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn btn-dark ms-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.history') }}">Riwayat Pesanan</a>
                        </li>
                        <li>
                            <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="btn btn-outline-light ms-3" href="{{ route('user.login') }}">Masuk</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>