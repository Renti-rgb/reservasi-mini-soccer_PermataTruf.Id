<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'harga_per_jam',
        'status',
        'jenis',
        'ukuran',
        'ketersediaan',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}