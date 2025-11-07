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
                <a href="/" class="navbar-brand">
                    <h1 class="text-primary display-6">Sakura Hidroponik</h1>
                </a>

                <div class="d-flex ms-auto">
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
            <form id="checkout-form" action="{{ route('konfirmasi.store') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama_pelanggan" class="form-control"
                                value="{{ old('nama_pelanggan') }}" placeholder="Masukkan nama" required>
                        </div>

                        <div class="form-item mb-3">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="text" name="no_whatsapp" class="form-control"
                                value="{{ old('no_whatsapp') }}" placeholder="Masukkan nomor WhatsApp" required>
                        </div>

                        <div class="form-item mb-3">
                            <label class="form-label">Metode Pengambilan</label>
                            <select id="jenis_pengambilan" name="jenis_pengambilan" class="form-select" required>
                                <option disabled {{ old('jenis_pengambilan') ? '' : 'selected' }}>Pilih Metode</option>
                                <option value="diantar" {{ old('jenis_pengambilan') == 'diantar' ? 'selected' : '' }}>
                                    Diantar</option>
                                <option value="ambil di kebun"
                                    {{ old('jenis_pengambilan') == 'ambil di kebun' ? 'selected' : '' }}>Ambil di Kebun
                                </option>
                                <option value="ambil di rumah"
                                    {{ old('jenis_pengambilan') == 'ambil di rumah' ? 'selected' : '' }}>Ambil di Rumah
                                </option>
                            </select>
                        </div>

                        <!-- Form alamat (muncul jika diantar) -->
                        <div class="form-item mb-3" id="alamat-container" style="display: none;">
                            <label class="form-label">Alamat Lengkap (hanya untuk pengantaran)</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="5"
                                placeholder="Contoh: RT 03 / RW 07, Dusun Kromasan, Desa Beru, Kelurahan Beru, Kecamatan Wlingi, Jalan Mawar No. 12">{{ old('alamat') }}</textarea>
                            <small class="text-muted">Gunakan format: RT/RW, Dusun, Desa, Kelurahan, Kecamatan, Nama
                                Jalan</small>
                        </div>

                        <!-- Map lokasi ambil (muncul jika ambil di kebun atau rumah) -->
                        <div class="form-item mb-3" id="map-container" style="display: none;">
                            <label class="form-label">Lokasi Pengambilan</label>
                            <div class="ratio ratio-16x9">
                                <iframe id="map-iframe" src="" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                            <small class="text-muted d-block mt-2" id="map-desc"></small>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjang as $item)
                                        <tr>
                                            <td><img src="{{ $item['gambar'] }}" width="80"></td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $item['jumlah'] }}</td>
                                            <td>Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahkan script JS Ajax -->
    <script>
        $(document).ready(function() {
            $("#checkout-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Pesanan Berhasil!",
                                html: "Terima kasih, pesananmu telah kami terima.<br><b>Tunggu info selanjutnya melalui WhatsApp, ya!</b>",
                                confirmButtonText: "Ok"
                            }).then(() => {
                                window.location.href = res
                                    .redirect; // redirect ke index
                            });
                        } else {
                            Swal.fire("Gagal!", res.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", xhr.responseJSON?.message || "Terjadi kesalahan.",
                            "error");
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function toggleAlamat() {
                const metode = $("#jenis_pengambilan").val();
                const $alamatContainer = $("#alamat-container");
                const $mapContainer = $("#map-container");
                const $mapIframe = $("#map-iframe");
                const $mapDesc = $("#map-desc");

                if (metode === "diantar") {
                    // Jika memilih diantar → tampilkan form alamat
                    $alamatContainer.slideDown();
                    $("#alamat").attr("required", true);
                    $mapContainer.slideUp();
                    $mapIframe.attr("src", "");
                    $mapDesc.text("");
                } else if (metode === "ambil di kebun") {
                    // Jika memilih ambil di kebun → tampilkan peta kebun Sakura Hidroponik
                    $alamatContainer.slideUp();
                    $("#alamat").removeAttr("required").val('');
                    $mapContainer.slideDown();
                    $mapIframe.attr("src",
                        "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.515726946294!2d112.3063123!3d-8.1002614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7893cb6d9dbabb%3A0x9ce5bed2d55ed512!2sSakura%20Hidroponik!5e0!3m2!1sid!2sid!4v1731042000000!5m2!1sid!2sid"
                    );
                    $mapDesc.text(
                        "Lokasi Kebun Sakura Hidroponik - Silakan menuju titik peta ini untuk pengambilan.");
                } else if (metode === "ambil di rumah") {
                    // Jika memilih ambil di rumah → tampilkan peta Warung Mak Jass (lokasi rumah)
                    $alamatContainer.slideUp();
                    $("#alamat").removeAttr("required").val('');
                    $mapContainer.slideDown();
                    $mapIframe.attr("src",
                        "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.497641660689!2d112.3077261!3d-8.099229899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78936fc9a855f9%3A0x6a1c4a0085fded5e!2sWarung%20Mak%20Jass!5e0!3m2!1sid!2sid!4v1731039999999!5m2!1sid!2sid"
                    );
                    $mapDesc.text(
                        "Lokasi Rumah Pengambilan (Warung Mak Jass) - Silakan menuju titik peta ini untuk pengambilan."
                        );
                } else {
                    // Jika belum memilih apa pun → sembunyikan semua
                    $alamatContainer.slideUp();
                    $mapContainer.slideUp();
                    $("#alamat").removeAttr("required");
                    $mapIframe.attr("src", "");
                    $mapDesc.text("");
                }
            }

            // Jalankan saat halaman pertama kali dimuat
            toggleAlamat();

            // Jalankan ulang tiap kali user ganti metode
            $("#jenis_pengambilan").on("change", toggleAlamat);
        });
    </script>


</body>

</html>
