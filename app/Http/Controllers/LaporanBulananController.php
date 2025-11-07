<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanBulananController extends Controller
{
    public function index(Request $request)
    {
        // --- Ambil bulan & tahun dari request, default = bulan sekarang
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Rentang tanggal berdasarkan bulan & tahun
        $startDate = Carbon::createFromDate($tahun, $bulan, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfMonth();

        // Ambil semua pesanan dalam bulan tersebut
        $pesananBulanan = Pesanan::whereBetween('created_at', [$startDate, $endDate])->get();

        // --- 1. Total sayur terjual (pesanan selesai)
        $totalSayurTerjual = DetailPesanan::whereHas('pesanan', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate])
                ->where('status_pesanan', 'selesai');
        })->sum('jumlah_kg');

        // --- 2. Jumlah pesanan selesai
        $pesananSelesai = $pesananBulanan->where('status_pesanan', 'selesai')->count();

        // --- 3. Jumlah pesanan dibatalkan
        $pesananDibatalkan = $pesananBulanan->where('status_pesanan', 'dibatalkan')->count();

        // --- 4. Total pendapatan bulan ini
        $totalPendapatan = $pesananBulanan
            ->where('status_pesanan', 'selesai')
            ->sum('total_harga');

        // --- 5. Rincian sayur terjual
        $rincianSayur = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah_kg) as total_kg'))
            ->whereHas('pesanan', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate])
                    ->where('status_pesanan', 'selesai');
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_kg')
            ->get();

        // --- 6. Alasan pembatalan (untuk chart)
        $alasanPembatalan = Pesanan::select('alasan_dibatalkan', DB::raw('COUNT(*) as jumlah'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pesanan', 'dibatalkan')
            ->groupBy('alasan_dibatalkan')
            ->pluck('jumlah', 'alasan_dibatalkan');

        // --- 7. Ambil produk terlaris berdasarkan total_kg terbanyak
        $produkTerlaris = $rincianSayur->sortByDesc('total_kg')->first();

        $chartLabels = $alasanPembatalan->keys();
        $chartData = $alasanPembatalan->values();

        // Untuk dropdown bulan & tahun
        $bulanList = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $tahunList = range(Carbon::now()->year - 2, Carbon::now()->year + 1);

        return view('admin.laporanbulanan', compact(
            'totalSayurTerjual',
            'pesananSelesai',
            'pesananDibatalkan',
            'totalPendapatan',
            'rincianSayur',
            'chartLabels',
            'chartData',
            'bulan',
            'tahun',
            'bulanList',
            'tahunList',
            'produkTerlaris'
        ));
    }
}
