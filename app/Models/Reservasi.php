<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_reservasi',
        'user_id',
        'lapangan_id',
        'jadwal_id',
        'total_harga',
        'status',
        'catatan',
    ];

    /**
     * Reservasi milik satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reservasi untuk satu Lapangan
     */
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    /**
     * Reservasi memiliki satu Jadwal
     */
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    /**
     * Reservasi dapat memiliki banyak Add-on
     */
    public function addOns()
{
    return $this->belongsToMany(AddOn::class, 'reservasi_add_on')
        ->withPivot('jumlah', 'harga')
        ->withTimestamps();
}

public function pembayaran()
{
    return $this->hasOne(Pembayaran::class);
}
}