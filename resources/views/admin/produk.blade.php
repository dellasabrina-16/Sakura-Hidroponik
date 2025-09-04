@extends('master')

@section('css')
    <style>
        /* Mengatur ukuran font untuk seluruh tabel DataTables */
        #produks,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.8rem;
            /* Anda bisa sesuaikan nilai ini (misalnya 0.75rem, 12px, dll) */
        }

        /* Mengatur padding di dalam sel tabel (th dan td) agar lebih ringkas */
        #produks th,
        #produks td {
            padding: 0.5rem;
            /* Sesuaikan nilai padding untuk jarak yang ideal */
        }

        /* Mengatur ukuran ikon agar tidak terlalu besar */
        #produks .btn .bx {
            font-size: 1rem;
            /* Sesuaikan ukuran ikon */
        }

        /* Mengatur ukuran input pencarian agar lebih kecil */
        .dataTables_wrapper .dataTables_filter input[type="search"] {
            height: 25px;
            /* Sesuaikan tinggi */
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('isi')
    <div
        class="pagetitle d-flex flex-column flex-md-row justify-content-md-between align-items-start align-items-md-center mb-3">
        {{-- Grup Judul dan Breadcrumb --}}
        <div class="mb-3 mb-md-0">
            <h1>Produk</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a>Lihat ringkasan mingguan omzet, status stok terkini, dan daftar pesanan
                            yang belum terpenuhi.</a></li>
                </ol>
            </nav>
        </div>

        {{-- Tombol "Tambah Produk" --}}
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
            <i class='bx bx-plus me-2'></i> Tambah Produk
        </button>
    </div>
    <div class="card p-4">
        {{-- caption bisa dihilangkan atau di-styling jika diperlukan, DataTables punya info default --}}
        {{-- <caption class="mb-2">Daftar Produk</caption> --}}
        <div class="table-responsive">
            <table id="produks" class="table table-striped table-sm"> {{-- Tambahkan .table-sm untuk tabel lebih ringkas --}}
                <thead>
                    <tr>
                        <th class="text-center">No</th> {{-- text-center untuk rata tengah --}}
                        <th>Nama Produk</th>
                        <th>Foto Produk</th>
                        <th>Deskripsi</th>
                        <th class="text-end">Harga per Kg</th> {{-- text-end untuk rata kanan --}}
                        <th class="text-center">Aksi</th> {{-- text-center untuk rata tengah --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Selada</td>
                        <td>
                            <img src="https://via.placeholder.com/80" alt="Foto Produk" class="img-fluid rounded">
                            {{-- rounded untuk sudut melengkung --}}
                        </td>
                        <td>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </td>
                        <td class="text-end">Rp 21.000</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Tombol Edit dengan warna dan ikon yang lebih estetik --}}
                                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalEditProduk" title="Edit Produk">
                                    <i class='bx bx-edit'></i> {{-- Ikon edit dari Boxicons --}}
                                </button>
                                {{-- Tombol Hapus dengan warna dan ikon yang lebih estetik --}}
                                <button class="btn btn-danger btn-sm" title="Hapus Produk">
                                    <i class='bx bx-trash'></i> {{-- Ikon hapus dari Boxicons --}}
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Produk --}}
        <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel"
            aria-hidden="true">
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
                                <input type="text" class="form-control" id="namaProduk"
                                    placeholder="Masukkan nama produk">
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

        {{-- Modal Edit Produk --}}
        <div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="modalEditProdukLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="modalEditProdukLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="namaProduk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="namaProduk"
                                    placeholder="Masukkan nama produk">
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
                                <input type="number" class="form-control" id="hargaProduk"
                                    placeholder="Masukkan harga">
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

    @section('script')
        <script>
            new DataTable('#produks');
        </script>
    @endsection
