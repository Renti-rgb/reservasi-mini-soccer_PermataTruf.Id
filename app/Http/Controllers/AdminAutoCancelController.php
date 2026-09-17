<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminAutoCancelController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::with([
            'user',
            'lapangan',
            'jadwal',
            'pembayaran',
        ])
        ->where('status', 'menunggu_pembayaran')
        ->latest();

        $reservasis = $query->get();

        $sekarang = now();

        $dataMonitor = $reservasis->map(function ($reservasi) use ($sekarang) {

            $batasPembayaran = $reservasi->created_at->copy()->addMinutes(30);

            $selisihDetik = $sekarang->diffInSeconds(
                $batasPembayaran,
                false
            );

            if ($selisihDetik <= 0) {
                $monitorStatus = 'Segera Auto-Cancel';
                $statusClass = 'danger';
            } elseif ($selisihDetik <= 10 * 60) {
                $monitorStatus = 'Segera Auto-Cancel';
                $statusClass = 'warning';
            } else {
                $monitorStatus = 'Menunggu Pembayaran';
                $statusClass = 'waiting';
            }

            $menit = intdiv(max($selisihDetik, 0), 60);
            $detik = max($selisihDetik, 0) % 60;

            $reservasi->batas_pembayaran = $batasPembayaran;
            $reservasi->sisa_waktu = sprintf(
                '%02d:%02d',
                $menit,
                $detik
            );
            $reservasi->monitor_status = $monitorStatus;
            $reservasi->status_class = $statusClass;

            return $reservasi;
        });

        $jumlahMenunggu = $dataMonitor->where(
            'monitor_status',
            'Menunggu Pembayaran'
        )->count();

        $jumlahSegera = $dataMonitor->where(
            'monitor_status',
            'Segera Auto-Cancel'
        )->count();

        return view(
            'admin.auto-cancel.index',
            compact(
                'dataMonitor',
                'jumlahMenunggu',
                'jumlahSegera'
            )
        );
    }
}