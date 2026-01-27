<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $admins = User::whereIn('role', ['admin', 'kasir'])->get();

        return view('admin.users.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'username' => 'required|unique:users|min:3',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:6',
            'nomor_telepon' => 'required',
            'role' => 'required|in:admin,kasir',
            'status' => 'required|in:aktif,nonaktif',
        ]);


        //simpan database
        User::create([
            'name' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // hashed in model cast
            'nomor_telepon' => $request->nomor_telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);

        //redirect
        return redirect()->route('admin.users.index')
        ->with('success', 'Admin/Kasir berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $admin = $user;
        return view('admin.users.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $admin = $user;
        return view('admin.users.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $admin = $user;
        //validasi
        $request->validate([
           'nama_lengkap' => 'required|min:3',
           'username' => 'required|unique:users,username,' .$admin->id,
           'email' => 'required|email|unique:users,email,' .$admin->id,
           'nomor_telepon' => 'required',
           'role' => 'required|in:admin,kasir',
           'status' => 'required|in:aktif,nonaktif',
        ]);

        //update data
        $admin->update([
            'name' => $request->nama_lengkap,
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
                'password' => $request->password // hashed in model cast
            ]);
        }

        return redirect()->route('admin.users.index')
        ->with('success', 'Admin/Kasir berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
        ->with('success', 'Admin/Kasir berhasil dihapus');
    }
}
