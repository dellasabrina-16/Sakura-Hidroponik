<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->with('stok')->get(); // ikut relasi stok
        return view('admin.produk', compact('produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_kg' => 'required|integer|min:1',
            'stok_kg' => 'nullable|integer|min:0',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Simpan foto
        $path = $request->file('foto_produk')->store('produk', 'public');

        $produk = Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi_produk' => $validated['deskripsi_produk'],
            'harga_kg' => $validated['harga_kg'],
            'foto_produk' => $path,
        ]);

        // Simpan stok awal
        $stokAwal = $validated['stok_kg'] ?? 0;
        Stok::create([
            'produk_id' => $produk->id,
            'stok_kg' => $stokAwal,
            'status' => $stokAwal > 0, // aktif kalau stok > 0
        ]);

        return redirect()->back()->with('success', 'Produk dan stok berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_kg' => 'required|integer|min:1',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama_produk = $validated['nama_produk'];
        $produk->deskripsi_produk = $validated['deskripsi_produk'];
        $produk->harga_kg = $validated['harga_kg'];

        if ($request->hasFile('foto_produk')) {
            // hapus foto lama
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }

            $path = $request->file('foto_produk')->store('produk', 'public');
            $produk->foto_produk = $path;
        }

        $produk->save();

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $produk = Produk::with('stok', 'detailsPesanan')->findOrFail($id);

        // Cek apakah ada pesanan diproses yang masih menggunakan produk ini
        $pesananDiproses = $produk->detailsPesanan()
            ->whereHas('pesanan', function ($q) {
                $q->where('status_pesanan', 'diproses');
            })->exists();

        if ($pesananDiproses) {
            // Jika ada pesanan diproses, nonaktifkan stok saja
            if ($produk->stok) {
                $produk->stok->status = false;
                $produk->stok->save();
            }

            return redirect()->back()->with('warning', 'Produk tidak bisa dihapus karena masih ada pesanan diproses. Produk dinonaktifkan.');
        }

        // Jika tidak ada pesanan diproses → hapus produk dan fotonya
        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
