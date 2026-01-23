<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerNotificationController extends Controller
{
    /**
     * Cek pembaruan status pesanan untuk pelanggan yang sedang login atau via session
     */
    public function checkUpdates(Request $request)
    {
        // Jika pelanggan login
        if (Auth::check()) {
            $user = Auth::user();
            // Cari data pelanggan berdasarkan email user
            $pelanggan = Pelanggan::where('email', $user->email)->first();
            
            if (!$pelanggan) {
                return response()->json(['count' => 0, 'notifications' => []]);
            }

            $notifications = Pesanan::where('pelanggan_id', $pelanggan->id)
                ->where('customer_notified', false)
                ->latest()
                ->get();

            return response()->json([
                'count' => $notifications->count(),
                'notifications' => $notifications
            ]);
        }

        return response()->json(['count' => 0, 'notifications' => []]);
    }

    /**
     * Tandai notifikasi pelanggan sebagai terbaca
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array'
        ]);

        Pesanan::whereIn('id', $request->order_ids)->update([
            'customer_notified' => true
        ]);

        return response()->json(['success' => true]);
    }
}
