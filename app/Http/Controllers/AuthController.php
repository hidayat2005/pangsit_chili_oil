<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        
        return view('frontend.auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            return $this->redirectBasedOnRole();
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        
        return view('frontend.auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer', 
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect dengan pesan sukses
        return redirect('/')->with([
            'success' => 'Registrasi berhasil! Selamat datang di Pangsit Chili Oil.'
        ]);
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with([
            'success' => 'Anda telah berhasil logout.'
        ]);
    }

    /**
     * Helper function untuk redirect berdasarkan role user
     */
    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.index')->with('success', 'Login berhasil! Selamat datang Administrator.');
                
            case 'kasir':
                return redirect()->route('admin.index')->with('success', 'Login berhasil! Selamat datang Kasir.');
                
            default: // user
                return redirect()->intended('/')->with('success', 'Login berhasil! Selamat datang kembali, ' . $user->name . '.');
        }
    }
}