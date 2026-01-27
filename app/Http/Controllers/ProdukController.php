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
        
        $totalProduk = Produk::count();
    $produkTersedia = Produk::where('status', 'tersedia')->count();
    $produkHabis = Produk::where('status', 'habis')->count();
    $produkStokRendah = Produk::where('stok', '>', 0)
                              ->where('stok', '<=', 4)
                              ->count();
    
    return view('admin.produk.index', compact(
        'produks', 
        'totalProduk', 
        'produkTersedia', 
        'produkHabis', 
        'produkStokRendah'
    ));
    
    }

    // Form tambah produk
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    // Simpan produk baru DENGAN UPLOAD GAMBAR
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',  
            'status' => 'required|in:tersedia,habis',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        
        // 1. Buat nama file unik
        $fileName = 'produk_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // 2. Simpan ke storage (BUKAN public)
        $path = $file->storeAs('produk', $fileName, 'public');
        // Hasil: "produk/produk_123456789_abc123.jpg"
    }

        // Simpan produk ke database
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'gambar' => $path, // Simpan path gambar ke database
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // Tampilkan detail produk
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('admin.produk.show', compact('produk'));
    }

    // Form edit produk
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    // Update produk DENGAN UPLOAD GAMBAR BARU
    public function update(Request $request, Produk $produk)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',  
            'status' => 'required|in:tersedia,habis',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        // UPLOAD GAMBAR BARU JIKA ADA
        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            
            // 2. Upload gambar baru
            $file = $request->file('gambar');
            $fileName = 'produk_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('produk', $fileName, 'public');
            
            // 3. Simpan path baru ke data
            $data['gambar'] = $path;
        }

        // Update produk
        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk DENGAN MENGHAPUS GAMBAR
    public function destroy(Produk $produk)
    {
        // VALIDASI: Cek apakah produk sudah pernah dipesan
        if ($produk->itemPesanan()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Produk tidak dapat dihapus karena sudah ada dalam pesanan. Total pesanan: ' . $produk->itemPesanan()->count());
        }

        // Hapus gambar dari storage
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}