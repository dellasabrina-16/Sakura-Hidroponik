@extends('master')

@section('css')
    <style>
        #produks,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.8rem;
        }

        #produks th,
        #produks td {
            padding: 0.5rem;
        }

        #produks .btn .bx {
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
        <div class="table-responsive">
            <table id="produks" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">No</th> 
                        <th>Nama Produk</th>
                        <th>Foto Produk</th>
                        <th>Deskripsi</th>
                        <th class="text-end">Harga per Kg</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Selada</td>
                        <td>
                            <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Foto Produk"
                                class="img-fluid rounded">
                        </td>
                        <td>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </td>
                        <td class="text-end">Rp 21.000</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalEditProduk" title="Edit Produk">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-danger btn-sm" title="Hapus Produk">
                                    <i class='bx bx-trash'></i> 
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
