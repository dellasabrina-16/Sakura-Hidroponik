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
        $pesanans = Pesanan::with('details.produk')->latest()->get();
        $produks = Produk::with('stok')->get();

        return view('admin/pesananmasuk', compact('pesanans', 'produks'));
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
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi");
                }

                // simpan detail pesanan
                $pesanan->details()->create([
                    'produk_id' => $produk->id,
                    'jumlah_kg' => $jumlah,
                    'harga'     => $harga,
                ]);

                // kurangi stok
                $stok->decrement('stok_kg', $jumlah);

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
        $pesanan = Pesanan::findOrFail($id);

        $status = $request->input('status');
        $alasan = $request->input('alasan');

        // Validasi sederhana
        if(!$status || !in_array($status, ['diproses','selesai','dibatalkan'])){
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 422);
        }

        if($status === 'dibatalkan' && !$alasan){
            return response()->json(['success' => false, 'message' => 'Alasan harus diisi'], 422);
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
