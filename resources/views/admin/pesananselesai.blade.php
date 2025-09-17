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
                                <th>No</th>
                                <th>Tanggal Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Produk</th>
                                <th>Jenis Pengambilan</th>
                                <th>Alamat</th>
                                <th>Nomor WhatsApp</th>
                                <th>Total Harga</th>
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
                                    <td class="text-end">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
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
                                <th>No</th>
                                <th>Tanggal Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Produk</th>
                                <th>Jenis Pengambilan</th>
                                <th>Alamat</th>
                                <th>Nomor WhatsApp</th>
                                <th>Total Harga</th>
                                <th>Alasan Dibatalkan</th>
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
                                    <td>{{ $pesanan->alamat }}</td>
                                    <td>{{ $pesanan->no_whatsapp }}</td>
                                    <td class="text-end">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $pesanan->alasan_dibatalkan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
