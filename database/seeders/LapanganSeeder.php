<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    public function run(): void
    {
        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-a'],
            [
                'nama' => 'Lapangan A - Premium',
                'jenis' => 'Sintetis',
                'ukuran' => 'Standar',
                'gambar' => 'lapangan-a.png',
                'deskripsi' => 'Lapangan mini soccer premium dengan rumput sintetis kualitas terbaik, cocok untuk latihan maupun pertandingan.',
                'harga_per_jam' => 200000,
                'status' => 'aktif',
                'ketersediaan' => 'terbatas',
            ]
        );

        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-b'],
            [
                'nama' => 'Lapangan B - Standard',
                'jenis' => 'Rumput Asli',
                'ukuran' => 'Mini',
                'gambar' => 'lapangan-b.jpeg',
                'deskripsi' => 'Lapangan mini soccer standard dengan fasilitas nyaman, cocok untuk latihan maupun pertandingan.',
                'harga_per_jam' => 150000,
                'status' => 'aktif',
                'ketersediaan' => 'tersedia',
            ]
        );

        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-c'],
            [
                'nama' => 'Lapangan C - Indoor',
                'jenis' => 'Sintetis',
                'ukuran' => 'Standar',
                'gambar' => 'lapangan-c.jpeg',
                'deskripsi' => 'Lapangan mini soccer indoor dengan fasilitas lengkap, cocok untuk pertandingan dan turnamen.',
                'harga_per_jam' => 250000,
                'status' => 'aktif',
                'ketersediaan' => 'tersedia',
            ]
        );

        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-d'],
            [
                'nama' => 'Lapangan D - VIP',
                'jenis' => 'Sintetis',
                'ukuran' => 'Standar',
                'gambar' => 'lapangan-d.jpeg',
                'deskripsi' => 'Lapangan VIP dengan fasilitas eksklusif dan area parkir luas.',
                'harga_per_jam' => 300000,
                'status' => 'aktif',
                'ketersediaan' => 'terbatas',
            ]
        );

        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-e'],
            [
                'nama' => 'Lapangan E - Regular',
                'jenis' => 'Rumput Asli',
                'ukuran' => 'Mini',
                'gambar' => 'lapangan-e.jpeg',
                'deskripsi' => 'Lapangan reguler dengan harga terjangkau, cocok untuk latihan rutin.',
                'harga_per_jam' => 120000,
                'status' => 'aktif',
                'ketersediaan' => 'tersedia',
            ]
        );

        Lapangan::updateOrCreate(
            ['slug' => 'lapangan-f'],
            [
                'nama' => 'Lapangan F - Premium Plus',
                'jenis' => 'Sintetis',
                'ukuran' => 'Besar',
                'gambar' => 'lapangan-f.jpeg',
                'deskripsi' => 'Lapangan ukuran besar dengan fasilitas premium plus, cocok untuk turnamen.',
                'harga_per_jam' => 280000,
                'status' => 'aktif',
                'ketersediaan' => 'terbatas',
            ]
        );
    }
}