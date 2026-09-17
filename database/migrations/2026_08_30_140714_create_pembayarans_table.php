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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // Menghubungkan pembayaran dengan reservasi
            $table->foreignId('reservasi_id')
                ->constrained('reservasis')
                ->onDelete('cascade');

            // Kode transaksi pembayaran
            $table->string('kode_pembayaran')->unique();

            // Jumlah yang harus dibayar
            $table->decimal('jumlah', 12, 2);

            // Metode pembayaran
            $table->enum('metode', [
                'transfer_bank',
                'qris',
            ]);

            // Bukti pembayaran yang di-upload
            $table->string('bukti_pembayaran')->nullable();

            // Status pembayaran
            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'ditolak',
            ])->default('menunggu');

            // Catatan dari admin
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};