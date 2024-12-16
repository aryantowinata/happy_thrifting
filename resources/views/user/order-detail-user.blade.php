<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | {{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS CSS for animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="/assets/css/history_detail.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Order Details Content -->
    <div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="order-summary" data-aos="fade-up" data-aos-duration="1000">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Order ID: #{{ $order->id }}</h5>
                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <p class="mb-1">Order Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p>Total Harga: <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></p>
        </div>

        <div class="card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Order Items</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item->products->gambar_produk) }}" alt="{{ $item->products->nama_produk }}">
                                <div class="ms-3">
                                    <strong>{{ $item->products->nama_produk }}</strong>
                                </div>
                            </td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Order History
            </a>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init();
    </script>
</body>

</html>