<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with([
            'user',
            'lapangan',
            'jadwal'
        ])
        ->latest()
        ->get();

        return view(
            'admin.reservasi.index',
            compact('reservasi')
        );
    }

    public function updateStatus(
        Request $request,
        Reservasi $reservasi
    ) {
        $request->validate([
            'status' => [
                'required',
                'in:menunggu_verifikasi,dikonfirmasi'
            ],
        ]);

        $reservasi->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.reservasi.index')
            ->with(
                'success',
                'Status reservasi berhasil diperbarui.'
            );
    }
}