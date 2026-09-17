<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();

            // Kode unik untuk setiap reservasi
            $table->string('kode_reservasi')->unique();

            // Member yang melakukan reservasi
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Lapangan yang dipesan
            $table->foreignId('lapangan_id')
                ->constrained()
                ->onDelete('cascade');

            // Jadwal yang dipilih
            $table->foreignId('jadwal_id')
                ->constrained()
                ->onDelete('cascade');

            // Total harga reservasi
            $table->decimal('total_harga', 12, 2);

            // Status reservasi
            $table->enum('status', [
                'pending',
                'menunggu_pembayaran',
                'menunggu_verifikasi',
                'dikonfirmasi',
                'ditolak',
                'dibatalkan',
                'selesai',
            ])->default('pending');

            // Catatan tambahan dari member
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};