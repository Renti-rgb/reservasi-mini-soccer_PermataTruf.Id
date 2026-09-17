<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih jadwal.
     */
    public function pilihJadwal(Lapangan $lapangan)
    {
        // Pastikan lapangan masih aktif
        if ($lapangan->status !== 'aktif') {
            abort(404);
        }

        // Ambil tanggal yang dipilih
        $tanggal = request(
            'tanggal',
            now()->toDateString()
        );

        // Ambil jadwal lapangan berdasarkan tanggal
        $jadwals = Jadwal::where(
            'lapangan_id',
            $lapangan->id
        )
            ->where('tanggal', $tanggal)
            ->orderBy('jam_mulai')
            ->get();

        return view(
            'reservasi.pilih-jadwal',
            compact(
                'lapangan',
                'jadwals',
                'tanggal'
            )
        );
    }


    /**
     * Menyimpan reservasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => [
                'required',
                'exists:jadwals,id'
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ]);

        $reservasi = DB::transaction(function () use ($request) {

            // Kunci jadwal agar tidak dipesan bersamaan
            $jadwal = Jadwal::lockForUpdate()
                ->findOrFail($request->jadwal_id);

            // Pastikan jadwal masih tersedia
            if ($jadwal->status !== 'tersedia') {
                abort(
                    422,
                    'Jadwal tersebut sudah tidak tersedia.'
                );
            }

            // Ambil lapangan
            $lapangan = Lapangan::findOrFail(
                $jadwal->lapangan_id
            );

            // Buat kode reservasi unik
            do {
                $kodeReservasi =
                    'RSV-' .
                    strtoupper(
                        Str::random(8)
                    );
            } while (
                Reservasi::where(
                    'kode_reservasi',
                    $kodeReservasi
                )->exists()
            );

            // Buat reservasi
            $reservasi = Reservasi::create([
                'kode_reservasi' => $kodeReservasi,
                'user_id' => Auth::id(),
                'lapangan_id' => $lapangan->id,
                'jadwal_id' => $jadwal->id,
                'total_harga' => $lapangan->harga_per_jam,
                'status' => 'menunggu_pembayaran',
                'catatan' => $request->catatan,
            ]);

            // Ubah status jadwal menjadi terisi
            $jadwal->update([
                'status' => 'terisi',
            ]);

            return $reservasi;
        });

        return redirect()
            ->route(
                'reservasi.detail',
                $reservasi->id
            )
            ->with(
                'success',
                'Reservasi berhasil dibuat. Silakan lanjutkan pembayaran.'
            );
    }


    /**
     * Menampilkan detail reservasi.
     */
    public function detail(Reservasi $reservasi)
    {
        // User hanya boleh melihat reservasinya sendiri
        if ($reservasi->user_id !== Auth::id()) {
            abort(403);
        }

        $reservasi->load([
            'lapangan',
            'jadwal',
            'pembayaran',
        ]);

        return view(
            'reservasi.detail',
            compact('reservasi')
        );
    }


    /**
     * Menampilkan semua reservasi milik user.
     */
    public function saya()
    {
        $reservasis = Reservasi::where(
            'user_id',
            Auth::id()
        )
            ->with([
                'lapangan',
                'jadwal',
                'pembayaran',
            ])
            ->latest()
            ->paginate(10);

        return view(
            'reservasi.saya',
            compact('reservasis')
        );
    }


    /**
     * Menampilkan riwayat reservasi.
     */
    public function riwayat()
    {
        $reservasis = Reservasi::with([
            'lapangan',
            'jadwal',
            'pembayaran'
        ])
            ->where(
                'user_id',
                Auth::id()
            )
            ->whereIn('status', [
                'selesai',
                'ditolak',
                'dibatalkan'
            ])
            ->latest()
            ->paginate(10);

        return view(
            'reservasi.riwayat',
            compact('reservasis')
        );
    }
}