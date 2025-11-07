<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class CustomerKeranjangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data keranjang dari session (default: array kosong)
        $keranjang = session()->get('keranjang', []);

        // Tambahkan stok dari tabel stoks (melalui relasi Produk)
        foreach ($keranjang as $id => $item) {
            $produk = \App\Models\Produk::find($id);

            if ($produk) {
                // Ambil stok dari tabel stoks berdasarkan produk_id
                $stok = \App\Models\Stok::where('produk_id', $produk->id)->first();

                $keranjang[$id]['stok'] = $stok ? (float) $stok->stok_kg : 0;
            } else {
                $keranjang[$id]['stok'] = 0;
            }
        }

        return view('customer.keranjang', compact('keranjang'));
    }


    public function add(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $harga = $request->harga;
        $gambar = $request->gambar;

        $keranjang = session()->get('keranjang', []);

        if (!isset($keranjang[$id])) {
            $keranjang[$id] = [
                'nama' => $nama,
                'harga' => $harga,
                'jumlah' => 1,
                'gambar' => $gambar
            ];
        }

        session()->put('keranjang', $keranjang);

        return response()->json(['success' => true, 'keranjang' => $keranjang]);
    }



    public function update(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        $id = $request->id;

        if (!isset($keranjang[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang'
            ]);
        }

        // Ambil stok dari tabel stok (model Stok)
        $stok = \App\Models\Stok::where('produk_id', $id)->first();
        $stokTersedia = $stok ? (float)$stok->stok_kg : 0;

        // Ambil jumlah saat ini di session
        $jumlahSekarang = $keranjang[$id]['jumlah'];

        // Logika update jumlah
        if ($request->type === 'plus') {
            if ($jumlahSekarang < $stokTersedia) {
                $keranjang[$id]['jumlah']++;
            } else {
                // Sudah mencapai batas stok
                session()->put('keranjang', $keranjang);
                return response()->json([
                    'success' => false,
                    'message' => 'stok_habis',
                    'stok' => $stokTersedia,
                    'qty' => $jumlahSekarang
                ]);
            }
        } elseif ($request->type === 'minus' && $jumlahSekarang > 1) {
            $keranjang[$id]['jumlah']--;
        }

        // Simpan ke session
        session()->put('keranjang', $keranjang);

        return response()->json([
            'success' => true,
            'qty' => $keranjang[$id]['jumlah']
        ]);
    }



    public function remove(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        $id = $request->id;

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return response()->json(['success' => true]);
    }
}
