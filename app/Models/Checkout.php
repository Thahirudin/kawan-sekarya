<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkout'; // Nama tabel yang digunakan

    protected $fillable = [
        'pelanggan_id',
        'event_id',
        'status',
        'snap_token',
        'total',
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;  // Agar tidak dianggap sebagai auto-increment
    protected $keyType = 'string'; // Menggunakan string (UUID)
    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected static function booted()
    {
        static::creating(function ($checkout) {
            if (!$checkout->id) {
                $checkout->id = 'EVENT-' . Str::uuid();  // Menggunakan UUID dengan prefix 'EVENT-'
            }
        });
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
