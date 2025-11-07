@extends('master')

@section('css')
    <style>
        /* Ukuran font tabel & komponen DataTables */
        #pesanans_selesai,
        #pesanans_batal,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.8rem;
        }

        /* Padding sel tabel */
        #pesanans_selesai th,
        #pesanans_selesai td,
        #pesanans_batal th,
        #pesanans_batal td {
            padding: 0.5rem;
        }

        /* Ukuran icon button di tabel */
        #pesanans_selesai .btn .bx,
        #pesanans_batal .btn .bx {
            font-size: 1rem;
        }

        /* Input pencarian DataTables */
        .dataTables_wrapper .dataTables_filter input[type="search"] {
            height: 25px;
            font-size: 0.8rem;
        }

        /* Tombol hijau kecil */
        #btnPrint,
        #btnExport {
            background-color: #28a745;
            /* hijau tema */
            border-color: #28a745;
            color: #fff;
        }

        #btnPrint:hover,
        #btnExport:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Nav Tabs Hijau */
        .nav-tabs .nav-link {
            color: #155724;
            /* hijau gelap untuk tab tidak aktif */
            background-color: #d4edda;
            /* hijau soft */
            border: 1px solid #c3e6cb;
            border-bottom-color: transparent;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #28a745;
            /* hijau tema untuk tab aktif */
            border-color: #28a745;
            border-bottom-color: transparent;
        }

        .nav-tabs .nav-link:hover {
            background-color: #218838;
            color: #fff;
        }

        .btn-hijau {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        .btn-hijau:hover {
            background-color: #218838;
            border-color: #1e7e34;
            color: #fff;
        }

        .btn-link.btn-sm {
            color: #28a745;
            padding: 0;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-link.btn-sm:hover {
            color: #218838;
            text-decoration: none;
        }
    </style>
@endsection


@section('isi')
    <div
        class="pagetitle d-flex flex-column flex-md-row justify-content-md-between align-items-start align-items-md-center mb-3">
        <div class="mb-3 mb-md-0">
            <h1>Pesanan Masuk</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a>Lihat daftar pesanan yang sudah diselesaikan & dibatalkan disini.</a></li>
                </ol>
            </nav>
        </div>

        {{-- Tombol Print & Export --}}
        <div class="d-flex gap-2">
            {{-- Cetak Laporan --}}
            <button id="btnPrint" class="btn btn-success btn-sm">
                <i class='bi bi-printer-fill me-1'></i> Cetak Laporan
            </button>

            {{-- Export Data --}}
            <button id="btnExport" class="btn btn-success btn-sm">
                <i class='bi bi-file-earmark-spreadsheet-fill me-1'></i> Export Data
            </button>
        </div>
    </div>

    <div class="card p-4">
        {{-- Nav Tabs --}}
        <ul class="nav nav-tabs mb-3" id="pesananTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai"
                    type="button" role="tab" aria-controls="selesai" aria-selected="true">Pesanan Selesai</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="batal-tab" data-bs-toggle="tab" data-bs-target="#batal" type="button"
                    role="tab" aria-controls="batal" aria-selected="false">Pesanan Dibatalkan</button>
            </li>
        </ul>

        {{-- Tab Panes --}}
        <div class="tab-content">

            {{-- Pesanan Selesai --}}
            <div class="tab-pane fade show active" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                <div class="table-responsive">
                    <table id="pesanans_selesai" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Pesanan</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jenis Pengambilan</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Nomor WhatsApp</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesananSelesai as $pesanan)
                                <tr id="row-{{ $pesanan->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $pesanan->tanggal_pesanan }}</td>
                                    <td>{{ $pesanan->nama_pelanggan }}</td>
                                    <td>{{ $pesanan->details->count() }} produk</td>
                                    <td>{{ ucfirst($pesanan->jenis_pengambilan) }}</td>
                                    <td>{{ $pesanan->alamat }}</td>
                                    <td>{{ $pesanan->no_whatsapp }}</td>
                                    <td class="text-center">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        {{-- Tombol detail --}}
                                        <button class="btn btn-link btn-sm p-0" data-bs-toggle="modal"
                                            data-bs-target="#ModalDetailPesanan{{ $pesanan->id }}">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pesanan Dibatalkan --}}
            <div class="tab-pane fade" id="batal" role="tabpanel" aria-labelledby="batal-tab">
                <div class="table-responsive">
                    <table id="pesanans_batal" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Pesanan</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jenis Pengambilan</th>
                                {{-- <th class="text-center">Alamat</th> --}}
                                <th class="text-center">Nomor WhatsApp</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Alasan Dibatalkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesananBatal as $pesanan)
                                <tr id="row-{{ $pesanan->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $pesanan->tanggal_pesanan }}</td>
                                    <td>{{ $pesanan->nama_pelanggan }}</td>
                                    <td>{{ $pesanan->details->count() }} produk</td>
                                    <td>{{ ucfirst($pesanan->jenis_pengambilan) }}</td>
                                    {{-- <td>{{ $pesanan->alamat }}</td> --}}
                                    <td>{{ $pesanan->no_whatsapp }}</td>
                                    <td class="text-center">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $pesanan->alasan_dibatalkan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Detail Pesanan --}}
        @foreach ($pesananSelesai as $pesanan)
            <div class="modal fade" id="ModalDetailPesanan{{ $pesanan->id }}" tabindex="-1"
                aria-labelledby="ModalDetailPesananLabel{{ $pesanan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content p-3">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold" id="ModalDetailPesananLabel{{ $pesanan->id }}">Detail Pesanan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body" id="printArea{{ $pesanan->id }}">

                            <!-- Header Toko -->
                            <div class="text-center mb-2">
                                <h6 class="fw-bold mb-0">🌱 Sakura Hidroponik 🌱</h6>
                                <small>Jl. Mawar No. 10, Jakarta</small><br>
                                <small>Telp/WA: 0812-3456-7890</small>
                                <hr style="border-top: 1px dashed #000;">
                            </div>

                            <!-- Info Pesanan -->
                            <div>
                                <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
                                    <tr>
                                        <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                                            <small>Tanggal : {{ $pesanan->tanggal_pesanan }}</small><br>
                                            <small>Jenis : {{ ucfirst($pesanan->jenis_pengambilan) }}</small><br>
                                            <small>Alamat : {{ $pesanan->alamat }}</small>
                                        </td>
                                        <td style="width: 50%; vertical-align: top; padding-left: 40px;">
                                            <small>Nama : {{ $pesanan->nama_pelanggan }}</small><br>
                                            <small>No. WhatsApp : {{ $pesanan->no_whatsapp }}</small>
                                        </td>
                                    </tr>
                                </table>
                                <hr style="border-top: 1px dashed #000;">
                            </div>

                            <!-- List Produk -->
                            <div>
                                <table class="w-100" style="font-size: 13px;">
                                    <tbody>
                                        @foreach ($pesanan->details as $detail)
                                            <tr>
                                                <td>{{ $detail->nama_produk }}</td>
                                                <td class="text-end">{{ $detail->jumlah_kg }} x
                                                    {{ number_format($detail->harga_produk, 0, ',', '.') }}</td>
                                                <td class="text-end">{{ number_format($detail->harga, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr style="border-top: 1px dashed #000;">
                            </div>

                            <!-- Total -->
                            <div class="text-end fw-bold" style="font-size: 14px;">
                                Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </div>

                            <hr style="border-top: 1px dashed #000;">

                            <!-- Footer -->
                            <div class="text-center">
                                <small>Terima kasih 🙏</small><br>
                                <small>Belanja Sayur Segar di Sakura Hidroponik</small>
                            </div>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-hijau"
                                onclick="printStruk('printArea{{ $pesanan->id }}')">
                                <i class="bi bi-printer"></i> Print Struk
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('script')
    <script>
        function printStruk(areaId) {
            var printContent = document.getElementById(areaId).innerHTML;
            var WinPrint = window.open('', '', 'width=400,height=600');
            WinPrint.document.write('<html><head><title>Struk Pesanan</title>');
            WinPrint.document.write('<style>');
            WinPrint.document.write('body{font-family: monospace; font-size: 13px; padding:10px;}');
            WinPrint.document.write('table{width:100%; border-collapse: collapse;} td{padding:2px 0;}');
            WinPrint.document.write('hr{border:none; border-top:1px dashed #000; margin:4px 0;}');
            WinPrint.document.write('</style>');
            WinPrint.document.write('</head><body>');
            WinPrint.document.write(printContent);
            WinPrint.document.write('</body></html>');
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>

    <script>
        // Inisialisasi DataTable
        const tableSelesai = new DataTable('#pesanans_selesai');
        const tableBatal = new DataTable('#pesanans_batal');

        // Fungsi cetak sesuai tab aktif
        document.getElementById('btnPrint').addEventListener('click', function() {
            const aktifTab = document.querySelector('.tab-pane.active');
            const tabelCetak = aktifTab.querySelector('table');

            const newWin = window.open('', '', 'width=1200,height=800');
            newWin.document.write('<html><head><title>Cetak Laporan</title>');

            // Ambil style halaman
            const styles = Array.from(document.querySelectorAll('style, link[rel="stylesheet"]'))
                .map(el => el.outerHTML)
                .join('\n');
            newWin.document.write(styles);

            newWin.document.write(`
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                table, th, td { border: 1px solid #000; }
                th, td { padding: 8px; text-align: left; font-size: 0.9rem; }
                table.table-striped tbody tr:nth-child(odd) { background-color: #f2f2f2; }
            </style>
        `);

            newWin.document.write('</head><body>');
            newWin.document.write('<h2>Laporan Pesanan</h2>');
            newWin.document.write(tabelCetak.outerHTML);
            newWin.document.write('</body></html>');

            newWin.document.close();
            newWin.focus();
            newWin.print();
            newWin.close();
        });

        // Fungsi export CSV
        function exportTableToCSV(filename) {
            const aktifTab = document.querySelector('.tab-pane.active');
            const rows = aktifTab.querySelectorAll('table tr');
            let csv = [];

            rows.forEach(row => {
                const cols = row.querySelectorAll('th, td');
                const data = Array.from(cols).map(col => `"${col.innerText.replace(/"/g, '""')}"`);
                csv.push(data.join(','));
            });

            const csvFile = new Blob([csv.join('\n')], {
                type: 'text/csv'
            });
            const downloadLink = document.createElement('a');
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        document.getElementById('btnExport').addEventListener('click', () => {
            const aktifTab = document.querySelector('.tab-pane.active');
            const tabName = aktifTab.id === 'selesai' ? 'Pesanan_Selesai' : 'Pesanan_Dibatalkan';
            exportTableToCSV(`${tabName}.csv`);
        });
    </script>
@endsection
