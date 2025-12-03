<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $produks = Produk::with('kategori')
                        ->latest()
                        ->paginate(10);
        
        return view('produk.index', compact('produks'));
    }

    // Form tambah produk
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',  // ✅ DIPERBAIKI
            'status' => 'required|in:tersedia,habis',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
        }

        // Simpan produk
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'gambar' => $path ?? null,
        ]);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // Tampilkan detail produk
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produk.show', compact('produk'));
    }

    // Form edit produk
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    // Update produk
    public function update(Request $request, Produk $produk)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',  // ✅ DIPERBAIKI
            'status' => 'required|in:tersedia,habis',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar) {
                Storage::delete('public/' . $produk->gambar);
            }
            
            // Upload gambar baru
            $path = $request->file('gambar')->store('produk', 'public');
            $data['gambar'] = $path;
        } else {
            // Gunakan gambar lama
            $data['gambar'] = $produk->gambar;
        }

        // Update produk
        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Produk $produk)
    {
        // Hapus gambar dari storage
        if ($produk->gambar) {
            Storage::delete('public/' . $produk->gambar);
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}