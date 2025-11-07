@extends('master')

@section('css')
    <style>
        #laporan_tahunan {
            font-size: 0.9rem;
        }

        .filter-container {
            display: flex;
            justify-content: flex-end;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .filter-container select {
            padding: 0.45rem 0.7rem;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        @media (max-width: 768px) {
            .filter-container {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('isi')
    <div class="pagetitle d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h1>Laporan Tahunan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Rekapitulasi pendapatan dan penjualan selama satu tahun.</a>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="filter-container">
            <form action="{{ route('laporan.tahunan') }}" method="GET">
                <select name="tahun" onchange="this.form.submit()">
                    @foreach ($tahunList as $th)
                        <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>{{ $th }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <section class="section dashboard">
        <div class="row g-4">
            {{-- Card pendapatan --}}
            <div class="col-lg-7 col-md-12">
                <div class="card info-card revenue-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Tahun {{ $tahun }}</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle bg-success text-white d-flex align-items-center justify-content-center">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card produk terlaris --}}
            <div class="col-lg-5 col-md-12">
                <div class="card info-card sales-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Produk Terlaris Tahun {{ $tahun }}</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle bg-warning text-white d-flex align-items-center justify-content-center">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $produkTerlaris->nama_produk ?? 'Belum ada data' }}</h6>
                                <span>{{ $produkTerlaris->total_kg ?? 0 }} Kg terjual</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Cards --}}
        <div class="row g-4 mt-2">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Sayur Terjual</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalSayurTerjual }} Kg</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Selesai</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center text-success">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pesananSelesai }}</h6>
                                <span>Pesanan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Dibatalkan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pesananDibatalkan }}</h6>
                                <span>Pesanan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik pendapatan tahunan --}}
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Pendapatan Bulanan</h5>
                        <canvas id="pendapatanChart" style="min-height: 350px;"></canvas>
                    </div>
                </div>
            </div>

            {{-- Pie alasan pembatalan --}}
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alasan Pembatalan</h5>
                        <canvas id="alasanChart" style="min-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pendapatan Chart
        const ctxPendapatan = document.getElementById('pendapatanChart');
        new Chart(ctxPendapatan, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_values($chartLabels)) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartPendapatan) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Alasan Pembatalan Chart
        const ctxAlasan = document.getElementById('alasanChart');
        new Chart(ctxAlasan, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($alasanLabels) !!},
                datasets: [{
                    data: {!! json_encode($alasanData) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
