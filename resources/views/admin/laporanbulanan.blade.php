@extends('master')

@section('css')
    <style>
        #laporan_bulanan,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.85rem;
        }

        #laporan_bulanan th,
        #laporan_bulanan td {
            padding: 0.4rem 0.5rem;
        }

        #laporan_bulanan thead th {
            white-space: nowrap;
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

        /* Card height dan spacing */
        .info-card.h-100 {
            min-height: 140px;
        }

        .card-title {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('isi')
    <div class="pagetitle d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h1>Laporan Bulanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Ringkasan penjualan, pendapatan, dan pembatalan dalam satu bulan.</a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Filter Bulan & Tahun (pojok kanan atas) --}}
        <div class="filter-container">
            <form action="{{ route('laporan.bulanan') }}" method="GET">
                <select name="bulan" onchange="this.form.submit()">
                    @foreach ($bulanList as $num => $nama)
                        <option value="{{ $num }}" {{ $num == $bulan ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun" onchange="this.form.submit()">
                    @foreach ($tahunList as $th)
                        <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <section class="section dashboard">
        {{-- Pendapatan & Produk Terlaris --}}
        <div class="row align-items-stretch g-4">
            {{-- Card Pendapatan --}}
            <div class="col-lg-7 col-md-12">
                <div class="card info-card revenue-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Bulan {{ $bulanList[$bulan] }}</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Produk Terlaris --}}
            <div class="col-lg-5 col-md-12">
                <div class="card info-card sales-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Produk Terlaris Bulan {{ $bulanList[$bulan] }}</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-white">
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

        {{-- Tabel & Chart --}}
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card p-3">
                    <h5 class="card-title">Rincian Sayur Terjual</h5>
                    <div class="table-responsive">
                        <table id="laporan_bulanan" class="table table-striped table-hover align-middle text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sayur</th>
                                    <th>Total (Kg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincianSayur as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td class="text-start">{{ $item->nama_produk }}</td>
                                        <td>{{ $item->total_kg }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
    <script>
        new DataTable('#laporan_bulanan', {
            paging: false,
            searching: false,
            info: false
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('alasanChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Pembatalan',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: 'white',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.label}: ${context.parsed} pesanan`
                        }
                    }
                }
            }
        });
    </script>
@endsection
