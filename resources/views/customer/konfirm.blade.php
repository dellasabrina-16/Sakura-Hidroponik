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
                    <a href="#" class="position-relative text-end my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; xleft: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                </div>
            </nav>
        </div>

    </div>
    <!-- Navbar End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Lengkapi Data Pesanan Anda</h1>
            <form action="#">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama" />
                        </div>

                        <div class="form-item mb-3">
                            <label class="form-label">No WhatsApp</label>
                            <input type="tel" class="form-control" placeholder="Masukkan nomor WhatsApp" />
                        </div>

                        <div class="form-item mb-3">
                            <label class="form-label">Opsi Pengiriman / Pengambilan</label>
                            <select class="form-select">
                                <option selected disabled>Pilih opsi</option>
                                <option value="antar">Antar ke alamat</option>
                                <option value="ambil">Ambil di tempat</option>
                            </select>
                        </div>

                        <div class="form-item mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body">
                                    @php $grandTotal = 0; @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $item)
                                            @php
                                                $total = $item['harga'] * $item['jumlah'];
                                                $grandTotal += $total;
                                            @endphp
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="{{ asset('img/' . $item['gambar']) }}"
                                                            class="img-fluid rounded-circle"
                                                            style="width: 90px; height: 90px"
                                                            alt="{{ $item['nama'] }}" />
                                                    </div>
                                                </th>
                                                <td class="py-5">{{ $item['nama'] }}</td>
                                                <td class="py-5">Rp{{ number_format($item['harga'], 0, ',', '.') }}
                                                </td>
                                                <td class="py-5">{{ $item['jumlah'] }}</td>
                                                <td class="py-5">Rp{{ number_format($total, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="py-5 text-end">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">
                                                        Rp{{ number_format($grandTotal, 0, ',', '.') }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-5">Keranjang masih kosong</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="button"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->

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
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // tombol hapus barang
            document.querySelectorAll(".hapus-item").forEach(btn => {
                btn.addEventListener("click", function() {
                    let tr = this.closest("tr");
                    let productName = tr.querySelector("td").innerText;

                    Swal.fire({
                        title: "Apakah kamu yakin?",
                        text: productName + " akan dihapus dari keranjang!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            tr.remove(); // hapus row di tabel (frontend)

                            Swal.fire(
                                "Terhapus!",
                                productName + " sudah dihapus dari keranjang.",
                                "success"
                            );
                        }
                    });
                });
            });

            // contoh ketika checkout
            document.getElementById("checkoutBtn")?.addEventListener("click", function() {
                Swal.fire({
                    title: "Checkout Berhasil!",
                    text: "Pesanan kamu sedang diproses.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        });
    </script>

</body>

</html>