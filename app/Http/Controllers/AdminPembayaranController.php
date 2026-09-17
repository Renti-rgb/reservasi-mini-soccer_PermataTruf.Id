<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with([
            'reservasi.user',
            'reservasi.lapangan',
            'reservasi.jadwal',
        ])
            ->latest()
            ->get();

        return view(
            'admin.pembayaran.index',
            compact('pembayarans')
        );
    }

    /**
     * Menampilkan detail pembayaran.
     */
    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load([
            'reservasi.user',
            'reservasi.lapangan',
            'reservasi.jadwal',
        ]);

        return view(
            'admin.pembayaran.show',
            compact('pembayaran')
        );
    }

    /**
     * Menerima / memverifikasi pembayaran.
     *
     * Admin dapat langsung mengonfirmasi pembayaran
     * melalui tombol Konfirmasi tanpa harus mengunggah
     * bukti pembayaran terlebih dahulu.
     */
    public function terima(Pembayaran $pembayaran)
    {
        // Update status pembayaran
        $pembayaran->update([
            'status' => 'diverifikasi',
            'catatan' => null,
        ]);

        // Update status reservasi terkait
        $pembayaran->reservasi->update([
            'status' => 'dikonfirmasi',
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Pembayaran berhasil diverifikasi dan reservasi telah dikonfirmasi.'
            );
    }

    /**
     * Menolak pembayaran.
     */
    public function tolak(Request $request, Pembayaran $pembayaran)
    {
        // Validasi catatan penolakan
        $request->validate([
            'catatan' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        // Update status pembayaran
        $pembayaran->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        // Kembalikan reservasi ke status menunggu pembayaran
        $pembayaran->reservasi->update([
            'status' => 'menunggu_pembayaran',
        ]);

        return redirect()
            ->route('admin.pembayaran.show', $pembayaran->id)
            ->with(
                'success',
                'Pembayaran berhasil ditolak.'
            );
    }
}