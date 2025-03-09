<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'mejas'; // Nama tabel yang digunakan

    protected $fillable = [
        'nama',
        'deskripsi',
        'kapasitas',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
