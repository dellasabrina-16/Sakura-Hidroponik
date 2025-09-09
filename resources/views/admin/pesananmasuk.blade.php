@extends('master')

@section('css')
    <style>
        #pesanans_masuk,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.8rem;
        }

        #pesanans_masuk th,
        #pesanans_masuk td {
            padding: 0.5rem;
        }

        #pesanans_masuk .btn .bx {
            font-size: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input[type="search"] {
            height: 25px;
            font-size: 0.8rem;
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

        /* Tombol link hijau */
        .btn-link.btn-sm {
            color: #28a745;
            /* hijau tema */
            padding: 0;
            /* tetap sesuai class p-0 */
            font-size: 0.9rem;
            /* opsional: sesuaikan ukuran */
            text-decoration: none;
            /* hilangkan underline default */
        }

        .btn-link.btn-sm:hover {
            color: #218838;
            /* hijau gelap saat hover */
            text-decoration: none;
            /* tetap tanpa underline */
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
                    <li class="breadcrumb-item"><a>Kelola status dan data pesanan pelanggan secara efisien.</a></li>
                </ol>
            </nav>
        </div>

        {{-- Tombol "Tambah Pesanan" --}}
        <button class="btn btn-hijau" data-bs-toggle="modal" data-bs-target="#ModalTambahPesanan">
            <i class='bx bx-plus me-2'></i> Tambah Pesanan
        </button>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table id="pesanans_masuk" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk</th>
                        <th>Jenis Pengambilan</th>
                        <th>Alamat</th>
                        <th>Total Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $i => $pesanan)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="text-center">{{ $pesanan->tanggal_pesanan }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ $pesanan->details->count() }} produk</td>
                            <td>{{ ucfirst($pesanan->jenis_pengambilan) }}</td>
                            <td>{{ $pesanan->alamat }}</td>
                            <td class="text-end">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    {{-- Badge status --}}
                                    <div class="dropdown">
                                        <button
                                            class="badge 
                @if ($pesanan->status_pesanan == 'diproses') bg-warning text-dark
                @elseif($pesanan->status_pesanan == 'selesai') bg-success text-white
                @elseif($pesanan->status_pesanan == 'dibatalkan') bg-danger text-white @endif
                border-0 dropdown-toggle"
                                            type="button" id="statusDropdown{{ $pesanan->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ ucfirst($pesanan->status_pesanan) }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $pesanan->id }}">
                                            {{-- Form Selesai --}}
                                            <li>
                                                <form data-status="selesai" class="d-inline">
                                                    <input type="hidden" name="order_id" value="{{ $pesanan->id }}">
                                                    <button type="submit"
                                                        class="dropdown-item text-success">Selesai</button>
                                                </form>

                                            </li>
                                            {{-- Form Dibatalkan --}}
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#ModalPembatalan"
                                                    onclick="setOrderId({{ $pesanan->id }})">
                                                    Dibatalkan
                                                </a>

                                            </li>
                                        </ul>
                                    </div>

                                    {{-- Tombol detail --}}
                                    <button class="btn btn-link btn-sm p-0" data-bs-toggle="modal"
                                        data-bs-target="#ModalDetailPesanan{{ $pesanan->id }}">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- Modal Pembatalan --}}
        <div class="modal fade" id="ModalPembatalan" tabindex="-1" aria-labelledby="ModalPembatalanLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="ModalPembatalanLabel">Alasan Pembatalan Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPembatalan">
                            <input type="hidden" id="orderId" name="order_id">

                            <div class="mb-3">
                                <label class="form-label">Pilih Alasan</label>
                                <select class="form-select" id="alasanSelect" name="alasan">
                                    <option selected disabled>Pilih alasan</option>
                                    <option value="Stok Habis">Stok Habis</option>
                                    <option value="Salah Pesan">Salah Pesan</option>
                                    <option value="Alamat Tidak Jelas">Alamat Tidak Jelas</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-3 d-none" id="alasanLainnyaWrapper">
                                <label class="form-label">Alasan Lainnya</label>
                                <input type="text" class="form-control" id="alasanLainnyaInput" name="alasan_lainnya"
                                    placeholder="Tulis alasan lainnya...">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="submitPembatalan()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Detail Pesanan --}}
        @foreach ($pesanans as $pesanan)
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
                                <small>Tanggal : {{ $pesanan->tanggal_pesanan }}</small><br>
                                <small>Pelanggan : {{ $pesanan->nama_pelanggan }}</small><br>
                                <small>Jenis : {{ ucfirst($pesanan->jenis_pengambilan) }}</small><br>
                                <small>Alamat : {{ $pesanan->alamat }}</small><br>
                                <hr style="border-top: 1px dashed #000;">
                            </div>

                            <!-- List Produk -->
                            <div>
                                <table class="w-100" style="font-size: 13px;">
                                    <tbody>
                                        @foreach ($pesanan->details as $detail)
                                            <tr>
                                                <td>{{ $detail->produk->nama_produk }}</td>
                                                <td class="text-end">{{ $detail->jumlah_kg }} x
                                                    {{ number_format($detail->produk->harga_kg, 0, ',', '.') }}</td>
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

        <!-- Modal Tambah Pesanan -->
        <div class="modal fade" id="ModalTambahPesanan" tabindex="-1" aria-labelledby="ModalTambahPesananLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="ModalTambahPesananLabel">Tambah Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <form action="{{ route('pesanan.store') }}" method="POST" id="formPesanan">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Pesanan</label>
                                    <input type="date" name="tanggal_pesanan" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nomor WhatsApp</label>
                                    <input type="text" name="no_whatsapp" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Metode Pengambilan</label>
                                    <select name="jenis_pengambilan" class="form-select" required>
                                        <option value="diantar">Diantar</option>
                                        <option value="ambil di kebun">Ambil di Kebun</option>
                                        <option value="ambil di rumah">Ambil di Rumah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2"></textarea>
                            </div>

                            <h6 class="fw-bold mb-2">Detail Produk</h6>
                            <table class="table table-bordered text-center align-middle" id="produkTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Jumlah (Kg)</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="produk[0][id]" class="form-select produkSelect">
                                                <option disabled selected>Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}"
                                                        data-harga="{{ $produk->harga_kg }}">
                                                        {{ $produk->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="produk[0][jumlah]"
                                                class="form-control jumlahInput" min="1" value="1"></td>
                                        <td class="text-end subtotal">Rp 0</td>
                                        <td><button type="button" class="btn btn-danger btn-sm hapusRow">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="addRow">+ Tambah
                                Produk</button>

                            <div class="text-end mt-3 fw-bold">
                                Total: <span id="grandTotal">Rp 0</span>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-hijau">Simpan</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        new DataTable('#pesanans_masuk');
    </script>

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
        document.addEventListener("DOMContentLoaded", function() {
            const alasanSelect = document.getElementById("alasanSelect");
            const alasanLainnyaWrapper = document.getElementById("alasanLainnyaWrapper");

            // Tampilkan input "Lainnya" jika dipilih
            if (alasanSelect) {
                alasanSelect.addEventListener("change", function() {
                    if (this.value === "Lainnya") {
                        alasanLainnyaWrapper.classList.remove("d-none");
                    } else {
                        alasanLainnyaWrapper.classList.add("d-none");
                    }
                });
            }
        });

        // Simpan order_id untuk modal pembatalan
        function setOrderId(id) {
            document.getElementById("orderId").value = id;
        }

        // Fungsi umum untuk update status via AJAX (dibatalkan atau selesai)
        function updateStatus(orderId, status, alasan = null) {
            const urlTemplate = "{{ route('pesanan.updateStatus', ['id' => '__ID__']) }}";
            const url = urlTemplate.replace('__ID__', orderId);

            fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        status: status,
                        alasan: alasan
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Tutup modal jika ada
                        const modalElem = document.getElementById('ModalPembatalan');
                        if (modalElem) {
                            const modal = bootstrap.Modal.getInstance(modalElem);
                            if (modal) modal.hide();
                        }

                        // Update badge status di tabel
                        const badge = document.getElementById(`statusDropdown${orderId}`);
                        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                        badge.classList.remove("bg-warning", "bg-success", "bg-danger", "text-dark", "text-white");

                        if (status === "dibatalkan") {
                            badge.classList.add("bg-danger", "text-white");
                        } else if (status === "selesai") {
                            badge.classList.add("bg-success", "text-white");
                        } else if (status === "diproses") {
                            badge.classList.add("bg-warning", "text-dark");
                        }

                        alert(`Status pesanan berhasil diubah menjadi ${status}.`);
                    } else {
                        alert(data.message || "Gagal memperbarui status pesanan.");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi kesalahan, coba lagi.");
                });
        }

        // Submit pembatalan dari modal
        function submitPembatalan() {
            const form = document.getElementById("formPembatalan");
            const formData = new FormData(form);
            const orderId = formData.get("order_id");
            const alasan = formData.get("alasan") === "Lainnya" ? formData.get("alasan_lainnya") : formData.get("alasan");

            if (!alasan) {
                alert("Silakan pilih atau isi alasan pembatalan.");
                return;
            }

            updateStatus(orderId, "dibatalkan", alasan);
        }

        // Tombol selesai langsung memanggil fungsi updateStatus tanpa modal
        document.querySelectorAll('form[data-status="selesai"]').forEach(form => {
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                const orderId = this.querySelector('input[name="order_id"]').value;
                updateStatus(orderId, "selesai");
            });
        });
    </script>

    <script>
        let rowIndex = 1;

        document.getElementById('addRow').addEventListener('click', function() {
            let table = document.querySelector('#produkTable tbody');
            let row = document.createElement('tr');
            row.innerHTML = `
        <td>${rowIndex+1}</td>
        <td>
            <select name="produk[${rowIndex}][id]" class="form-select produkSelect">
                <option disabled selected>Pilih Produk</option>
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_kg }}">
                        {{ $produk->nama_produk }}
                    </option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="produk[${rowIndex}][jumlah]" class="form-control jumlahInput" min="1" value="1"></td>
        <td class="text-end subtotal">Rp 0</td>
        <td><button type="button" class="btn btn-danger btn-sm hapusRow">Hapus</button></td>
    `;
            table.appendChild(row);
            rowIndex++;
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('jumlahInput') || e.target.classList.contains('produkSelect')) {
                hitungTotal();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('hapusRow')) {
                e.target.closest('tr').remove();
                hitungTotal();
            }
        });

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('#produkTable tbody tr').forEach(row => {
                let select = row.querySelector('.produkSelect');
                let jumlah = parseInt(row.querySelector('.jumlahInput').value) || 0;
                let harga = select.options[select.selectedIndex]?.getAttribute('data-harga') || 0;
                let subtotal = jumlah * harga;
                row.querySelector('.subtotal').textContent = "Rp " + subtotal.toLocaleString();
                total += subtotal;
            });
            document.getElementById('grandTotal').textContent = "Rp " + total.toLocaleString();
        }
    </script>
@endsection
