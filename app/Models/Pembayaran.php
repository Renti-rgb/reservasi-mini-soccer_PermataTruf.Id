<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservasi_id',
        'kode_pembayaran',
        'jumlah',
        'metode',
        'bukti_pembayaran',
        'status',
        'catatan',
    ];

    /**
     * Pembayaran milik satu Reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}