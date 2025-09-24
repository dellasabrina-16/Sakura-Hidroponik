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
                        <i class="fas fa-shopping-bag fa-2x"></i>
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
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-end">
                <div class="col-sm-12 col-md-7 col-lg-6 col-xl-8">
                    <div class="table-responsive">
                        @if (count($keranjang) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $grandTotal = 0; @endphp
                                    @foreach ($keranjang as $id => $item)
                                        @php
                                            $total = $item['harga'] * $item['jumlah'];
                                            $grandTotal += $total;
                                        @endphp
                                        <tr data-harga="{{ $item['harga'] }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item['gambar'] ?? 'img/noimage.png' }}"
                                                        class="img-fluid me-3 rounded-circle"
                                                        style="width: 80px; height: 80px;" alt="{{ $item['nama'] }}">
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">{{ $item['nama'] }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="input-group quantity mt-4" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button
                                                            class="btn btn-sm btn-minus rounded-circle bg-light border update-qty"
                                                            data-id="{{ $id }}" data-type="minus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>

                                                    <input type="text"
                                                        class="form-control form-control-sm text-center border-0 qty-input"
                                                        style="background:none; box-shadow:none;"
                                                        value="{{ $item['jumlah'] }}" readonly>

                                                    <div class="input-group-btn">
                                                        <button
                                                            class="btn btn-sm btn-plus rounded-circle bg-light border update-qty"
                                                            data-id="{{ $id }}" data-type="plus">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4 subtotal">
                                                    Rp {{ number_format($total, 0, ',', '.') }}
                                                </p>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-md rounded-circle bg-light border mt-4 remove-item"
                                                    data-id="{{ $id }}">
                                                    <i class="fa fa-times text-danger"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Keranjang masih kosong.</p>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Total <span class="fw-normal">Belanja</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Total:</h5>
                                <p class="mb-0" id="grand-total">
                                    Rp {{ number_format($grandTotal ?? 0, 0, ',', '.') }}
                                </p>

                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Note:</h5>
                                <div class="text-start">
                                    <p class="mb-0">Harga di atas tidak termasuk ongkir.</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <a href="{{ route('konfirmasi.index') }}"
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                                KONFIRMASI
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

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
            // Update qty (plus/minus)
            $(document).on("click", ".update-qty", function() {
                let id = $(this).data("id");
                let type = $(this).data("type");
                let $row = $(this).closest("tr");
                let $qtyInput = $row.find(".qty-input");
                let $subtotal = $row.find(".subtotal");

                $.ajax({
                    url: "/keranjang/update",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        type: type
                    },
                    success: function(res) {
                        if (res.success) {
                            // Ambil jumlah terbaru langsung dari server
                            let currentQty = res.qty;

                            // Update qty di input
                            $qtyInput.val(currentQty);

                            // Hitung ulang subtotal
                            let harga = parseInt($row.data("harga"));
                            let total = harga * currentQty;
                            $subtotal.text("Rp " + total.toLocaleString("id-ID"));

                            // Update grand total
                            updateGrandTotal();
                        }
                    }
                });
            });

            // Hapus item
            $(document).on("click", ".remove-item", function() {
                let id = $(this).data("id");
                let $row = $(this).closest("tr");

                $.ajax({
                    url: "/keranjang/remove",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(res) {
                        if (res.success) {
                            $row.remove();
                            updateGrandTotal();
                        }
                    }
                });
            });

            // Hitung ulang grand total
            function updateGrandTotal() {
                let grandTotal = 0;
                $(".qty-input").each(function() {
                    let qty = parseInt($(this).val());
                    let harga = parseInt($(this).closest("tr").data("harga"));
                    grandTotal += qty * harga;
                });

                // update hanya kotak total belanja
                $("#grand-total").text("Rp " + grandTotal.toLocaleString("id-ID"));
            }
        });
    </script>



</body>

</html>
