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
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        // Total Kg yang terjual (hanya dari pesanan selesai)
        $totalTerjual = DetailPesanan::whereHas('pesanan', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->where('status_pesanan', 'selesai')
                ->whereBetween('tanggal_pesanan', [$startOfWeek, $endOfWeek]);
        })
            ->sum('jumlah_kg');

        // Total pendapatan (hanya dari pesanan selesai)
        $totalPendapatan = DetailPesanan::whereHas('pesanan', function ($query) use ($startOfWeek, $endOfWeek) {
            $query->where('status_pesanan', 'selesai')
                ->whereBetween('tanggal_pesanan', [$startOfWeek, $endOfWeek]);
        })
            ->sum('harga');

        return view('admin.dashboard', compact('totalTerjual', 'totalPendapatan'));
    }
}
