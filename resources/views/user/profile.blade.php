<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - {{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS for animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="/assets/css/profile.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Profile Content -->
    <div class="container profile-container" data-aos="fade-up" data-aos-duration="1000">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-header">
                        <h4 class="mb-0">Your Profile</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success" data-aos="fade-in" data-aos-duration="1000">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('user.updateProfile') }}" method="POST" data-aos="fade-up" data-aos-duration="1000">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email (readonly)</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Address</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" required>{{ Auth::user()->alamat }}</textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password (optional)</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Leave empty to keep current password">
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter your new password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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