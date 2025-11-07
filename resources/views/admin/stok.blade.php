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

        /* Button group stok */
        .stok-group .btn {
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem;
        }

        /* Tombol stok utama (menampilkan jumlah stok) */
        .btn-stok {
            background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-stok:hover {
            background: linear-gradient(135deg, #dcedc8, #e8f5e9);
            transform: scale(1.03);
            color: #2e7d32;
        }

        /* Tombol tambah stok */
        .btn-tambah-stok {
            background: linear-gradient(135deg, #43a047, #66bb6a);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-tambah-stok:hover {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            transform: scale(1.03);
            color: #fff;
        }

        /* Tambahan bayangan halus untuk keseluruhan grup */
        .stok-group {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .stok-group .btn:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .stok-group .btn:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }


        .badge.bg-success {
            background: linear-gradient(135deg, #81c784, #66bb6a);
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #e57373, #ef5350);
        }

        .badge.bg-dark {
            background: linear-gradient(135deg, #757575, #424242);
        }

        .badge.bg-secondary {
            background: linear-gradient(135deg, #bdbdbd, #9e9e9e);
        }
    </style>
@endsection

@section('isi')
    <div class="pagetitle mb-3">
        <h1>Stok</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Kontrol ketersediaan produk melalui fitur aktif/nonaktif.</li>
            </ol>
        </nav>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table id="stoks" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Stok per Kg</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stoks as $stok)
                        <tr data-id="{{ $stok->id }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $stok->produk->nama_produk }}</td>
                            <td class="text-center stok-kg">
                                <div class="btn-group stok-group" role="group" aria-label="Stok button group">
                                    <button type="button" class="btn btn-stok">
                                        {{ $stok->stok_kg }} Kg
                                    </button>
                                    <button type="button" class="btn btn-tambah-stok btn-tambah" data-bs-toggle="modal"
                                        data-bs-target="#modalTambahStok" data-nama="{{ $stok->produk->nama_produk }}"
                                        data-id="{{ $stok->id }}">
                                        <i class="bi bi-plus-circle me-1"></i> Tambah
                                    </button>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-status" type="checkbox"
                                            {{ $stok->status ? 'checked' : '' }}>
                                    </div>

                                    {{-- Badge kondisi stok --}}
                                    @if ($stok->stok_kg == 0)
                                        <span class="badge bg-dark mt-1">Stok Habis</span>
                                    @elseif (!$stok->status)
                                        <span class="badge bg-secondary mt-1">Nonaktif</span>
                                    @elseif ($stok->stok_kg < 5)
                                        <span class="badge bg-danger mt-1">Stok Sedikit</span>
                                    @else
                                        <span class="badge bg-success mt-1">Stok Aman</span>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Stok --}}
    <div class="modal fade" id="modalTambahStok" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah Stok: <span id="namaProdukLabel"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahStok">
                        <input type="hidden" id="stokId">
                        <div class="mb-3">
                            <label for="stokProduk" class="form-label">Stok (kg)</label>
                            <input type="number" class="form-control" id="stokProduk" placeholder="Masukkan jumlah stok"
                                min="0" step="1" required>
                            <div class="form-text">Masukkan stok dalam satuan kilogram (kg). Hanya angka bulat.</div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-hijau">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const table = new DataTable('#stoks');

        // Modal Tambah stok
        const modal = document.getElementById('modalTambahStok');
        const namaLabel = document.getElementById('namaProdukLabel');
        const stokIdInput = document.getElementById('stokId');
        const stokInput = document.getElementById('stokProduk');

        document.querySelectorAll('.btn-tambah').forEach(btn => {
            btn.addEventListener('click', function() {
                namaLabel.textContent = btn.dataset.nama;
                stokIdInput.value = btn.dataset.id;
                stokInput.value = '';
            });
        });

        // Submit tambah stok via AJAX
        document.getElementById('formTambahStok').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = stokIdInput.value;
            const stok = parseInt(stokInput.value);

            fetch(`/admin/stok/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        stok_kg: stok
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        row.querySelector('.stok-kg').textContent = res.stok.stok_kg + ' Kg';

                        // update toggle checked/unchecked
                        const toggle = row.querySelector('.toggle-status');
                        toggle.checked = res.stok.status;

                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Stok diperbarui',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });

                        // Swal.fire({
                        //     title: 'Berhasil',
                        //     text: 'Stok diperbarui',
                        //     icon: 'success',
                        //     showConfirmButton: false, 
                        //     timer: 1000, 
                        //     timerProgressBar: true
                        // }).then(() => {
                        //     location.reload();
                        // });

                        // tutup modal
                        const bsModal = bootstrap.Modal.getInstance(modal);
                        bsModal.hide();

                        // // refresh halaman untuk update badge dari Blade
                        // location.reload();
                    }
                });
        });

        // Toggle status via AJAX
        document.querySelectorAll('.toggle-status').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const row = toggle.closest('tr');
                const id = row.dataset.id;

                fetch(`/admin/stok/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: toggle.checked
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        // setelah update status, refresh halaman supaya badge dari Blade ter-update
                        location.reload();
                    });
            });
        });
    </script>
@endsection
