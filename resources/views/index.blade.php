<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/animasi.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="hero bg-primary text-white py-5" data-aos="fade-up">
        <div class="container">
            <div class="text-center">
                <h1>Selamat Datang di E-Shop</h1>
                <p class="lead">Temukan produk terbaik dengan harga yang tak tertandingi!</p>
                <a href="{{ route('product_page') }}" class="btn btn-light btn-lg" data-aos="zoom-in" data-aos-delay="200">Belanja Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-up">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @include('layouts.products')

    <!-- Our Features Section -->
    <section class="features py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="slide-up">Mengapa Memilih Kami?</h2>
            <div class="row text-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <i class="bi bi-truck me-3" style="font-size: 2rem;"></i>
                    <h4>Pengiriman Cepat</h4>
                    <p>Produk Anda akan dikirimkan dengan cepat melalui mitra pengiriman yang terpercaya.</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-shield-lock me-3" style="font-size: 2rem;"></i>
                    <h4>Pembayaran Aman</h4>
                    <p>Kami memastikan tingkat keamanan tertinggi untuk pembayaran online Anda.</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-gift me-3" style="font-size: 2rem;"></i>
                    <h4>Penawaran Eksklusif</h4>
                    <p>Nikmati diskon dan promosi spesial saat berbelanja bersama kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="slide-up">Apa Kata Pelanggan Kami</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Produk-produk di sini luar biasa! Kualitas sangat baik dan pengiriman cepat. Saya menjadi pelanggan tetap sekarang."</p>
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">Pelanggan Tetap</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Dukungan pelanggan sangat luar biasa. Mereka membantu saya dengan pesanan dan pengiriman saya!"</p>
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">Pelanggan Puas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"Saya sangat suka berbelanja di sini! Diskonnya luar biasa, dan variasi produknya tak tertandingi."</p>
                            <h5 class="card-title">Michael Lee</h5>
                            <p class="card-text">Pelanggan Senang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>