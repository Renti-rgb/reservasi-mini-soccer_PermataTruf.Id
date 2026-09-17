<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminHargaController extends Controller
{
    /**
     * Menampilkan daftar harga semua lapangan.
     */
    public function index()
    {
        $lapangans = Lapangan::orderBy('nama')->get();

        return view('admin.harga.index', compact('lapangans'));
    }

    /**
     * Menampilkan form untuk mengubah harga lapangan.
     */
    public function edit(Lapangan $lapangan)
    {
        return view('admin.harga.edit', compact('lapangan'));
    }

    /**
     * Menyimpan perubahan harga lapangan.
     */
    public function update(Request $request, Lapangan $lapangan)
    {
        $request->validate([
            'harga_per_jam' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
        ]);

        $lapangan->update([
            'harga_per_jam' => $request->harga_per_jam,
        ]);

        return redirect()
            ->route('admin.harga.index')
            ->with('success', 'Harga lapangan berhasil diperbarui.');
    }
}