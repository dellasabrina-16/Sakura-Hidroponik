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
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white">Linkungan Kromasan RT 03 / RW 07, Kel. Beru, Kec. Wlingi, Kabupaten
                            Blitar, Jawa Timur 66184</a></small>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">Sakura Hidroponik</h1>
                </a>

                <div class="d-flex ms-auto">
                    <a href="{{ route('keranjang.index') }}" class="position-relative text-end my-auto">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                        <span id="cart-count"
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span>
                    </a>

                </div>
            </nav>
        </div>

    </div>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Sayuran Hidroponik</h4>
                    <h1 class="mb-5 display-4 text-primary">Segar dari kebun, <br>
                        ke meja makan Anda</h1>
                    <div class="position-relative mx-auto">
                        <p class="text-primary">Nikmati sayuran sehat, bersih, dan bergizi tanpa harus ke pasar.</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded"
                                    alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Sayuran segar</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Dipetik langsung</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-seedling fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Dijamin Segar</h5>
                            <p class="mb-0">Dipetik langsung saat ada pesanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-ban fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Bebas Pestisida</h5>
                            <p class="mb-0">Tumbuh tanpa bahan kimia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-award fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Kualitas Premium</h5>
                            <p class="mb-0">Hanya panen terbaik yang kami kirim.</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-soap fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Kebersihan Terjaga</h5>
                            <p class="mb-0">Tanpa kontaminasi tanah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="g-4">
                    <div class="text-start">
                        <h1>Semua Produk Kami</h1>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            @foreach ($produks as $produk)
                                <div class="col-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item border border-primary">
                                        <div class="fruite-img">
                                            <img src="{{ asset('storage/' . $produk->foto_produk) }}"
                                                class="img-fluid w-100 rounded-top" alt="{{ $produk->nama_produk }}">
                                        </div>
                                        {{-- Badge stok --}}
                                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; right: 10px;">
                                            {{ $produk->stok && $produk->stok->stok_kg > 0 ? 'Tersedia' : 'Stok Habis' }}
                                        </div>

                                        <div class="p-4 rounded-bottom">
                                            <h4>{{ $produk->nama_produk }}</h4>
                                            <p>{{ $produk->deskripsi_produk }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                    Rp {{ number_format($produk->harga_kg, 0, ',', '.') }} / kg
                                                </p>
                                                <button
                                                    class="btn border border-secondary rounded-pill px-3 text-primary btn-pesan"
                                                    data-id="{{ $produk->id }}"
                                                    data-nama="{{ $produk->nama_produk }}"
                                                    data-harga="{{ $produk->harga_kg }}"
                                                    data-stok="{{ $produk->stok && $produk->stok->stok_kg > 0 ? $produk->stok->stok_kg : 0 }}"
                                                    data-gambar="{{ asset('storage/' . $produk->foto_produk) }}">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Pesan
                                                </button>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-4 rounded">
                <div class="row g-4 text-center">

                    <!-- Pelanggan Puas -->
                    <div class="col-6 col-md-3">
                        <div class="counter bg-white rounded p-4 h-100 shadow-sm">
                            <i class="fa fa-users fa-3x text-success mb-3"></i>
                            <h6 class="fw-bold text-uppercase small text-wrap">Pelanggan Puas</h6>
                            <h3 class="mb-0">999</h3>
                        </div>
                    </div>

                    <!-- Kualitas Layanan -->
                    <div class="col-6 col-md-3">
                        <div class="counter bg-white rounded p-4 h-100 shadow-sm">
                            <i class="fa fa-star fa-3x text-success mb-3"></i>
                            <h6 class="fw-bold text-uppercase small text-wrap">Kualitas Layanan</h6>
                            <h3 class="mb-0">99%</h3>
                        </div>
                    </div>

                    <!-- Panen Bulanan -->
                    <div class="col-6 col-md-3">
                        <div class="counter bg-white rounded p-4 h-100 shadow-sm">
                            <i class="fa fa-leaf fa-3x text-success mb-3"></i>
                            <h6 class="fw-bold text-uppercase small text-wrap">Panen Bulanan</h6>
                            <h3 class="mb-0">99 Kg</h3>
                        </div>
                    </div>

                    <!-- Produk Tersedia -->
                    <div class="col-6 col-md-3">
                        <div class="counter bg-white rounded p-4 h-100 shadow-sm">
                            <i class="fa fa-box fa-3x text-success mb-3"></i>
                            <h6 class="fw-bold text-uppercase small text-wrap">Produk Tersedia</h6>
                            <h3 class="mb-0">9</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->

    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tastimonial End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-2 mt-2">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <a href="#">
                            <h1 class="text-white mb-0">Sakura Hidroponik</h1>
                            <p class="text-secondary mb-0">Sayuran Hidroponik</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <p class=" text-center text-white">
                    © Copyright <strong>RPLutioners.</strong> All Rights Reserved.
                    Designed by <span class="fw-bold">WonderWoman</span>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

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

    <script>
        $(document).ready(function() {
            let $cartCount = $("#cart-count");

            $(".btn-pesan").on("click", function(e) {
                e.preventDefault();

                let $btn = $(this);
                let id = $btn.data("id");
                let nama = $btn.data("nama");
                let harga = $btn.data("harga");
                let stok = parseInt($btn.data("stok"));
                let gambar = $btn.data("gambar"); // ✅ tambahin ini

                if (stok <= 0) {
                    alert("Stok habis, tidak bisa dipesan.");
                    return;
                }

                if ($btn.hasClass("added")) {
                    alert("Produk ini sudah ada di keranjang. Tambah jumlahnya di halaman keranjang.");
                    return;
                }

                $.ajax({
                    url: "{{ route('keranjang.add') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        nama: nama,
                        harga: harga,
                        gambar: gambar // ✅ kirim juga ke backend
                    },
                    success: function(res) {
                        if (res.success) {
                            let currentCount = parseInt($cartCount.text());
                            $cartCount.text(currentCount + 1);

                            $btn.addClass("added disabled")
                                .css({
                                    "pointer-events": "none",
                                    "opacity": "0.6"
                                })
                                .html(
                                    '<i class="fa fa-check text-success me-2"></i> Sudah dipesan'
                                );
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>
