<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan.
     */
    public function index(Request $request)
    {
        $query = Reservasi::with([
            'user',
            'lapangan',
            'jadwal',
            'addOns',
            'pembayaran',
        ])->latest();

        // Filter berdasarkan tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter berdasarkan tanggal selesai
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_selesai
            );
        }

        // Filter berdasarkan status reservasi
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Ambil data reservasi
        $reservasis = $query->get();

        // Hitung total pendapatan dari reservasi
        // yang sudah dikonfirmasi atau selesai
        $totalPendapatan = $reservasis
            ->whereIn('status', [
                'dikonfirmasi',
                'selesai',
            ])
            ->sum('total_harga');

        // Hitung total jumlah reservasi
        $totalReservasi = $reservasis->count();

        return view(
            'admin.laporan.index',
            compact(
                'reservasis',
                'totalPendapatan',
                'totalReservasi'
            )
        );
    }

    /**
     * Menghasilkan laporan PDF.
     */
    public function pdf(Request $request)
    {
        $query = Reservasi::with([
            'user',
            'lapangan',
            'jadwal',
            'addOns',
            'pembayaran',
        ])->latest();

        // Filter berdasarkan tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter berdasarkan tanggal selesai
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_selesai
            );
        }

        // Filter berdasarkan status reservasi
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Ambil data reservasi
        $reservasis = $query->get();

        // Hitung total pendapatan untuk PDF
        $totalPendapatan = $reservasis
            ->whereIn('status', [
                'dikonfirmasi',
                'selesai',
            ])
            ->sum('total_harga');

        // Hitung total jumlah reservasi untuk PDF
        $totalReservasi = $reservasis->count();

        // Buat file PDF
        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            compact(
                'reservasis',
                'totalPendapatan',
                'totalReservasi'
            )
        );

        // Atur ukuran kertas
        $pdf->setPaper(
            'a4',
            'landscape'
        );

        // Download PDF
        return $pdf->download(
            'laporan-reservasi-' .
            now()->format('Y-m-d') .
            '.pdf'
        );
    }
}