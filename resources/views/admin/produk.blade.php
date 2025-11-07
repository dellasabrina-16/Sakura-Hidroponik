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

        /* preview image */
        .preview-img {
            max-width: 100%;
            display: block;
            border-radius: 0.5rem;
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
                    <li class="breadcrumb-item">
                        <a>Lihat ringkasan mingguan omzet, status stok terkini, dan daftar pesanan yang belum terpenuhi.</a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Tombol "Tambah Produk" --}}
        <button class="btn btn-hijau" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
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
                        <th class="text-center">Harga<br>per Kg</th>
                        <th class="text-center">Status</th> {{-- baru --}}
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr data-id="{{ $produk->id }}" data-nama="{{ $produk->nama_produk }}"
                            data-deskripsi="{{ $produk->deskripsi_produk }}" data-harga="{{ $produk->harga_kg }}"
                            data-foto="{{ asset('storage/' . $produk->foto_produk) }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Foto Produk"
                                    class="img-fluid rounded" style="max-width: 80px;">
                            </td>
                            <td>{{ $produk->deskripsi_produk }}</td>
                            <td class="text-center">Rp {{ number_format($produk->harga_kg, 0, ',', '.') }}</td>

                            {{-- Badge status stok --}}
                            <td class="text-center">
                                @if ($produk->stok && $produk->stok->stok_kg == 0)
                                    <span class="badge bg-dark">Stok Habis</span>
                                @elseif ($produk->stok && $produk->stok->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                                <br>
                                {{-- Badge stok rendah --}}
                                @if ($produk->stok && $produk->stok->stok_kg > 0 && $produk->stok->stok_kg < 5 && $produk->stok->status)
                                    {{-- <span class="badge bg-danger">Stok Rendah</span> --}}
                                    <span class="badge bg-danger">{{ $produk->stok->stok_kg }} kg</span>
                                @endif
                            </td>


                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#modalEditProduk">
                                        <i class='bx bx-edit'></i>
                                    </button>
                                    <form class="form-hapus" action="{{ route('produk.destroy', $produk->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    {{-- Modal Tambah Produk --}}
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Produk</label>
                            <input type="file" id="foto_produk" name="foto_produk" class="form-control file-input"
                                data-preview="previewTambah" accept="image/*" required>
                            {{-- <div class="mt-3">
                                <img id="previewTambah" class="preview-img" />
                            </div> --}}

                            <!-- Preview dan crop area -->
                            <div class="mt-3" style="max-width: 100%; text-align:center;">
                                <img id="previewTambah" src="#" alt="Preview" style="max-width:100%; display:none;">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi_produk" class="form-control" rows="3" minlength="20" maxlength="100" required
                                placeholder="Masukkan deskripsi produk (20–100 karakter)"></textarea>
                            <div class="form-text">Deskripsi minimal 20 dan maksimal 100 karakter.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga per Kg</label>
                            <input type="number" name="harga_kg" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok Awal (kg)</label>
                            <input type="number" name="stok_kg" class="form-control" min="0" step="1"
                                placeholder="Masukkan stok awal">
                            <div class="form-text">Kosong / 0 = status produk nonaktif.</div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-hijau">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Edit Produk --}}
    <div class="modal fade" id="modalEditProduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditProduk" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" id="editNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Produk</label>
                            <input type="file"id="foto_produk" name="foto_produk" id="editFoto"
                                class="form-control file-input" data-preview="previewEdit" accept="image/*">
                            {{-- <div class="mt-3">
                                <img id="previewEdit" class="preview-img" />
                            </div> --}}

                            <!-- Preview dan crop area -->
                            <div class="mt-3" style="max-width: 100%; text-align:center;">
                                <img id="previewEdit" src="#" alt="Preview"
                                    style="max-width:100%; display:none;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi_produk" id="editDeskripsi" class="form-control" rows="3" minlength="20"
                                maxlength="100" required placeholder="Masukkan deskripsi produk (20–100 karakter)"></textarea>
                            <div class="form-text">Deskripsi minimal 20 dan maksimal 100 karakter.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per Kg</label>
                            <input type="number" name="harga_kg" id="editHarga" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-hijau">Simpan Perubahan</button>
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
        // DataTable
        new DataTable('#produks');

        // Auto-preview gambar
        document.querySelectorAll(".file-input").forEach(input => {
            input.addEventListener("change", e => {
                const file = e.target.files[0];
                const previewId = e.target.dataset.preview;
                const preview = document.getElementById(previewId);
                if (file) {
                    const reader = new FileReader();
                    reader.onload = ev => {
                        preview.src = ev.target.result;
                        preview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // SweetAlert feedback
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: "{{ session('warning') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // SweetAlert konfirmasi hapus
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus produk ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Modal edit tunggal
        const modalEdit = document.getElementById('modalEditProduk');
        const editNama = document.getElementById('editNama');
        const editDeskripsi = document.getElementById('editDeskripsi');
        const editHarga = document.getElementById('editHarga');
        const editPreview = document.getElementById('previewEdit');
        const formEdit = document.getElementById('formEditProduk');

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = btn.closest('tr');
                const id = row.dataset.id;
                const nama = row.dataset.nama;
                const deskripsi = row.dataset.deskripsi;
                const harga = row.dataset.harga;
                const foto = row.dataset.foto;

                editNama.value = nama;
                editDeskripsi.value = deskripsi;
                editHarga.value = harga;
                editPreview.src = foto;
                editPreview.style.display = 'block';

                formEdit.action = `/admin/produk/${id}`;
            });
        });
    </script>

    <script>
        let cropperTambah, cropperEdit;

        const inputTambah = document.querySelector('#modalTambahProduk input[name="foto_produk"]');
        const imageTambah = document.getElementById('previewTambah');

        inputTambah.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                imageTambah.src = event.target.result;
                imageTambah.style.display = 'block';

                if (cropperTambah) cropperTambah.destroy();

                cropperTambah = new Cropper(imageTambah, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    movable: true,
                    zoomable: true,
                });
            };
            reader.readAsDataURL(file);
        });

        document.querySelector('#modalTambahProduk form').addEventListener('submit', function(e) {
            e.preventDefault();

            if (cropperTambah) {
                cropperTambah.getCroppedCanvas().toBlob((blob) => {
                    const formData = new FormData(e.target);
                    formData.delete('foto_produk');
                    formData.append('foto_produk', blob, 'cropped.png');

                    fetch(e.target.action, {
                        method: 'POST',
                        body: formData,
                    }).then(() => {
                        // Tutup modal
                        const modalTambah = bootstrap.Modal.getInstance(document.getElementById(
                            'modalTambahProduk'));
                        modalTambah.hide();

                        // Tunggu modal tertutup sebelum menampilkan SweetAlert
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Produk berhasil ditambah!',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        }, 500); // jeda 0.5 detik agar modal benar-benar tertutup
                    });

                });
            } else {
                e.target.submit();
            }
        });


        const inputEdit = document.querySelector('#modalEditProduk input[name="foto_produk"]');
        const imageEdit = document.getElementById('previewEdit');
        const formEditProduk = document.querySelector('#modalEditProduk form');

        inputEdit.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                imageEdit.src = event.target.result;
                imageEdit.style.display = 'block';

                if (cropperEdit) cropperEdit.destroy();

                cropperEdit = new Cropper(imageEdit, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    movable: true,
                    zoomable: true,
                });
            };
            reader.readAsDataURL(file);
        });

        formEditProduk.addEventListener('submit', function(e) {
            e.preventDefault();

            if (cropperEdit) {
                cropperEdit.getCroppedCanvas().toBlob((blob) => {
                    const formData = new FormData(e.target);
                    formData.delete('foto_produk');
                    formData.append('foto_produk', blob, 'cropped.png');

                    fetch(e.target.action, {
                        method: 'POST',
                        body: formData,
                    }).then(() => {
                        // Tutup modal
                        const modalEdit = bootstrap.Modal.getInstance(document.getElementById(
                            'modalEditProduk'));
                        modalEdit.hide();

                        // Tunggu modal tertutup sebelum menampilkan SweetAlert
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Perubahan disimpan!',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        }, 500);
                    });

                });
            } else {
                e.target.submit();
            }
        });
    </script>
@endsection
