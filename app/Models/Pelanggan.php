<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Pelanggan extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelanggans'; // Nama tabel yang digunakan

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'email',
        'password',
        'gambar',
        'nohp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}

