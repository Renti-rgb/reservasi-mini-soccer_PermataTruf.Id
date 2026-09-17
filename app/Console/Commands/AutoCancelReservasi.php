<?php

namespace App\Console\Commands;

use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoCancelReservasi extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:auto-cancel-reservasi';

    /**
     * The console command description.
     */
    protected $description = 'Membatalkan otomatis reservasi yang belum dibayar setelah 30 menit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $batasWaktu = now()->subMinutes(30);

        $reservasis = Reservasi::where(
            'status',
            'menunggu_pembayaran'
        )
        ->where(
            'created_at',
            '<=',
            $batasWaktu
        )
        ->get();

        $jumlahDibatalkan = 0;

        foreach ($reservasis as $reservasi) {
            DB::transaction(function () use ($reservasi, &$jumlahDibatalkan) {

                $reservasiTerkunci = Reservasi::lockForUpdate()
                    ->find($reservasi->id);

                if (!$reservasiTerkunci) {
                    return;
                }

                // Cek kembali status agar tidak membatalkan
                // reservasi yang sudah berubah status.
                if ($reservasiTerkunci->status !== 'menunggu_pembayaran') {
                    return;
                }

                $jadwal = Jadwal::lockForUpdate()
                    ->find($reservasiTerkunci->jadwal_id);

                // Batalkan reservasi
                $reservasiTerkunci->update([
                    'status' => 'dibatalkan',
                    'catatan' => 'Reservasi dibatalkan otomatis karena pembayaran tidak dilakukan dalam 30 menit.',
                ]);

                // Kembalikan jadwal menjadi tersedia
                if ($jadwal) {
                    $jadwal->update([
                        'status' => 'tersedia',
                    ]);
                }

                $jumlahDibatalkan++;
            });
        }

        $this->info(
            "Auto-cancel selesai. {$jumlahDibatalkan} reservasi dibatalkan."
        );

        return Command::SUCCESS;
    }
}