<!DOCTYPE html>
<html lang="en">

<!-- ================= HEAD ================= -->

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sakura Hidroponik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Hanya pilih satu Bootstrap (pakai CDN biar aman) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <!-- Template Main CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>


<body class="d-flex flex-column min-vh-100">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Sakura Hidroponik</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/login">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->

            </ul>
        </nav>
        <!-- End Icons Navigation -->

    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? '' : 'collapsed' }}"
                    href="{{ url('/admin/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Pesanan -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/pesanan*') || Request::is('admin/pesananselesai*') ? '' : 'collapsed' }}"
                    data-bs-target="#pesanan-nav" data-bs-toggle="collapse" href="#pesanan-nav">
                    <i class="bi bi-cart2"></i>
                    <span>Pesanan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pesanan-nav"
                    class="nav-content collapse {{ Request::is('admin/pesanan') || Request::is('admin/pesananselesai') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    <!-- Pesanan Masuk -->
                    <li>
                        <a href="{{ url('/admin/pesanan') }}"
                            class="{{ Request::is('admin/pesanan') ? 'active' : '' }}">
                            <i
                                class="bi {{ Request::is('admin/pesanan') ? 'bi-circle-fill text-success' : 'bi-circle text-success' }}"></i>
                            <span>Pesanan Masuk</span>
                        </a>
                    </li>

                    <!-- Pesanan Selesai -->
                    <li>
                        <a href="{{ url('/admin/pesananselesai') }}"
                            class="{{ Request::is('admin/pesananselesai') ? 'active' : '' }}">
                            <i
                                class="bi {{ Request::is('admin/pesananselesai') ? 'bi-circle-fill text-success' : 'bi-circle text-success' }}"></i>
                            <span>Pesanan Selesai</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Produk -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/produk*') ? '' : 'collapsed' }}"
                    href="{{ url('/admin/produk') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>
                </a>
            </li>

            <!-- Stok -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/stok*') ? '' : 'collapsed' }}"
                    href="{{ url('/admin/stok') }}">
                    <i class="bi bi-card-checklist"></i>
                    <span>Stok</span>
                </a>
            </li>

            <!-- Laporan -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/laporan/*') ? '' : 'collapsed' }}"
                    data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#laporan-nav">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="laporan-nav" class="nav-content collapse {{ Request::is('admin/laporan/*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    <!-- Laporan Mingguan -->
                    <li>
                        <a href="{{ url('/admin/laporan/mingguan') }}"
                            class="{{ Request::is('admin/laporan/mingguan') ? 'active' : '' }}">
                            <i
                                class="bi {{ Request::is('admin/laporan/mingguan') ? 'bi-circle-fill text-success' : 'bi-circle text-success' }}"></i>
                            <span>Laporan Mingguan</span>
                        </a>
                    </li>

                    <!-- Laporan Bulanan -->
                    <li>
                        <a href="{{ url('/admin/laporan/bulanan') }}"
                            class="{{ Request::is('admin/laporan/bulanan') ? 'active' : '' }}">
                            <i
                                class="bi {{ Request::is('admin/laporan/bulanan') ? 'bi-circle-fill text-success' : 'bi-circle text-success' }}"></i>
                            <span>Laporan Bulanan</span>
                        </a>
                    </li>

                    <!-- Laporan Tahunan -->
                    <li>
                        <a href="{{ url('/admin/laporan/tahunan') }}"
                            class="{{ Request::is('admin/laporan/tahunan') ? 'active' : '' }}">
                            <i
                                class="bi {{ Request::is('admin/laporan/tahunan') ? 'bi-circle-fill text-success' : 'bi-circle text-success' }}"></i>
                            <span>Laporan Tahunan</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>


    <!-- End Sidebar-->
    <main id="main" class="main">
        @yield('isi')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-auto">
        <div class="copyright">
            &copy; Copyright
            <strong>
                <span>
                    <b>RPLutioners</b></span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by Team RPLutioners
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>
    <!-- ================= JS ================= -->

    <!-- Bootstrap JS (hanya sekali) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.js"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('script')


</body>

</html>
