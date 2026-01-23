<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengeluaran::query();

        // Filter by Date Range
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        
        $query->whereBetween('tanggal', [$startDate, $endDate]);

        // Filter by Category
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $pengeluarans = $query->latest('tanggal')->paginate(10);
        
        $totalPengeluaran = $query->sum('jumlah');
        $kategoris = ['Listrik', 'Gas', 'Iklan', 'Packing', 'Bahan Baku', 'Gaji', 'Lainnya'];

        return view('admin.pengeluaran.index', compact('pengeluarans', 'totalPengeluaran', 'kategoris', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = ['Listrik', 'Gas', 'Iklan', 'Packing', 'Bahan Baku', 'Gaji', 'Lainnya'];
        return view('admin.pengeluaran.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dicatat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        $kategoris = ['Listrik', 'Gas', 'Iklan', 'Packing', 'Bahan Baku', 'Gaji', 'Lainnya'];
        return view('admin.pengeluaran.edit', compact('pengeluaran', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $pengeluaran->update($request->all());

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran telah dihapus.');
    }
}
