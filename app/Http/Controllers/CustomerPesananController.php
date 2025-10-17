<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class CustomerPesananController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('customer.konfirmasi', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong'], 422);
        }

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenis_pengambilan' => 'required|string',
            'alamat' => 'required|string',
        ]);

        try {
            $pesanan = null;

            DB::transaction(function () use ($request, $keranjang, &$pesanan) {
                $pesanan = Pesanan::create([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'tanggal_pesanan' => now(),
                    'jenis_pengambilan' => $request->jenis_pengambilan,
                    'alamat' => $request->alamat,
                    'no_whatsapp' => $request->no_whatsapp,
                    'total_harga' => 0,
                ]);

                $totalHarga = 0;

                foreach ($keranjang as $id => $item) {
                    $produk = Produk::findOrFail($id);

                    if ($produk->stok->stok_kg < $item['jumlah']) {
                        throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi");
                    }

                    $harga = $produk->harga_kg * $item['jumlah'];

                    $pesanan->details()->create([
                        'produk_id' => $produk->id,
                        'nama_produk' => $produk->nama_produk,
                        'harga_produk' => $produk->harga_kg,
                        'jumlah_kg' => $item['jumlah'],
                        'harga' => $harga,
                    ]);

                    $produk->stok->decrement('stok_kg', $item['jumlah']);

                    if ($produk->stok->stok_kg <= 0) {
                        $produk->stok->update(['status' => false]);
                    }

                    $totalHarga += $harga;
                }

                $pesanan->update(['total_harga' => $totalHarga]);
                session()->forget('keranjang');

                // ✅ Kirim pesan WhatsApp ke pelanggan setelah pesanan dibuat
                $pesan = "*Sakura Hidroponik*\n\n" .
                    "Halo {$pesanan->nama_pelanggan},\n" .
                    "Pesanan kamu telah kami terima ✅\n\n" .
                    "Tanggal: {$pesanan->tanggal_pesanan}\n" .
                    "Total Harga: Rp" . number_format($pesanan->total_harga, 0, ',', '.') . "\n\n" .
                    "Kami akan segera memproses pesananmu 🙏";

                $this->sendWa($pesanan->no_whatsapp, $pesan);
            });

            return response()->json(['success' => true, 'redirect' => route('landingpage')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function sendWa($no_hp, $pesan)
    {
        $client = new Client();
        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/sendBulkMessage';

        try {
            $response = $client->post($url, [
                'form_params' => [
                    'apiKey' => '3d36e250d0b4d2fca5cada2d66c0c408', // ganti jika token berubah
                    'phone' => json_encode([$no_hp]),
                    'message' => $pesan,
                    'delay' => 1
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('Gagal kirim WA: ' . $e->getMessage());
            return false;
        }
    }
}
