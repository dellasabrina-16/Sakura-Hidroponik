@extends('master')

@section('isi')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Lihat ringkasan mingguan omzet, status stok terkini, dan daftar
                        pesanan yang belum terpenuhi.</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Penjualan <span>| Minggu ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalTerjual }} Kg</h6>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Pendapatan <span>| Minggu ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <span>Rp</span>
                                        <h6>{{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Pendapatan <span>| Minggu ini</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Pendapatan',
                                                data: @json($revenues),
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: { show: false },
                                            },
                                            markers: { size: 4 },
                                            colors: ['#2eca6a'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: { enabled: false },
                                            stroke: { curve: 'smooth', width: 2 },
                                            xaxis: {
                                                categories: @json($dates),
                                            },
                                            tooltip: {
                                                x: { format: 'dd/MM/yy' },
                                            }
                                        }).render();
                                    });
                                </script>


                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Daftar Pesanan <span>| Hari ini</span></h5>

                        <div class="activity">
                            @forelse ($daftarPesanan as $pesanan)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d-m-Y') }}
                                        {{ $pesanan->created_at->format('H:i:s') }}
                                    </div>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    <div class="activity-content">
                                        <strong>Pesanan #{{ $pesanan->id }}</strong> - {{ $pesanan->nama_pelanggan }}

                                        @if ($pesanan->details->count())
                                            <ul class="mt-1">
                                                @foreach ($pesanan->details as $detail)
                                                    <li>
                                                        {{ $detail->nama_produk ?? 'Produk' }} -
                                                        {{ $detail->jumlah_kg }} Kg
                                                        (Rp {{ number_format($detail->harga, 0, ',', '.') }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <small class="text-muted">Tidak ada detail pesanan</small>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Tidak ada pesanan diproses.</p>
                            @endforelse
                        </div>

                    </div>

                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection