<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        // Ambil semua kategori dengan hitung jumlah produknya
        $kategoris = Kategori::withCount('produk')->latest()->get();
        
        // Tampilkan halaman daftar kategori
        return view('kategori.index', compact('kategoris'));
    }

    // Form tambah kategori baru
    public function create()
    {
        // Tampilkan form tambah kategori
        return view('kategori.create');
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

        // Redirect ke daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Tampilkan detail kategori
    public function show(Kategori $kategori)
    {
        // Ambil produk yang terkait dengan kategori
        $kategori->load('produk');
        
        // Tampilkan halaman detail
        return view('kategori.show', compact('kategori'));
    }

    // Form edit kategori
    public function edit(Kategori $kategori)
    {
        // Tampilkan form edit dengan data kategori
        return view('kategori.edit', compact('kategori'));
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

        // Redirect ke daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil diupdate!');
    }

    // Hapus kategori
    public function destroy(Kategori $kategori)
    {
        // Hapus kategori dari database
        $kategori->delete();

        // Redirect ke daftar kategori dengan pesan sukses
        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}