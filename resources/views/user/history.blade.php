<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/history_order.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS CSS for animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Content -->
    <div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="text-center mb-4">
            <h2>Order History</h2>
            <p class="text-muted">Here you can view details about your previous orders.</p>
        </div>

        @if($orders->isEmpty())
        <div class="alert alert-warning text-center" data-aos="fade-up" data-aos-duration="1000">
            <i class="bi bi-exclamation-circle"></i> You have no order history yet.
        </div>
        @else
        <div class="row">
            @foreach($orders as $order)
            <div class="col-lg-6 col-md-12 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Order ID: <strong>#{{ $order->id }}</strong></span>
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </p>
                        <p class="mb-2">
                            <strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y, H:i') }}
                        </p>
                        <a href="{{ route('user.order-detail-user', $order->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
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