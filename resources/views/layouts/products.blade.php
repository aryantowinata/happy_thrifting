<section id="section-products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4" data-aos="fade-up">Produk Kami</h2>

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
                <div class="card product-card shadow-sm border-light">
                    <img src="{{ asset('storage/' . $product->gambar_produk) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <p class="card-text">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>

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


</body>

</html>