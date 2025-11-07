<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanMingguanController extends Controller
{
    public function index()
    {
        // Rentang waktu 7 hari terakhir
        $startDate = Carbon::now()->startOfWeek(Carbon::MONDAY)->startOfDay();
        $endDate = Carbon::now()->endOfWeek(Carbon::SUNDAY)->endOfDay();

        // Ambil pesanan yang dibuat selama 7 hari terakhir
        $pesananMingguan = Pesanan::whereBetween('created_at', [$startDate, $endDate])->get();

        // --- 1. Total sayur terjual (hanya dari pesanan selesai)
        $totalSayurTerjual = DetailPesanan::whereHas('pesanan', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate])
                ->where('status_pesanan', 'selesai');
        })->sum('jumlah_kg');

        // --- 2. Jumlah pesanan diselesaikan
        $pesananSelesai = $pesananMingguan->where('status_pesanan', 'selesai')->count();

        // --- 3. Jumlah pesanan dibatalkan
        $pesananDibatalkan = $pesananMingguan->where('status_pesanan', 'dibatalkan')->count();

        // --- 4. Rincian sayur terjual per produk
        $rincianSayur = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah_kg) as total_kg'))
            ->whereHas('pesanan', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate])
                    ->where('status_pesanan', 'selesai');
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_kg')
            ->get();

        // --- 5. Alasan pembatalan (untuk chart donut)
        $alasanPembatalan = Pesanan::select('alasan_dibatalkan', DB::raw('COUNT(*) as jumlah'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pesanan', 'dibatalkan')
            ->groupBy('alasan_dibatalkan')
            ->pluck('jumlah', 'alasan_dibatalkan');

        // Siapkan data untuk Chart.js
        $chartLabels = $alasanPembatalan->keys();
        $chartData = $alasanPembatalan->values();

        return view('admin.laporanmingguan', compact(
            'totalSayurTerjual',
            'pesananSelesai',
            'pesananDibatalkan',
            'rincianSayur',
            'chartLabels',
            'chartData'
        ));
    }
}
