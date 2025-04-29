<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas'; // Nama tabel yang digunakan

    protected $fillable = [
        'nama',
        'durasi',
        'harga',
        'detail',
        'gambar',
    ];

    protected $casts = [
        'durasi' => 'integer',
        'harga' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
