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

        if (isset($keranjang[$id])) {
            if ($request->type === 'plus') {
                $keranjang[$id]['jumlah']++;
            } elseif ($request->type === 'minus' && $keranjang[$id]['jumlah'] > 1) {
                $keranjang[$id]['jumlah']--;
            }

            // simpan kembali ke session
            session()->put('keranjang', $keranjang);

            // ambil jumlah terbaru
            $qty = $keranjang[$id]['jumlah'];

            return response()->json([
                'success' => true,
                'qty' => $qty
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
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
