<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Lapangan;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->toDateString());

        $lapangans = Lapangan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        $jadwals = Jadwal::where('tanggal', $tanggal)
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('lapangan_id');

        return view('jadwal.index', compact(
            'tanggal',
            'lapangans',
            'jadwals'
        ));
    }
}