@extends('master')

@section('css')
    <style>
        #stoks,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.8rem;
        }

        #stoks th,
        #stoks td {
            padding: 0.5rem;
        }

        #stoks .btn .bx {
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
            <h1>Stok</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a>Kontrol ketersediaan pemesanan melalui fitur aktif/nonaktif.</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table id="stoks" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Stok per Kg</th>
                        <th class="text-center">Status Produk <br> (Aktif/Nonaktif)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Selada</td>
                        <td class="text-center">
                            20 Kg
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#ModalTambahStok">Tambahkan Stok</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="ModalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="modalTambahStokLabel">Tambah Stok $nama-produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="namaProduk" class="form-label">Stok</label>
                                <input type="text" class="form-control" id="namaProduk"
                                    placeholder="Masukkan nama produk">
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
            new DataTable('#stoks');
        </script>
    @endsection
