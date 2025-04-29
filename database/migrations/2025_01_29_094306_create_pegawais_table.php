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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Kolom Nama
            $table->date('tanggal_lahir'); // Kolom Tanggal Lahir
            $table->string('nomor_hp', 15); // Kolom Nomor HP, dibatasi 15 karakter
            $table->string('email')->unique(); // Kolom Email (unik)
            $table->string('jabatan'); // Kolom Jabatan
            $table->string('password'); // Kolom Password
            $table->string('gambar')->nullable(); // Kolom Gambar, bisa kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
