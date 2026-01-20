<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->latest()->paginate(10);
        
        // Hitung statistik
        $totalPelanggan = Pelanggan::count();
        $pelangganAktif = Pelanggan::whereHas('user')->count();
        $totalPesanan = \App\Models\Pesanan::count();

        return view('pelanggan.index', compact('pelanggans', 'totalPelanggan', 'pelangganAktif', 'totalPesanan'));
    }

    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load(['user', 'pesanan']);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}