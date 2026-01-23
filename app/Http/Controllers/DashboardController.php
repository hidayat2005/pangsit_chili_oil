<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        // STATISTIK PELANGGAN
        $totalPelanggan = Pelanggan::count();
        $pelangganAktif = Pelanggan::whereHas('user')->count();
        
        // STATISTIK PRODUK
        $totalProduk = Produk::count();
        $produkTersedia = Produk::where('status', 'tersedia')->count();
        $produkStokRendah = Produk::where('stok', '>', 0)
                                 ->where('stok', '<=', 4)
                                 ->count();
        $produkHabis = Produk::where('stok', 0)->orWhere('status', 'habis')->count();
        
        // STATISTIK KATEGORI
        $totalKategori = Kategori::count();
        $totalProdukAll = Produk::count();
        $kategoriTerpopuler = Kategori::withCount('produk')
                                    ->orderBy('produk_count', 'desc')
                                    ->first();
        $produkTerbanyak = $kategoriTerpopuler ? $kategoriTerpopuler->produk_count : 0;
        $rataRataProduk = $totalKategori > 0 ? $totalProdukAll / $totalKategori : 0;
        
        // STATISTIK ADMIN/KASIR - DIPERBAIKI
        // Cek dulu apakah tabel users punya kolom 'status'
        $totalAdmin = User::where('role', 'admin')->count();
        $totalKasir = User::where('role', 'kasir')->count();
        
        // Jika tabel users punya kolom 'status', gunakan itu
        // Jika tidak, anggap semua user aktif
        $adminAktif = 0;
        $adminNonaktif = 0;
        
        // Cek apakah kolom 'status' ada di tabel users
        try {
            // Coba query kolom status
            $adminAktif = User::where('status', 'aktif')->count();
            $adminNonaktif = User::where('status', 'nonaktif')->count();
        } catch (\Exception $e) {
            // Jika kolom status tidak ada, anggap semua aktif
            $adminAktif = $totalAdmin + $totalKasir;
            $adminNonaktif = 0;
        }
        
        // STATISTIK PESANAN (jika ada model Pesanan)
        $totalPesanan = 0;
        $pesananSelesai = 0;
        $pesananPending = 0;
        
        try {
            if (class_exists(Pesanan::class)) {
                $totalPesanan = Pesanan::count();
                $pesananSelesai = Pesanan::where('status_pesanan', 'selesai')->count();
                $pesananPending = Pesanan::where('status_pesanan', 'menunggu')->count();
            }
        } catch (\Exception $e) {
            // Jika model Pesanan belum ada
        }
        
        // DATA TERBARU
        $produkTerbaru = Produk::with('kategori')
                             ->latest()
                             ->take(5)
                             ->get();
        
        $pelangganTerbaru = Pelanggan::with('user')
                                   ->latest()
                                   ->take(5)
                                   ->get();
        
        $kategoriTerbaru = Kategori::withCount('produk')
                                 ->latest()
                                 ->take(5)
                                 ->get();
        
        return view('admin.dashboard.index', compact(
            // Pelanggan
            'totalPelanggan', 'pelangganAktif',
            
            // Produk
            'totalProduk', 'produkTersedia', 'produkStokRendah', 'produkHabis',
            
            // Kategori
            'totalKategori', 'kategoriTerpopuler', 'produkTerbanyak', 'rataRataProduk',
            
            // Admin/Kasir
            'totalAdmin', 'totalKasir', 'adminAktif', 'adminNonaktif',
            
            // Pesanan
            'totalPesanan', 'pesananSelesai', 'pesananPending',
            
            // Data Terbaru
            'produkTerbaru', 'pelangganTerbaru', 'kategoriTerbaru'
        ));
    }
    
    /**
     * Customer Orders Page
     */
    public function orders()
    {
        $user = auth()->user();
        $pelanggan = Pelanggan::where('user_id', $user->id)->first();
        
        $orders = collect();
        if ($pelanggan) {
            $orders = Pesanan::where('pelanggan_id', $pelanggan->id)
                            ->latest()
                            ->get();
        }
        
        return view('frontend.customer.orders', compact('orders'));
    }

    /**
     * Detail Pesanan Pelanggan
     */
    public function orderDetail($id)
    {
        $user = auth()->user();
        $pelanggan = Pelanggan::where('user_id', $user->id)->first();
        
        if (!$pelanggan) {
            return redirect()->route('home')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $order = Pesanan::with(['items.produk'])
                        ->where('id', $id)
                        ->where('pelanggan_id', $pelanggan->id)
                        ->firstOrFail();
        
        return view('frontend.customer.order_detail', compact('order'));
    }

    /**
     * Hapus Pesanan (Pelanggan)
     */
    public function orderDestroy($id)
    {
        $user = auth()->user();
        $pelanggan = Pelanggan::where('user_id', $user->id)->first();
        
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $order = Pesanan::where('id', $id)
                        ->where('pelanggan_id', $pelanggan->id)
                        ->firstOrFail();

        // Hanya pesanan 'menunggu' atau 'dibatalkan' yang boleh dihapus
        if (!in_array(strtolower($order->status_pesanan), ['menunggu', 'dibatalkan'])) {
            return redirect()->back()->with('error', 'Pesanan yang sedang diproses, dikonfirmasi, atau sudah selesai tidak dapat dihapus.');
        }

        $order->delete();

        return redirect()->route('customer.orders')->with('success', 'Riwayat pesanan berhasil dihapus.');
    }
}