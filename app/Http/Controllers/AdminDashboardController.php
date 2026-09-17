<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use App\Models\Lapangan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalReservasi = Reservasi::count();
        $totalLapangan = Lapangan::count();
        $totalPending = Reservasi::whereIn('status', [
            'menunggu_pembayaran',
            'menunggu_verifikasi',
        ])->count();

        // Pendapatan dihitung dari reservasi yang sudah dikonfirmasi.
        $totalPendapatan = (float) Reservasi::where('status', 'dikonfirmasi')
            ->sum('total_harga');

        $stats = [
            'total_reservasi' => $totalReservasi,
            'menunggu_verifikasi' => Reservasi::where('status', 'menunggu_verifikasi')->count(),
            'dikonfirmasi' => Reservasi::where('status', 'dikonfirmasi')->count(),
            'total_pembayaran' => Pembayaran::count(),
            'pembayaran_menunggu' => Pembayaran::where('status', 'menunggu')->count(),
            'total_lapangan' => $totalLapangan,
        ];

        $reservasiTerbaru = Reservasi::with([
            'user',
            'lapangan',
            'jadwal',
        ])
        ->latest()
        ->take(5)
        ->get();

        // Variabel eksplisit ini dipakai dashboard/layout baru.
        $reservasis = $reservasiTerbaru;

        return view('admin.dashboard', compact(
            'stats',
            'reservasiTerbaru',
            'reservasis',
            'totalReservasi',
            'totalPendapatan',
            'totalLapangan',
            'totalPending'
        ));
    }
}
