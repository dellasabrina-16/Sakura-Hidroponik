@extends('master')

@section('isi')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Pesanan Masuk</h3>
            <p class="text-muted mb-0">
                Kelola status dan data pesanan pelanggan secara efisien.
            </p>
        </div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modaltambah">Tambah</button>
    </div>

    <!-- Filter & Search -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <select class="form-select form-select-sm w-auto me-2">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>entries per page</span>
        </div>
        <input type="text" class="form-control form-control-sm w-25" placeholder="Search...">
    </div>

    <!-- Tabel Pesanan Masuk -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nama Pelanggan</th>
                    <th style="width: 10%;">Jumlah Produk</th>
                    <th style="width: 15%;">Metode Pengambilan</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 15%;">Nomor WhatsApp</th>
                    <th style="width: 10%;">Total Harga</th>
                    <th style="width: 10%;">Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Ibu Sulastri</td>
                    <td class="text-center">2 Produk</td>
                    <td class="text-center">Diantar</td>
                    <td>Dsn. Kasim, Rt 4 Rw 7</td>
                    <td class="text-center">0987654567898</td>
                    <td class="text-center">Rp 63.000</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <span class="badge bg-warning text-dark">Diproses</span>
                            <button class="btn btn-link btn-sm p-0" data-bs-toggle="modal" data-bs-target="#Modaldetail">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- tambah --}}
    <div class="modal fade" id="Modaltambah" tabindex="-1" aria-labelledby="ModaltambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTambahPesananLabel">Tambah Pesanan</h5>
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
                                <input type="text" class="form-control" placeholder="Contoh: Diantar, Ambil di Kebun">
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
                                        <th style="width: 20%;">Jumlah per Kg</th>
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
                                            <button class="btn btn-secondary btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- detail --}}
    <div class="modal fade" id="Modaldetail" tabindex="-1" aria-labelledby="ModaldetailLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-check-circle display-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold">Detail Pesanan</h5>
                    <div class="text-start mt-3">
                        <p><strong>Nama</strong> : Ibu Sulasmi</p>
                        <p><strong>Detail Pesanan</strong> :</p>
                        <ul>
                            <li>2 Kg Selada</li>
                            <li>2 Kg Pakcoy</li>
                        </ul>
                        <p><strong>Metode Pengambilan</strong> : Diantar</p>
                        <p><strong>Alamat</strong> : Dsn. Kasim, Rt 04 Rw 07</p>
                        <p><strong>Nomor WhatsApp</strong> : 0987654567898</p>
                        <p><strong>Total Harga</strong> : Rp 63.000</p>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="button" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
