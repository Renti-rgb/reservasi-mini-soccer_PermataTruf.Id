<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddOn;

class AddOnSeeder extends Seeder
{
    public function run(): void
    {
        AddOn::updateOrCreate(
            ['nama' => 'Sewa Bola'],
            [
                'deskripsi' => 'Sewa bola standar untuk pertandingan.',
                'harga' => 15000,
                'status' => 'aktif',
            ]
        );

        AddOn::updateOrCreate(
            ['nama' => 'Sewa Rompi'],
            [
                'deskripsi' => 'Sewa 1 set rompi tim (10 buah).',
                'harga' => 20000,
                'status' => 'aktif',
            ]
        );

        AddOn::updateOrCreate(
            ['nama' => 'Wasit Pertandingan'],
            [
                'deskripsi' => 'Jasa wasit resmi selama pertandingan berlangsung.',
                'harga' => 50000,
                'status' => 'aktif',
            ]
        );
    }
}