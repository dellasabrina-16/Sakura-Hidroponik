@extends('master')

@section('isi')
    <div class="container-fluid p-4" style="background-color: #f8fdf8; min-height: 100vh;">
        <!-- Judul Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Produk</h3>
                <p class="text-muted mb-0">Lihat ringkasan mingguan omzet, status stok terkini, dan daftar pesanan yang
                    belum terpenuhi.</p>
            </div>
            <!-- Tombol Tambah Produk -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                Tambah
            </button>
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

        <!-- Tabel Produk -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Nama Produk</th>
                        <th style="width: 15%;">Foto Produk</th>
                        <th style="width: 40%;">Deskripsi</th>
                        <th style="width: 15%;">Harga per Kg</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Selada</td>
                        <td class="text-center">
                            <img src="https://via.placeholder.com/80" alt="Foto Produk" class="img-fluid">
                        </td>
                        <td>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </td>
                        <td class="text-center">Rp 21.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger" disabled>Hapus</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
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
                            <label for="fotoProduk" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="fotoProduk">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsiProduk" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsiProduk" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hargaProduk" class="form-label">Harga per Kg</label>
                            <input type="number" class="form-control" id="hargaProduk" placeholder="Masukkan harga">
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
