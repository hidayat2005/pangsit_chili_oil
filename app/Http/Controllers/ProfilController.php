<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil customer (read-only view)
     */
    public function show()
    {
        $pelanggan = Pelanggan::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama_pelanggan' => Auth::user()->name,
                'email' => Auth::user()->email,
                'nomor_telepon' => '',
                'alamat' => ''
            ]
        );
        
        return view('frontend.customer.profile', compact('pelanggan'));
    }
    
    /**
     * Tampilkan form edit profil
     */
    public function edit()
    {
        // Ambil atau buat data pelanggan untuk user yang login
        $pelanggan = Pelanggan::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama_pelanggan' => Auth::user()->name,
                'email' => Auth::user()->email,
                'nomor_telepon' => '',
                'alamat' => ''
            ]
        );
        
        return view('profil.edit', compact('pelanggan'));
    }

    /**
     * Update profil pelanggan
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);
        
        // Tambahkan data otomatis
        $validated['user_id'] = Auth::id();
        $validated['email'] = Auth::user()->email;
        
        // Update atau create data pelanggan
        Pelanggan::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );
        
        return redirect()->route('profil.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}