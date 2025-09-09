<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="">

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
      <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3">
    <a href="index.html" class="navbar-brand fw-bold text-success">
      <i class="fas fa-leaf me-2"></i>Sakura Hidroponik
    </a>
    <div class="ms-auto">
      <a href="/pesanan" class="btn btn-outline-success">
        <i class="fas fa-shopping-basket"></i>
      </a>
    </div>
  </nav>
    <!-- Navbar End -->

        {{-- Hero Section --}}
        <div class="container-fluid bg-light py-5">
            <div class="container text-center">
                <h6 class="text-success">100% Sayuran Hidroponik</h6>
                <h1 class="fw-bold">Segar dari kebun,<br>ke meja makan Anda</h1>
                <p class="text-muted">Nikmati sayuran sehat, bersih, dan bergizi tanpa harus ke pasar.</p>

                {{-- Carousel Placeholder --}}
                <div class="d-flex justify-content-center align-items-center bg-secondary rounded p-5 mt-4"
                    style="height:250px;">
                    <button class="btn btn-outline-dark me-3"><i class="fas fa-arrow-left"></i></button>
                    <span class="text-white">Carousel Gambar Produk</span>
                    <button class="btn btn-outline-dark ms-3"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>

        {{-- Features Section --}}
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-award fa-2x text-success mb-3"></i>
                        <h5>Dijamin Segar</h5>
                        <p class="text-muted">Dipoetik langsung saat ada pesanan.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-leaf fa-2x text-success mb-3"></i>
                        <h5>100% Bebas Pestisida</h5>
                        <p class="text-muted">Tumbuh tanpa bahan kimia berbahaya.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-star fa-2x text-success mb-3"></i>
                        <h5>Kualitas Premium</h5>
                        <p class="text-muted">Hanya panen terbaik yang kami kirim ke Anda.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-shield-alt fa-2x text-success mb-3"></i>
                        <h5>Kebersihan Terjaga</h5>
                        <p class="text-muted">Tanpa kontaminasi tanah atau kotoran.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Products Section --}}
        <div class="container py-5">
            <h2 class="mb-4">Semua Produk Kami</h2>
            <div class="row g-4">
                {{-- Product 1 --}}
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            Foto Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Selada</h5>
                            <p class="card-text text-muted">Sayuran segar hidroponik berkualitas tinggi.</p>
                            <p class="fw-bold text-success">Rp 21.000 / Kg</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-dark w-100"><i class="fas fa-shopping-basket me-2"></i>Masukkan
                                Keranjang</button>
                        </div>
                    </div>
                </div>
                {{-- Product 2 --}}
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            Foto Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pakcoy</h5>
                            <p class="card-text text-muted">Sayuran hijau bebas pestisida, aman dikonsumsi.</p>
                            <p class="fw-bold text-success">Rp 18.000 / Kg</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-dark w-100"><i class="fas fa-shopping-basket me-2"></i>Masukkan
                                Keranjang</button>
                        </div>
                    </div>
                </div>
                {{-- Product 3 --}}
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            Foto Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kangkung</h5>
                            <p class="card-text text-muted">Sayuran segar panen harian dari kebun.</p>
                            <p class="fw-bold text-success">Rp 15.000 / Kg</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-dark w-100"><i class="fas fa-shopping-basket me-2"></i>Masukkan
                                Keranjang</button>
                        </div>
                    </div>
                </div>
                {{-- Product 4 --}}
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            Foto Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Bayam</h5>
                            <p class="card-text text-muted">Kaya nutrisi, sehat, dan higienis.</p>
                            <p class="fw-bold text-success">Rp 20.000 / Kg</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-dark w-100"><i class="fas fa-shopping-basket me-2"></i>Masukkan
                                Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Facts Section --}}
        <div class="container py-5">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-smile fa-2x text-success mb-3"></i>
                        <h3>999</h3>
                        <p>Pelanggan Puas</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-thumbs-up fa-2x text-success mb-3"></i>
                        <h3>99%</h3>
                        <p>Kualitas Layanan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-leaf fa-2x text-success mb-3"></i>
                        <h3>99 Kg</h3>
                        <p>Panen Bulanan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-box fa-2x text-success mb-3"></i>
                        <h3>9</h3>
                        <p>Produk Tersedia</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Testimonial Section --}}
        <div class="container py-5">
            <div class="text-center mb-4">
                <h2>Testimoni</h2>
                <h5 class="text-muted">Kata Pelanggan Kami!</h5>
            </div>
            <div class="bg-light rounded p-4">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i></button>
                    <button class="btn btn-outline-dark"><i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="p-3">
                    <p class="fst-italic">"Sayurannya fresh banget, kualitas oke, pengiriman cepat."</p>
                    <div class="d-flex align-items-center mt-3">
                        <div class="bg-secondary rounded-circle me-3 d-flex align-items-center justify-content-center"
                            style="width:50px; height:50px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Budi Santoso</h6>
                            <small class="text-warning"><i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                    class="fas fa-star"></i></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-dark text-white text-center p-4 mt-5">
            <h5 class="mb-3">Sakura Hidroponik</h5>
            <p class="mb-1">Jl. Irmasan R2 02 Rw 07, Beru, Wlingi, Blitar</p>
            <p class="mb-1">Kontak: 089764956718</p>
            <small>© {{ date('Y') }} Sakura Hidroponik. All Rights Reserved.</small>
        </footer>





        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
                class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

    </html>
