<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use Illuminate\Http\Request;

class AdminAddOnController extends Controller
{
    /**
     * Menampilkan daftar semua add-on.
     */
    public function index()
    {
        $addOns = AddOn::orderBy('nama')->get();

        return view('admin.addon.index', compact('addOns'));
    }

    /**
     * Menampilkan form tambah add-on.
     */
    public function create()
    {
        return view('admin.addon.create');
    }

    /**
     * Menyimpan add-on baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'harga' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'status' => [
                'required',
                'in:aktif,nonaktif',
            ],
        ]);

        AddOn::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.addon.index')
            ->with('success', 'Add-on berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail add-on.
     */
    public function show(AddOn $addOn)
    {
        return view('admin.addon.show', compact('addOn'));
    }

    /**
     * Menampilkan form edit add-on.
     */
    public function edit(AddOn $addOn)
    {
        return view('admin.addon.edit', compact('addOn'));
    }

    /**
     * Memperbarui add-on.
     */
    public function update(Request $request, AddOn $addOn)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'harga' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'status' => [
                'required',
                'in:aktif,nonaktif',
            ],
        ]);

        $addOn->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.addon.index')
            ->with('success', 'Add-on berhasil diperbarui.');
    }

    /**
     * Menghapus add-on.
     */
    public function destroy(AddOn $addOn)
    {
        $addOn->delete();

        return redirect()
            ->route('admin.addon.index')
            ->with('success', 'Add-on berhasil dihapus.');
    }
}