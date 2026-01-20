<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Gunakan model Produk (bukan Product)

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang
     */
    public function index()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);
        
        $cartItems = [];
        $total = 0;
        
        if (!empty($cart)) {
            // Ambil semua produk ID dari keranjang
            $productIds = array_keys($cart);
            
            // Ambil data produk dari database
            $products = Produk::whereIn('id', $productIds)->get()->keyBy('id');
            
            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                
                if ($product) {
                    $quantity = $item['quantity'];
                    $subtotal = $product->harga * $quantity;
                    $total += $subtotal;
                    
                    $cartItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal
                    ];
                } else {
                    // Jika produk tidak ditemukan di database, hapus dari keranjang
                    unset($cart[$productId]);
                    session()->put('cart', $cart);
                }
            }
        }
        
        return view('frontend.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:produk,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $productId = $request->product_id;
        $quantity = $request->quantity;
        
        // Cek stok produk
        $product = Produk::find($productId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan!'
            ], 404);
        }
        
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);
        
        // Cek apakah produk sudah ada di keranjang
        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            
            // Cek stok tersedia
            if ($newQuantity > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok
                ], 400);
            }
            
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            // Cek stok tersedia
            if ($quantity > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok
                ], 400);
            }
            
            // Tambah produk baru
            $cart[$productId] = [
                'quantity' => $quantity,
                'added_at' => now()
            ];
        }
        
        // Simpan ke session
        session()->put('cart', $cart);
        
        // Jika request AJAX
        if ($request->ajax()) {
            $count = array_sum(array_column($cart, 'quantity'));
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'count' => $count,
                'cart' => $cart
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah produk di keranjang
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            // Cek stok produk
            $product = Produk::find($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan!'
                ], 404);
            }
            
            // Cek stok tersedia
            if ($request->quantity > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok
                ], 400);
            }
            
            if ($request->quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $request->quantity;
            }
            
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui!'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang!'
        ], 404);
    }

    /**
     * Hapus produk dari keranjang
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang!'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang!'
        ], 404);
    }

    /**
     * Kosongkan keranjang
     */
    public function clear()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan!'
        ]);
    }

    /**
     * Get jumlah item di keranjang (untuk AJAX)
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        
        return response()->json(['count' => $count]);
    }

    /**
     * Get total harga keranjang (untuk AJAX)
     */
    public function total()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Produk::whereIn('id', $productIds)->get()->keyBy('id');
            
            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                if ($product) {
                    $total += $product->harga * $item['quantity'];
                }
            }
        }
        
        return response()->json(['total' => $total]);
    }
}