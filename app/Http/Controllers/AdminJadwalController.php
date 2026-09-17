<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    /**
     * Menampilkan semua jadwal.
     */
    public function index()
    {
        $jadwals = Jadwal::with('lapangan')
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        $lapangans = Lapangan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('admin.jadwal.index', compact(
            'jadwals',
            'lapangans'
        ));
    }

    /**
     * Menampilkan form tambah jadwal.
     */
    public function create()
    {
        $lapangans = Lapangan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('admin.jadwal.create', compact('lapangans'));
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'status' => ['required', 'in:tersedia,terisi'],
        ]);

        Jadwal::create([
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail jadwal.
     */
    public function show(Jadwal $jadwal)
    {
        $jadwal->load('lapangan');

        return view('admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function edit(Jadwal $jadwal)
    {
        $lapangans = Lapangan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('admin.jadwal.edit', compact(
            'jadwal',
            'lapangans'
        ));
    }

    /**
     * Memperbarui jadwal.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'status' => ['required', 'in:tersedia,terisi'],
        ]);

        $jadwal->update([
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}