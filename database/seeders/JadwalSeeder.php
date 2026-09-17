<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $lapangans = Lapangan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        $jam = [
            ['08:00:00', '09:00:00'],
            ['09:00:00', '10:00:00'],
            ['10:00:00', '11:00:00'],
            ['11:00:00', '12:00:00'],
            ['13:00:00', '14:00:00'],
            ['14:00:00', '15:00:00'],
            ['15:00:00', '16:00:00'],
            ['16:00:00', '17:00:00'],
            ['19:00:00', '20:00:00'],
            ['20:00:00', '21:00:00'],
        ];

        /*
         * Buat jadwal untuk 60 hari ke depan
         * mulai dari hari ini.
         */
        for ($day = 0; $day < 60; $day++) {

            $tanggal = Carbon::today()
                ->addDays($day)
                ->format('Y-m-d');

            foreach ($lapangans as $lapangan) {

                foreach ($jam as $slot) {

                    /*
                     * Cari jadwal berdasarkan:
                     * - lapangan
                     * - tanggal
                     * - jam mulai
                     */
                    $jadwal = Jadwal::firstOrNew([
                        'lapangan_id' => $lapangan->id,
                        'tanggal' => $tanggal,
                        'jam_mulai' => $slot[0],
                    ]);

                    /*
                     * Pastikan jam selesai benar.
                     */
                    $jadwal->jam_selesai = $slot[1];

                    /*
                     * Jadwal baru dibuat tersedia.
                     * Jadwal lama tidak diubah statusnya.
                     */
                    if (!$jadwal->exists) {
                        $jadwal->status = 'tersedia';
                    }

                    $jadwal->save();
                }
            }
        }
    }
}