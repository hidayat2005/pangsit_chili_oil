<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter, search, dan sort
     */
    public function products(Request $request)
    {
        // Query dasar - ambil produk yang tersedia dengan kategori
        $query = Produk::with('kategori')->where('status', 'tersedia');
        
        // SEARCH - Pencarian berdasarkan nama atau deskripsi
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_produk', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // FILTER - Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('kategori_id', $request->category);
        }
        
        // SORT - Urutkan produk
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'popular':
                // Untuk saat ini gunakan created_at, bisa ditambah field sales_count nanti
                $query->orderBy('created_at', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
        }
        
        // Pagination - 12 produk per halaman
        $products = $query->paginate(12)->appends($request->except('page'));
        
        // Ambil semua kategori untuk dropdown filter - hitung hanya produk tersedia
        $categories = Kategori::withCount(['produk' => function($query) {
            $query->where('status', 'tersedia');
        }])->get();
        
        return view('frontend.products.index', compact('products', 'categories'));
    }
    
    /**
     * Menampilkan detail produk
     */
    public function productShow($id)
    {
        // Ambil produk dengan relasi kategori
        $product = Produk::with('kategori')->findOrFail($id);
        
        // Ambil produk terkait (kategori sama, exclude produk ini)
        $relatedProducts = Produk::where('kategori_id', $product->kategori_id)
            ->where('id', '!=', $id)
            ->where('status', 'tersedia')
            ->take(4)
            ->get();
        
        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
    
    /**
     * Menampilkan produk berdasarkan kategori
     */
    public function productsByCategory($id, Request $request)
    {
        // Cari kategori
        $category = Kategori::findOrFail($id);
        
        // Query produk dalam kategori ini
        $query = Produk::with('kategori')
            ->where('kategori_id', $id)
            ->where('status', 'tersedia');
        
        // SEARCH - jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_produk', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // SORT
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'popular':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate(12)->appends($request->except('page'));
        $categories = Kategori::withCount(['produk' => function($query) {
            $query->where('status', 'tersedia');
        }])->get();
        
        return view('frontend.products.index', compact('products', 'categories', 'category'));
    }
}
