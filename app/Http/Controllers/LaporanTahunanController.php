<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanTahunanController extends Controller
{
    public function index(Request $request)
    {
        // --- Ambil tahun dari request, default tahun sekarang
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Rentang waktu tahun tersebut
        $startDate = Carbon::createFromDate($tahun, 1, 1)->startOfDay();
        $endDate = Carbon::createFromDate($tahun, 12, 31)->endOfDay();

        // Ambil semua pesanan dalam tahun tersebut
        $pesananTahunan = Pesanan::whereBetween('created_at', [$startDate, $endDate])->get();

        // --- Total pendapatan selama setahun
        $totalPendapatan = $pesananTahunan
            ->where('status_pesanan', 'selesai')
            ->sum('total_harga');

        // --- Total sayur terjual (dalam kg)
        $totalSayurTerjual = DetailPesanan::whereHas('pesanan', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate])
                ->where('status_pesanan', 'selesai');
        })->sum('jumlah_kg');

        // --- Jumlah pesanan selesai
        $pesananSelesai = $pesananTahunan->where('status_pesanan', 'selesai')->count();

        // --- Jumlah pesanan dibatalkan
        $pesananDibatalkan = $pesananTahunan->where('status_pesanan', 'dibatalkan')->count();

        // --- Pendapatan per bulan (untuk chart garis/batang)
        $pendapatanBulanan = Pesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereYear('created_at', $tahun)
            ->where('status_pesanan', 'selesai')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan');

        // --- Produk terlaris selama setahun
        $produkTerlaris = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah_kg) as total_kg'))
            ->whereHas('pesanan', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate])
                    ->where('status_pesanan', 'selesai');
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_kg')
            ->first();

        // --- Alasan pembatalan sepanjang tahun (untuk pie chart)
        $alasanPembatalan = Pesanan::select('alasan_dibatalkan', DB::raw('COUNT(*) as jumlah'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pesanan', 'dibatalkan')
            ->groupBy('alasan_dibatalkan')
            ->pluck('jumlah', 'alasan_dibatalkan');

        $chartLabels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        $chartPendapatan = [];
        foreach ($chartLabels as $num => $nama) {
            $chartPendapatan[] = $pendapatanBulanan[$num] ?? 0;
        }

        $alasanLabels = $alasanPembatalan->keys();
        $alasanData = $alasanPembatalan->values();

        // --- Daftar tahun untuk dropdown
        $tahunList = range(Carbon::now()->year - 3, Carbon::now()->year + 1);

        return view('admin.laporantahunan', compact(
            'tahun',
            'tahunList',
            'totalPendapatan',
            'totalSayurTerjual',
            'pesananSelesai',
            'pesananDibatalkan',
            'produkTerlaris',
            'chartLabels',
            'chartPendapatan',
            'alasanLabels',
            'alasanData'
        ));
    }
}
