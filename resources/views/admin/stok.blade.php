@extends('master')

@section('isi')
    <div class="container-fluid p-4" style="background-color: #f8fdf8; min-height: 100vh;">
        <!-- Judul Halaman -->
        <div class="mb-4">
            <h3 class="fw-bold">Stok</h3>
            <p class="text-muted mb-0">Kontrol ketersediaan pemesanan melalui fitur aktif/nonaktif.</p>
        </div>

        <!-- Dropdown dan Search -->
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

        <!-- Tabel Stok -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Produk</th>
                        <th style="width: 20%;">Stok per Kg</th>
                        <th style="width: 25%;">Status Produk<br>(Tersedia/Tidak)</th>
                        <th style="width: 25%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Selada</td>
                        <td>40</td>
                        <td>
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#Modaltambahstok">Tambahkan Stok</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="Modaltambahstok" tabindex="-1" aria-labelledby="modaltambahstok" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalTambahProdukLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="namaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="namaProduk" placeholder="Masukkan nama produk">
                        </div>
                        <div class="mb-3">
                            <label for="namaProduk" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="namaProduk" placeholder="Masukkan nama produk">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
