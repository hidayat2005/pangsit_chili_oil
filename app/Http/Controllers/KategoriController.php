<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        // Ambil semua kategori dengan hitung jumlah produknya
        $kategoris = Kategori::withCount('produk')->latest()->get();
        
        // Hitung statistik
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();
        
        // Hitung kategori terpopuler (paling banyak produk)
        $kategoriTerpopuler = Kategori::withCount('produk')
            ->orderBy('produk_count', 'desc')
            ->first();
        
        $produkTerbanyak = $kategoriTerpopuler ? $kategoriTerpopuler->produk_count : 0;
        
        // Hitung rata-rata produk per kategori
        $rataRataProduk = $totalKategori > 0 ? $totalProduk / $totalKategori : 0;
        
        return view('admin.kategori.index', compact(
            'kategoris',
            'totalKategori',
            'totalProduk',
            'kategoriTerpopuler',
            'produkTerbanyak',
            'rataRataProduk'
        ));
    }

    // Form tambah kategori baru
    public function create()
    {
        // Tampilkan form tambah kategori
        return view('admin.kategori.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan ke database
        Kategori::create($request->all());

        // PERBAIKI SUDAH: route('admin.kategori.index')
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Tampilkan detail kategori
    public function show(Kategori $kategori)
    {
        // Ambil produk yang terkait dengan kategori
        $kategori->load('produk');
        
        // Tampilkan halaman detail
        return view('admin.kategori.show', compact('kategori'));
    }

    // Form edit kategori
    public function edit(Kategori $kategori)
    {
        // Tampilkan form edit dengan data kategori
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Update data di database
        $kategori->update($request->all());

        // PERBAIKI INI: route('kategori.index') → route('admin.kategori.index')
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil diupdate!');
    }

    // Hapus kategori
    public function destroy(Kategori $kategori)
    {
        // Hapus kategori dari database
        $kategori->delete();

        // PERBAIKI INI: route('kategori.index') → route('admin.kategori.index')
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}