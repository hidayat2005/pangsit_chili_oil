<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $quantity = (int)($request->quantity ?? 1);
        $setMode = $request->input('mode') === 'set';
        
        // Cek stok produk
        $product = Produk::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan!'], 404);
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $newQuantity = $setMode ? $quantity : ($cart[$productId]['quantity'] + $quantity);
            
            if ($newQuantity > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi! Tersedia: ' . $product->stok
                ], 400);
            }
            
            $cart[$productId]['quantity'] = max(1, $newQuantity);
        } else {
            if ($quantity > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi! Tersedia: ' . $product->stok
                ], 400);
            }
            
            $cart[$productId] = [
                'quantity' => max(1, $quantity),
                'added_at' => now()
            ];
        }
        
        session()->put('cart', $cart);
        
        if ($request->ajax()) {
            $count = array_sum(array_column($cart, 'quantity'));
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'count' => $count
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
            'quantity' => 'nullable|integer|min:0',
            'action' => 'nullable|string|in:increase,decrease'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $product = Produk::find($id);
            if (!$product) {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan!'], 404);
                }
                return redirect()->back()->with('error', 'Produk tidak ditemukan!');
            }
            
            $currentQuantity = $cart[$id]['quantity'];
            
            // Prioritaskan nilai quantity yang dikirim langsung (idempotent)
            if ($request->has('quantity') && !is_null($request->quantity)) {
                $newQuantity = (int)$request->quantity;
            } else {
                $newQuantity = $currentQuantity;
                // Handle increase/decrease buttons jika quantity tidak dikirim
                if ($request->action == 'increase') {
                    $newQuantity = $currentQuantity + 1;
                } elseif ($request->action == 'decrease') {
                    $newQuantity = max(1, $currentQuantity - 1);
                }
            }
            
            // Cek stok tersedia
            if ($newQuantity > $product->stok) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok
                    ], 400);
                }
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }
            
            if ($newQuantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $newQuantity;
            }
            
            session()->put('cart', $cart);
            
            if ($request->ajax()) {
                // Calculate all data for AJAX response
                $itemSubtotal = $cart[$id]['quantity'] * $product->harga;
                $cartSubtotal = 0;
                $productIds = array_keys($cart);
                $allProducts = Produk::whereIn('id', $productIds)->get()->keyBy('id');
                
                $waMessage = "Halo Pangsit Chili Oil! Saya ingin memesan:\n\n";
                foreach ($cart as $pId => $item) {
                    $p = $allProducts->get($pId);
                    if ($p) {
                        $sTotal = $p->harga * $item['quantity'];
                        $cartSubtotal += $sTotal;
                        $waMessage .= "- " . $p->nama_produk . " (x" . $item['quantity'] . ") = Rp " . number_format($sTotal, 0, ',', '.') . "\n";
                    }
                }
                $waMessage .= "\nSubtotal: Rp " . number_format($cartSubtotal, 0, ',', '.') . "\n";
                $waMessage .= "Biaya Layanan: Rp 2.000\n";
                $waMessage .= "Total: Rp " . number_format($cartSubtotal + 2000, 0, ',', '.') . "\n\n";
                $customerInfo = "";
                if (auth()->check()) {
                    $pelanggan = auth()->user()->pelanggan;
                    if ($pelanggan) {
                        $customerInfo = "\n--- Detail Pemesan ---\n";
                        $customerInfo .= "Nama: " . $pelanggan->nama_pelanggan . "\n";
                        $customerInfo .= "HP: " . ($pelanggan->nomor_telepon ?? '-') . "\n";
                        $customerInfo .= "Alamat: " . ($pelanggan->alamat ?? '-') . "\n";
                    }
                }

                $waMessage .= $customerInfo . "\nMohon segera diproses ya, terima kasih!";
                
                $waUrl = "https://wa.me/" . config('services.whatsapp.number') . "?text=" . urlencode($waMessage);
                $cartCount = array_sum(array_column($cart, 'quantity'));

                return response()->json([
                    'success' => true,
                    'message' => 'Jumlah produk di keranjang berhasil diperbarui!',
                    'new_quantity' => $cart[$id]['quantity'],
                    'item_subtotal' => 'Rp ' . number_format($itemSubtotal, 0, ',', '.'),
                    'cart_subtotal' => 'Rp ' . number_format($cartSubtotal, 0, ',', '.'),
                    'cart_total' => 'Rp ' . number_format($cartSubtotal + 2000, 0, ',', '.'),
                    'wa_url' => $waUrl,
                    'cart_count' => $cartCount
                ]);
            }
            
            return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui!');
        }
        
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang!'
            ], 404);
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang!');
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
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus dari keranjang!'
                ]);
            }
            return redirect()->back()->with('success', 'Produk berhasil dihapus!');
        }
        
        if (request()->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang!'
            ], 404);
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan!');
    }

    /**
     * Kosongkan keranjang
     */
    public function clear()
    {
        session()->forget('cart');
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan!'
            ]);
        }
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }

    /**
     * Proses Checkout: Simpan ke Database, Kurangi Stok, dan Kosongkan Keranjang
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Pastikan User sudah Login dan punya data Pelanggan
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan.');
        }

        $user = auth()->user();
        $pelanggan = $user->pelanggan;

        if (!$pelanggan) {
            return redirect()->route('customer.profile')->with('error', 'Lengkapi data profil (nomor telepon & alamat) Anda terlebih dahulu.');
        }

        DB::beginTransaction();
        try {
            // 1. Hitung Total Harga & Validasi Stok Terakhir
            $totalHarga = 0;
            $productIds = array_keys($cart);
            $products = Produk::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');
            
            foreach ($cart as $id => $item) {
                $product = $products->get($id);
                if (!$product || $product->stok < $item['quantity']) {
                    throw new \Exception("Stok produk '" . ($product->nama_produk ?? 'Unknown') . "' tidak mencukupi.");
                }
                $totalHarga += $product->harga * $item['quantity'];
            }

            // 2. Buat Rekam Data Pesanan
            $pesanan = Pesanan::create([
                'nomor_pesanan' => 'ORD-' . strtoupper(Str::random(8)),
                'pelanggan_id' => $pelanggan->id,
                'total_harga' => $totalHarga + 2000, // Termasuk Biaya Layanan
                'status_pesanan' => 'menunggu',
                'catatan' => 'Dipesan via WhatsApp',
                'whatsapp_terkirim' => true,
                'whatsapp_terkirim_pada' => now()
            ]);

            // 3. Simpan Item Pesanan & Kurangi Stok
            foreach ($cart as $id => $item) {
                $product = $products->get($id);
                
                ItemPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $product->id,
                    'jumlah' => $item['quantity'],
                    'harga_saat_ini' => $product->harga
                ]);

                // Kurangi Stok
                $product->decrement('stok', $item['quantity']);
                
                // Update status habis jika stok 0
                if ($product->fresh()->stok <= 0) {
                    $product->update(['status' => 'habis']);
                }
            }

            DB::commit();
            
            // Kosongkan Keranjang
            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Pesanan berhasil dicatat! Silakan lanjutkan konfirmasi melalui WhatsApp.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
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