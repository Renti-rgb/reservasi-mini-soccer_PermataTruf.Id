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
        Schema::create('reservasi_add_on', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke tabel reservasis
            $table->foreignId('reservasi_id')
                ->constrained('reservasis')
                ->onDelete('cascade');

            // Menghubungkan ke tabel add_ons
            $table->foreignId('add_on_id')
                ->constrained('add_ons')
                ->onDelete('cascade');

            // Jumlah add-on yang dipilih
            $table->unsignedInteger('jumlah')->default(1);

            // Harga add-on saat reservasi dibuat
            $table->decimal('harga', 12, 2);

            $table->timestamps();

            // Satu add-on hanya dicatat sekali untuk satu reservasi
            $table->unique(['reservasi_id', 'add_on_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_add_on');
    }
};