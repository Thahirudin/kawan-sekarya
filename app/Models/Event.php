<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // Nama tabel yang digunakan

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'kapasitas',
        'pegawai_id',
        'harga',
        'lokasi',
        'slug',
        'deskripsi',
        'deskripsi_singkat',
        'gambar',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'harga' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
}
