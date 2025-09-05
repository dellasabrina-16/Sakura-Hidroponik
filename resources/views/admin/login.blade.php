<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - Sakura Hidroponik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Nunito:400,600,700|Poppins:400,500,600,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        /* Hilangkan tombol reveal password bawaan di Chrome / Edge */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-webkit-contacts-auto-fill-button,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none !important;
        }

        input[type="password"]::-webkit-textfield-decoration-container {
            display: none !important;
        }

        .btn-hijau {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        .btn-hijau:hover {
            background-color: #218838;
            border-color: #1e7e34;
            color: #fff;
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="pt-4 pb-2 text-center">
                                        <h5 class="card-title pb-0 fs-4">
                                            <img src="assets/img/logo.png" alt="Logo" style="width: 10%">
                                            Sakura Hidroponik
                                        </h5>
                                        <p class="small">Selamat Datang di <br>Aplikasi Manajemen Usaha Hidroponik!</p>
                                        <p class="small">Silahkan masuk ke akun anda</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="/login" novalidate>
                                        @csrf
                                        <!-- Email / Username -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email / Username</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Masukkan email atau nama pengguna" required>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label for="password" class="form-label mb-0">Password</label>
                                                <a href="#" class="small text-muted">Lupa Sandi?</a>
                                            </div>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Masukkan kata sandi" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Ingatkan Saya</label>
                                            </div>

                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button class="btn btn-hijau w-100" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Password Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const icon = toggleBtn.querySelector('i');

            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });
    </script>

</body>

</html>
