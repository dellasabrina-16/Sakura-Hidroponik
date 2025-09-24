<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Range minggu ini (Senin sampai Minggu)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        // Total Kg yang terjual (hanya dari pesanan selesai)
        $totalTerjual = DetailPesanan::whereHas('pesanan', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->where('status_pesanan', 'selesai')
                ->whereBetween('tanggal_pesanan', [$startOfWeek, $endOfWeek]);
        })->sum('jumlah_kg');

        // Total pendapatan (hanya dari pesanan selesai, seluruh minggu)
        $totalPendapatan = DetailPesanan::whereHas('pesanan', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->where('status_pesanan', 'selesai')
                ->whereBetween('tanggal_pesanan', [$startOfWeek, $endOfWeek]);
        })->sum('harga');

        // Pendapatan harian minggu ini
        $pendapatanHarian = DetailPesanan::selectRaw('DATE(pesanans.tanggal_pesanan) as tanggal, SUM(detail_pesanans.harga) as total')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.status_pesanan', 'selesai')
            ->whereBetween('pesanans.tanggal_pesanan', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Buat array untuk chart (isi 0 kalau tidak ada transaksi di hari itu)
        $dates = [];
        $revenues = [];
        $period = Carbon::parse($startOfWeek)->daysUntil($endOfWeek);

        foreach ($period as $date) {
            $tanggal = $date->format('Y-m-d');
            $dates[] = $tanggal;

            $found = $pendapatanHarian->firstWhere('tanggal', $tanggal);
            $revenues[] = $found ? $found->total : 0;
        }

        // Ambil daftar pesanan status "diproses" (order dari terlama -> terbaru)
        $daftarPesanan = Pesanan::with('details')
            ->where('status_pesanan', 'diproses')
            ->orderBy('tanggal_pesanan', 'asc')
            ->get();


        return view('admin.dashboard', compact('totalTerjual', 'totalPendapatan', 'dates', 'revenues', 'daftarPesanan'));
    }

}
