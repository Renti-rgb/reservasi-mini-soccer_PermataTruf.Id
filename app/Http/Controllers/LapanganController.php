<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lapangan::where('status', 'aktif');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('jenis', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('ketersediaan')) {
            $query->where('ketersediaan', $request->ketersediaan);
        }

        $lapangans = $query->orderBy('nama')
            ->paginate(6)
            ->withQueryString();

        $jenisLapangan = Lapangan::where('status', 'aktif')
            ->whereNotNull('jenis')
            ->distinct()
            ->orderBy('jenis')
            ->pluck('jenis');

        return view('lapangan.index', compact(
            'lapangans',
            'jenisLapangan'
        ));
    }

    public function show($slug)
    {
        $lapangan = Lapangan::where('slug', $slug)
            ->where('status', 'aktif')
            ->firstOrFail();

        return view('lapangan.show', compact('lapangan'));
    }
}