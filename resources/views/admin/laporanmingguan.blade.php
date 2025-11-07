@extends('master')

@section('css')
    <style>
        #laporan_mingguan,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.85rem;
        }

        #laporan_mingguan th,
        #laporan_mingguan td {
            padding: 0.4rem 0.5rem;
        }

        #laporan_mingguan thead th {
            white-space: nowrap;
        }
    </style>
@endsection

@section('isi')
    <div class="pagetitle">
        <h1>Laporan Mingguan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a>Ringkasan penjualan, status pesanan, dan statistik stok selama satu minggu terakhir.</a>
                </li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row g-4">
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
                        <h5 class="card-title">Pesanan Diselesaikan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
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

        <div class="row ">
            <div class="col-lg-7">
                <div class="card p-3">
                    <h5 class="card-title">Rincian Sayur Terjual</h5>
                    <div class="table-responsive">
                        <table id="laporan_mingguan" class="table table-striped table-hover align-middle text-center">
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
        new DataTable('#laporan_mingguan',
            paging: false,
            searching: false,
            info: false,
        );
    </script>

    {{-- Chart.js Donut --}}
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
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
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
