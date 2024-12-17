<section id="section-products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4" data-aos="fade-up">Produk Kami</h2>

        <!-- Daftar Kategori -->
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-12">
                <h4 class="mb-2 fs-5">Kategori</h4>
                <div class="row">
                    <!-- Kategori All -->
                    <div class="col-md-3 col-sm-6 mb-1">
                        <!-- Link All, tanpa kategori pada URL -->
                        <a href="{{ route('index') }}" class="category-card text-center text-decoration-none">
                            <h6 class="category-name">All</h6>
                        </a>
                    </div>
                    <!-- Looping kategori -->
                    @foreach($categories as $category)
                    <div class="col-md-3 col-sm-6 mb-1">
                        <a href="{{ route('index', ['kategori' => $category->id]) }}" class="category-card text-center text-decoration-none">
                            <h6 class="category-name">{{ $category->nama_kategori }}</h6>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cek apakah produk kosong -->
        @if($products->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Produk Tidak Ada!</strong> Saat ini tidak ada produk yang tersedia.
        </div>
        @else
        <div class="row">
            <!-- Product Card -->
            @foreach($products as $product)
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card product-card shadow-lg border-light rounded">
                    <img src="{{ asset('storage/' . $product->gambar_produk) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $product->nama_produk }}</h5>
                        <p class="card-text text-center">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>

                        <div class="d-flex justify-content-between">
                            <!-- Left Button: Masukkan ke Keranjang -->
                            @if(Auth::check())
                            <div class="me-2">
                                <form action="{{ route('user.cart.add', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fa fa-cart-plus me-2"></i> Masukkan ke Keranjang
                                    </button>
                                </form>
                            </div>

                            <!-- Right Button: Beli Sekarang -->
                            <div>
                                <a href="{{ route('user.cart.buyNow', ['id' => $product->id]) }}" class="btn btn-danger btn-lg w-100">
                                    <i class="fa fa-credit-card me-2"></i> Beli Sekarang
                                </a>
                            </div>
                            @else
                            <a href="{{ route('user.login') }}" class="btn btn-warning btn-lg w-100">
                                <i class="fa fa-sign-in-alt me-2"></i> Login untuk Membeli
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>