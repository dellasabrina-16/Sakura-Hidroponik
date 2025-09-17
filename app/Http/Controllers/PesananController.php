<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with('details.produk')
            ->where('status_pesanan', 'diproses')
            ->orderBy('tanggal_pesanan', 'asc')
            ->get();

        $produks = Produk::whereHas('stok', function ($q) {
            $q->where('status', true);
        })->with('stok')->get();


        return view('admin/pesananmasuk', compact('pesanans', 'produks'));
    }

    public function riwayatpesanan()
    {
        $pesananSelesai = Pesanan::with('details.produk')
            ->where('status_pesanan', 'selesai')
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        $pesananBatal = Pesanan::with('details.produk')
            ->where('status_pesanan', 'dibatalkan')
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('admin.pesananselesai', compact('pesananSelesai', 'pesananBatal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'tanggal_pesanan' => 'required|date',
            'jenis_pengambilan' => 'required|string',
            'alamat' => 'required|string',
            'no_whatsapp' => 'required|string|max:20',
            'produk' => 'required|array|min:1',
            'produk.*.id' => 'required|exists:produks,id',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // Simpan pesanan
            $pesanan = Pesanan::create([
                'nama_pelanggan'   => $request->nama_pelanggan,
                'tanggal_pesanan'  => $request->tanggal_pesanan,
                'jenis_pengambilan' => $request->jenis_pengambilan,
                'alamat'           => $request->alamat,
                'no_whatsapp'      => $request->no_whatsapp,
                'total_harga'      => 0,
            ]);

            $totalHarga = 0;

            // Simpan detail produk
            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id']);
                $jumlah = $item['jumlah'];
                $harga = $produk->harga_kg * $jumlah;

                // cek stok
                $stok = $produk->stok;
                if (!$stok || $stok->stok_kg < $jumlah) {
                    return redirect()
                        ->back()
                        ->with('error', "Stok {$produk->nama_produk} tidak mencukupi")
                        ->withInput(); // biar input tetap terisi
                }


                // simpan detail pesanan
                $pesanan->details()->create([
                    'produk_id' => $produk->id,
                    'nama_produk'      => $produk->nama_produk,
                    'harga_produk' => $produk->harga_kg,
                    'jumlah_kg' => $jumlah,
                    'harga'     => $harga,
                ]);

                // kurangi stok
                $stok->decrement('stok_kg', $jumlah);

                // cek lagi setelah dikurangi
                if ($stok->stok_kg <= 0) {
                    $stok->status = false;
                    $stok->save();
                }


                $totalHarga += $harga;
            }

            // update total harga
            $pesanan->update(['total_harga' => $totalHarga]);
        });

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::with('details.produk.stok')->findOrFail($id);

        $status = $request->input('status');
        $alasan = $request->input('alasan');

        // Validasi sederhana
        if (!$status || !in_array($status, ['diproses', 'selesai', 'dibatalkan'])) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 422);
        }

        if ($status === 'dibatalkan' && !$alasan) {
            return response()->json(['success' => false, 'message' => 'Alasan harus diisi'], 422);
        }

        // Kalau dibatalkan → kembalikan stok produk
        if ($status === 'dibatalkan' && $pesanan->status_pesanan !== 'dibatalkan') {
            foreach ($pesanan->details as $detail) {
                if ($detail->produk && $detail->produk->stok) {
                    $detail->produk->stok->increment('stok_kg', $detail->jumlah_kg);
                }
            }
        }

        // Update status dan alasan
        $pesanan->status_pesanan = $status;
        $pesanan->alasan_dibatalkan = $status === 'dibatalkan' ? $alasan : null;
        $pesanan->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
