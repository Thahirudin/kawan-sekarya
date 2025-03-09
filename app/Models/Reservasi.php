<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi'; // Nama tabel yang digunakan

    protected $fillable = [
        'pelanggan_id',
        'meja_id',
        'aktivitas_id',
        'waktu_kedatangan',
        'waktu_selesai',
        'jumlah_orang',
        'total',
        'dp',
        'snap_token',
        'status',
    ];

    protected $casts = [
        'waktu_kedatangan' => 'datetime',
        'waktu_selesai' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }
    
}
