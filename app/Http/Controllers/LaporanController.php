<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Tampilkan Laporan Penjualan
     */
    public function index(Request $request)
    {
        // Filter Tanggal (Default 30 hari terakhir)
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->subDays(30)->startOfDay();
        $endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();

        // Query Pesanan berdasarkan filter
        $query = Pesanan::with(['pelanggan'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pesanan', '!=', 'dibatalkan');

        $pesanans = $query->latest()->paginate(10);
        
        // Statistik Utama
        $totalPendapatan = $query->sum('total_harga');
        $jumlahPesanan = $query->count();
        $rataRataTransaksi = $jumlahPesanan > 0 ? $totalPendapatan / $jumlahPesanan : 0;
        
        // Pesanan Selesai vs Pending
        $pesananSelesai = Pesanan::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pesanan', 'selesai')
            ->count();
            
        // Pesanan Baru (Notifikasi)
        $notifikasiPesanans = Pesanan::with('pelanggan')
            ->where('admin_notified', false)
            ->where('status_pesanan', 'menunggu')
            ->latest()
            ->get();
            
        return view('admin.laporan.index', compact(
            'pesanans', 
            'totalPendapatan', 
            'jumlahPesanan', 
            'rataRataTransaksi',
            'pesananSelesai',
            'startDate',
            'endDate',
            'notifikasiPesanans'
        ));
    }

    /**
     * Utilitas untuk membuat data contoh (Dummy)
     */
    public function generateSampleData()
    {
        $produkIds = Produk::pluck('id')->toArray();
        $pelangganIds = Pelanggan::pluck('id')->toArray();

        if (empty($produkIds) || empty($pelangganIds)) {
            return redirect()->back()->with('error', 'Harus ada minimal 1 produk dan 1 pelanggan untuk membuat data contoh.');
        }

        DB::beginTransaction();
        try {
            // Buat 15 pesanan dalam 30 hari terakhir
            for ($i = 0; $i < 15; $i++) {
                $tanggal = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23));
                
                $pesanan = Pesanan::create([
                    'nomor_pesanan' => 'ORD-' . strtoupper(str_random(8)),
                    'pelanggan_id' => $pelangganIds[array_rand($pelangganIds)],
                    'total_harga' => 0,
                    'status_pesanan' => ['selesai', 'diproses', 'dikonfirmasi'][rand(0, 2)],
                    'catatan' => 'Pesanan contoh otomatis',
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal
                ]);

                $totalHarga = 0;
                $jumlahItem = rand(1, 4);
                
                for ($j = 0; $j < $jumlahItem; $j++) {
                    $produk = Produk::find($produkIds[array_rand($produkIds)]);
                    $jumlah = rand(1, 3);
                    $subtotal = $produk->harga * $jumlah;
                    
                    ItemPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'produk_id' => $produk->id,
                        'jumlah' => $jumlah,
                        'harga_saat_ini' => $produk->harga,
                        'created_at' => $tanggal,
                        'updated_at' => $tanggal
                    ]);
                    
                    $totalHarga += $subtotal;
                }

                $pesanan->update(['total_harga' => $totalHarga]);
            }

            DB::commit();
            return redirect()->route('admin.laporan.index')->with('success', '15 Data pesanan contoh berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat data contoh: ' . $e->getMessage());
        }
    }

    /**
     * Update Status Pesanan
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dikonfirmasi,diproses,selesai,dibatalkan'
        ]);

        try {
            $pesanan->update([
                'status_pesanan' => $request->status,
                'customer_notified' => false // Reset agar pelanggan dapat notif pembaruan status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan #' . $pesanan->nomor_pesanan . ' berhasil diupdate menjadi ' . strtoupper($request->status)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cek apakah ada pesanan baru yang belum dinotifikasi ke admin
     */
    public function checkNewOrders()
    {
        $newOrdersCount = Pesanan::where('admin_notified', false)
            ->where('status_pesanan', 'menunggu')
            ->count();

        return response()->json([
            'count' => $newOrdersCount
        ]);
    }

    /**
     * Tandai pesanan sebagai sudah dinotifikasi
     */
    public function markAsNotified()
    {
        Pesanan::where('admin_notified', false)
            ->where('status_pesanan', 'menunggu')
            ->update(['admin_notified' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Ambil rincian item pesanan untuk modal detail
     */
    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['items.produk', 'pelanggan']);
        
        return response()->json([
            'success' => true,
            'data' => [
                'nomor_pesanan' => $pesanan->nomor_pesanan,
                'tanggal' => $pesanan->created_at->format('d M Y H:i'),
                'pelanggan' => $pesanan->pelanggan->nama_pelanggan ?? 'Walk-in Customer',
                'total' => number_format($pesanan->total_harga, 0, ',', '.'),
                'status' => $pesanan->status_pesanan,
                'items' => $pesanan->items->map(function($item) {
                    return [
                        'nama' => $item->produk->nama_produk,
                        'jumlah' => $item->jumlah,
                        'harga' => number_format($item->harga_saat_ini, 0, ',', '.'),
                        'subtotal' => number_format($item->jumlah * $item->harga_saat_ini, 0, ',', '.')
                    ];
                })
            ]
        ]);
    }
}
