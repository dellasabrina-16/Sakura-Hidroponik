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
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahPesanan">
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
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">2025-09-04</td>
                        <td>Andi Saputra</td>
                        <td>Selada (2 Kg)</td>
                        <td>Diantar</td>
                        <td>Jl. Merdeka No. 10, Jakarta</td>
                        <td class="text-end">Rp 42.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                {{-- Badge status --}}
                                <div class="dropdown">
                                    <button class="badge bg-warning text-dark border-0 dropdown-toggle" type="button"
                                        id="statusDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Diproses
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="statusDropdown1">
                                        <li><a class="dropdown-item text-success" href="#">Selesai</a></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                data-bs-target="#ModalPembatalan" onclick="setOrderId(1)">
                                                Dibatalkan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- Tombol detail --}}
                                <button class="btn btn-link btn-sm p-0" data-bs-toggle="modal"
                                    data-bs-target="#ModalDetailPesanan1">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
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
        <div class="modal fade" id="ModalDetailPesanan1" tabindex="-1" aria-labelledby="ModalDetailPesananLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="ModalDetailPesananLabel1">Detail Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="printArea1">

                        <!-- Header Toko -->
                        <div class="text-center mb-2">
                            <h6 class="fw-bold mb-0">🌱 Sakura Hidroponik 🌱</h6>
                            <small>Jl. Mawar No. 10, Jakarta</small><br>
                            <small>Telp/WA: 0812-3456-7890</small>
                            <hr style="border-top: 1px dashed #000;">
                        </div>

                        <!-- Info Pesanan -->
                        <div>
                            <small>Tanggal : 2025-09-04</small><br>
                            <small>Pelanggan : Andi Saputra</small><br>
                            <small>Jenis : Diantar</small><br>
                            <small>Alamat : Jl. Merdeka No. 10</small><br>
                            <hr style="border-top: 1px dashed #000;">
                        </div>

                        <!-- List Produk -->
                        <div>
                            <table class="w-100" style="font-size: 13px;">
                                <tbody>
                                    <tr>
                                        <td>Selada</td>
                                        <td class="text-end">2 x 21.000</td>
                                        <td class="text-end">42.000</td>
                                    </tr>
                                    <tr>
                                        <td>Tomat</td>
                                        <td class="text-end">1 x 15.000</td>
                                        <td class="text-end">15.000</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr style="border-top: 1px dashed #000;">
                        </div>

                        <!-- Total -->
                        <div class="text-end fw-bold" style="font-size: 14px;">
                            Total: Rp 57.000
                        </div>

                        <hr style="border-top: 1px dashed #000;">

                        <!-- Footer -->
                        <div class="text-center">
                            <small>Terima kasih 🙏</small><br>
                            <small>Belanja Sayur Segar di Sakura Hidroponik</small>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" onclick="printStruk('printArea1')">
                            <i class="bi bi-printer"></i> Print Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama pelanggan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Pesanan</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nomor WhatsApp</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nomor WhatsApp">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Metode Pengambilan</label>
                                    <select class="form-select">
                                        <option selected disabled>Pilih metode</option>
                                        <option>Diantar</option>
                                        <option>Ambil di Kebun</option>
                                        <option>Ambil di Toko</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="2" placeholder="Masukkan alamat pelanggan"></textarea>
                            </div>

                            <h6 class="fw-bold mb-2">Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th style="width: 40%;">Nama Produk</th>
                                            <th style="width: 20%;">Jumlah (Kg)</th>
                                            <th style="width: 20%;">Total Harga</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select class="form-select">
                                                    <option>Pilih Produk</option>
                                                    <option>Cabai Rawit</option>
                                                    <option>Tomat</option>
                                                    <option>Bawang Merah</option>
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-control" placeholder="0"></td>
                                            <td class="text-end">Rp 42.000</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Produk
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Simpan</button>
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
            // Tampilkan input alasan jika pilih "Lainnya"
            document.addEventListener("DOMContentLoaded", function() {
                const alasanSelect = document.getElementById("alasanSelect");
                const alasanLainnyaWrapper = document.getElementById("alasanLainnyaWrapper");

                alasanSelect.addEventListener("change", function() {
                    if (this.value === "Lainnya") {
                        alasanLainnyaWrapper.classList.remove("d-none");
                    } else {
                        alasanLainnyaWrapper.classList.add("d-none");
                    }
                });
            });

            // Simpan order_id yang diklik
            function setOrderId(id) {
                document.getElementById("orderId").value = id;
            }

            // Submit alasan pembatalan
            function submitPembatalan() {
                const form = document.getElementById("formPembatalan");
                const formData = new FormData(form);
                const orderId = formData.get("order_id");
                const alasan = formData.get("alasan") === "Lainnya" ? formData.get("alasan_lainnya") : formData.get("alasan");

                if (!alasan) {
                    alert("Silakan pilih atau isi alasan pembatalan.");
                    return;
                }

                // Simulasi kirim ke backend
                console.log("Pesanan ID:", orderId, "dibatalkan dengan alasan:", alasan);

                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById("ModalPembatalan"));
                modal.hide();

                // TODO: update status badge ke "Dibatalkan" (opsional)
                document.getElementById("statusDropdown" + orderId).innerText = "Dibatalkan";
                document.getElementById("statusDropdown" + orderId).className =
                    "badge bg-danger text-white border-0 dropdown-toggle";
            }
        </script>
    @endsection
