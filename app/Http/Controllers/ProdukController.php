<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('admin.produk', compact('produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_kg' => 'required|integer|min:1',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Simpan foto apa adanya ke storage
        $path = $request->file('foto_produk')->store('produk', 'public');

        Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi_produk' => $validated['deskripsi_produk'],
            'harga_kg' => $validated['harga_kg'],
            'foto_produk' => $path,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
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
            // Hapus foto lama
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
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
