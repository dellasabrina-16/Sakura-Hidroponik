@extends('master')

@section('isi')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3>Pesanan Selesai</h3>
                <p class="text-muted">Lihat daftar pesanan yang sudah diselesaikan disini</p>
            </div>
            <button class="btn btn-dark">Cetak Laporan</button>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <select class="form-select w-auto">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <input type="text" class="form-control w-25" placeholder="Search...">
        </div>

        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Produk</th>
                    <th>Metode Pengambilan</th>
                    <th>Alamat</th>
                    <th>Nomor WhatsApp</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ibu Sulastri</td>
                    <td>2 Produk</td>
                    <td>Diantar</td>
                    <td>Ds. Kasim, Rt 4 Rw 7</td>
                    <td>0987654567898</td>
                    <td>Rp 63.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ibu Suasmi</td>
                    <td>2 Produk</td>
                    <td>Ambil di kebun</td>
                    <td>-</td>
                    <td>0987654567898</td>
                    <td>Rp 63.000</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
