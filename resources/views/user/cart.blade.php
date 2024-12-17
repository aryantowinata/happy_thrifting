<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- AOS CSS for animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/cart.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body>

    @include('layouts.navbar')

    <div class="container py-5 mt-5" data-aos="fade-up">
        <h2 class="text-center mb-4">Your Cart</h2>

        @if($cart && count($cart) > 0)
        <div class="table-responsive" data-aos="zoom-in" data-aos-delay="200">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="card-img-top" style="max-width: 50px;">
                        </td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <!-- Tombol Delete -->
                            <form id="delete-form-{{ $id }}" action="{{ route('user.cart.delete', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Button Checkout -->
        <div class="text-center mt-4">
            @if(Auth::check())
            <a href="{{ route('user.cart.checkout') }}" class="btn btn-success btn-custom">Proceed to Checkout</a>
            @else
            <a href="{{ route('user.login') }}" class="btn btn-warning btn-custom">Login to Checkout</a>
            @endif
        </div>
        @else
        <p class="text-center">Your cart is empty. <a href="{{ route('index') }}">Start shopping now</a>!</p>
        @endif
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // SweetAlert2 for delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const form = document.getElementById(`delete-form-${itemId}`);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be removed from your cart.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert2 success message for item deletion
        @if(session('success_delete'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('
            success_delete ') }}',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        @endif
    </script>

</body>

</html>