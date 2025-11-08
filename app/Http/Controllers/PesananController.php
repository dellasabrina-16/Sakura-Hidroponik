<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Carbon\Carbon;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_pengambilan' => 'required|string',
            'alamat' => 'required_if:jenis_pengambilan,diantar|string|nullable',
            'no_whatsapp' => 'required|string|max:20',
            'produk' => 'required|array|min:1',
            'produk.*.id' => 'required|exists:produks,id',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);

        // Cek stok dulu
        foreach ($request->produk as $item) {
            $produk = Produk::findOrFail($item['id']);
            if ($produk->stok->stok_kg < $item['jumlah']) {
                return back()
                    ->withErrors(['stok' => "Stok {$produk->nama_produk} tidak mencukupi"])
                    ->withInput()
                    ->with('modal', 'tambah-pesanan');
            }
        }

        DB::transaction(function () use ($request) {
            // Gunakan waktu realtime WIB
            $tanggalWIB = Carbon::now('Asia/Jakarta');

            $pesanan = Pesanan::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal_pesanan' => $tanggalWIB,
                'jenis_pengambilan' => $request->jenis_pengambilan,
                'alamat' => $request->jenis_pengambilan === 'diantar' ? $request->alamat : '-',
                'no_whatsapp' => $request->no_whatsapp,
                'total_harga' => 0,
                'status_pesanan' => 'diproses',
            ]);

            $totalHarga = 0;
            $detailPesananText = "";

            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id']);
                $jumlah = $item['jumlah'];
                $harga = $produk->harga_kg * $jumlah;

                $pesanan->details()->create([
                    'produk_id' => $produk->id,
                    'nama_produk' => $produk->nama_produk,
                    'harga_produk' => $produk->harga_kg,
                    'jumlah_kg' => $jumlah,
                    'harga' => $harga,
                ]);

                $produk->stok->decrement('stok_kg', $jumlah);

                if ($produk->stok->stok_kg <= 0) {
                    $produk->stok->update(['status' => false]);
                }

                $totalHarga += $harga;

                $detailPesananText .= "- {$produk->nama_produk} x {$jumlah} kg @ Rp" . number_format($produk->harga_kg, 0, ',', '.') . " = Rp" . number_format($harga, 0, ',', '.') . "\n";
            }

            $pesanan->update(['total_harga' => $totalHarga]);

            // Format waktu WIB untuk pesan WA
            $tanggalFormatted = $tanggalWIB->translatedFormat('d F Y, H:i') . " WIB";

            $pesan = "*Sakura Hidroponik*\n\n" .
                "Halo {$pesanan->nama_pelanggan},\n" .
                "Pesanan kamu telah kami terima ✅\n\n" .
                "📅 Tanggal Pesanan: {$tanggalFormatted}\n" .
                "🏠 Jenis Pengambilan: {$pesanan->jenis_pengambilan}\n" .
                ($pesanan->jenis_pengambilan === 'diantar' ? "📍 Alamat: {$pesanan->alamat}\n" : "") .
                "\n*Rincian Pesanan:*\n" .
                $detailPesananText .
                "\n*Total Harga: Rp" . number_format($totalHarga, 0, ',', '.') . "*\n\n" .
                "Terima kasih telah berbelanja di Sakura Hidroponik 💚";

            $this->sendWa($pesanan->no_whatsapp, $pesan);
        });

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Update status pesanan (selesai / dibatalkan)
     */
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::with('details.produk.stok')->findOrFail($id);

        $status = $request->input('status');
        $alasan = $request->input('alasan');

        if (!$status || !in_array($status, ['diproses', 'selesai', 'dibatalkan'])) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 422);
        }

        if ($status === 'dibatalkan' && !$alasan) {
            return response()->json(['success' => false, 'message' => 'Alasan harus diisi'], 422);
        }

        // Jika dibatalkan → kembalikan stok
        if ($status === 'dibatalkan' && $pesanan->status_pesanan !== 'dibatalkan') {
            foreach ($pesanan->details as $detail) {
                if ($detail->produk && $detail->produk->stok) {
                    $detail->produk->stok->increment('stok_kg', $detail->jumlah_kg);
                }
            }
        }

        $pesanan->status_pesanan = $status;
        $pesanan->alasan_dibatalkan = $status === 'dibatalkan' ? $alasan : null;
        $pesanan->alasan_dibatalkan = $status === 'dibatalkan' ? $alasan : null;
        $pesanan->save();

        $tanggalFormatted = Carbon::parse($pesanan->created_at)
            ->translatedFormat('d F Y, H:i') . " WIB";


        $pesan = "*Sakura Hidroponik*\n\n" .
            "Halo {$pesanan->nama_pelanggan},\n" .
            "Status pesanan kamu telah diperbarui 📨\n\n" .
            "Status sekarang: *" . strtoupper($status) . "*\n\n" .
            "*Rincian Pesanan:*\n";

        foreach ($pesanan->details as $detail) {
            $pesan .= "- {$detail->nama_produk} x {$detail->jumlah_kg} kg @ Rp" . number_format($detail->harga_produk, 0, ',', '.') . " = Rp" . number_format($detail->harga, 0, ',', '.') . "\n";
        }

        $pesan .= "\n*Total Harga: Rp" . number_format($pesanan->total_harga, 0, ',', '.') . "*\n" .
            "📅 Tanggal Pesanan: {$tanggalFormatted}\n" .
            "🏠 Jenis Pengambilan: {$pesanan->jenis_pengambilan}\n" .
            ($pesanan->jenis_pengambilan === 'diantar' ? "📍 Alamat: {$pesanan->alamat}\n" : "");

        if ($status === 'dibatalkan') {
            $pesan .= "\nAlasan pembatalan: {$alasan}\n";
        }

        $pesan .= "\nTerima kasih telah berbelanja di Sakura Hidroponik 💚";

        $this->sendWa($pesanan->no_whatsapp, $pesan);

        return response()->json(['success' => true]);
    }

    // Fungsi kirim WhatsApp
    private function sendWa($no_hp, $pesan)
    {
        $client = new Client();
        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/sendBulkMessage';

        try {
            $response = $client->post($url, [
                'form_params' => [
                    'apiKey'  => '3d36e250d0b4d2fca5cada2d66c0c408',
                    'phone'   => json_encode([$no_hp]),
                    'message' => $pesan,
                    'delay'   => 1
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('Gagal kirim WA: ' . $e->getMessage());
            return false;
        }
    }
}
