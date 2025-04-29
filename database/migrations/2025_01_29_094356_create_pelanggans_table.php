<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama pelanggan
            $table->date('tanggal_lahir'); // Tanggal lahir
            $table->string('email')->unique(); // Email (harus unik)
            $table->string('password'); // Password pelanggan
            $table->string('gambar')->nullable(); // Path gambar (nullable jika tidak ada gambar)
            $table->string('nohp', 15); // Nomor HP (maksimal 15 karakter)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
