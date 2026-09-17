<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminLapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::latest()->get();

        return view('admin.lapangan.index', compact('lapangans'));
    }

    public function create()
    {
        return view('admin.lapangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'gambar' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'harga_per_jam' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'jenis' => [
                'required',
                'string',
                'max:100',
            ],

            'ukuran' => [
                'required',
                'string',
                'max:100',
            ],

            'ketersediaan' => [
                'required',
                Rule::in([
                    'tersedia',
                    'tidak_tersedia',
                ]),
            ],
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('lapangan', 'public');
        }

        // Membuat slug otomatis
        $slugDasar = Str::slug($request->nama);
        $slug = $slugDasar;
        $counter = 1;

        while (Lapangan::where('slug', $slug)->exists()) {
            $slug = $slugDasar . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        // Simpan ke database
        Lapangan::create($validated);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show(Lapangan $lapangan)
    {
        return view('admin.lapangan.show', compact('lapangan'));
    }

    public function edit(Lapangan $lapangan)
    {
        return view('admin.lapangan.edit', compact('lapangan'));
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'harga_per_jam' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'jenis' => [
                'required',
                'string',
                'max:100',
            ],

            'ukuran' => [
                'required',
                'string',
                'max:100',
            ],

            'ketersediaan' => [
                'required',
                Rule::in([
                    'tersedia',
                    'tidak_tersedia',
                ]),
            ],
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                !empty($lapangan->gambar) &&
                Storage::disk('public')->exists($lapangan->gambar)
            ) {
                Storage::disk('public')->delete($lapangan->gambar);
            }

            // Simpan gambar baru
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('lapangan', 'public');

        } else {

            // Pertahankan gambar lama
            unset($validated['gambar']);
        }

        // Membuat slug
        $slugDasar = Str::slug($request->nama);
        $slug = $slugDasar;
        $counter = 1;

        while (
            Lapangan::where('slug', $slug)
                ->where('id', '!=', $lapangan->id)
                ->exists()
        ) {
            $slug = $slugDasar . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        $lapangan->update($validated);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui.');
    }

    public function destroy(Lapangan $lapangan)
    {
        // Hapus gambar
        if (
            !empty($lapangan->gambar) &&
            Storage::disk('public')->exists($lapangan->gambar)
        ) {
            Storage::disk('public')->delete($lapangan->gambar);
        }

        // Hapus data
        $lapangan->delete();

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}