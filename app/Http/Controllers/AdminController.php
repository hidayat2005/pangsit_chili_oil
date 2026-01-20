<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // app/Http/Controllers/AdminController.php
public function __construct()
{
    $this->middleware('auth');
}

public function dashboard()
{
    $totalProduk = \App\Models\Produk::count();
    $totalKategori = \App\Models\Kategori::count();
    return view('admin.dashboard', compact('totalProduk', 'totalKategori'));
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'username' => 'required|unique:admins|min:3',
            'email' => 'required|email|unique:admins',
            'password'=>'required|min:6',
            'nomor_telepon' => 'required',
            'role' => 'required|in:admin,kasir',
            'status' => 'required|in:aktif,nonaktif',
        ]);


        //simpan database
        Admin::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);

        //redirect
        return redirect()->route('admin.index')
        ->with('success', 'Admin/Kasir berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //validasi
        $request->validate([
           'nama_lengkap' => 'required|min:3',
           'username' => 'required|unique:admins,username,' .$admin->id,
           'email' => 'required|email|unique:admins,email,' .$admin->id,
           'nomor_telepon' => 'required',
           'role' => 'required|in:admin,kasir',
           'status' => 'required|in:aktif,nonaktif',
        ]);

        //update data
        $admin->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);

        //kalau password baru
        if ($request->password) {
            //update password
            $admin->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('admin.index')
        ->with('success', 'Admin/Kasir berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')
        ->with('success', 'Admin/Kasir berhasil dihapus');
    }
}
