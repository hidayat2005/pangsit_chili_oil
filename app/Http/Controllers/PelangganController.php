<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PelangganController extends Controller
{
    public function index()
    {
        // Hanya tampilkan pelanggan yang memiliki user dengan role 'customer'
        $pelanggans = Pelanggan::whereHas('user', function($query) {
            $query->where('role', 'customer');
        })->with('user')->latest()->paginate(10);
        
        // Hitung statistik khusus untuk customer
        $totalPelanggan = Pelanggan::whereHas('user', function($query) {
            $query->where('role', 'customer');
        })->count();

        $pelangganAktif = $totalPelanggan; // Karena whereHas sudah menjamin adanya user
        $totalPesanan = \App\Models\Pesanan::count();

        return view('admin.pelanggan.index', compact('pelanggans', 'totalPelanggan', 'pelangganAktif', 'totalPesanan'));
    }

    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load(['user', 'pesanan']);
        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}