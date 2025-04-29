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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama acara
            $table->text('slug')->unique(); // slug acara
            $table->dateTime('tanggal_mulai'); // Tanggal & waktu mulai
            $table->dateTime('tanggal_selesai'); // Tanggal & waktu selesai
            $table->integer('kapasitas'); // Kapasitas peserta
            $table->unsignedBigInteger('pegawai_id'); // ID Pegawai (Foreign Key)
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->decimal('harga', 10, 2); // Harga acara (misalnya dalam IDR)
            $table->string('lokasi'); // Lokasi acara
            $table->text('deskripsi'); // Deskripsi acara
            $table->text('deskripsi_singkat'); // Deskripsi acara
            $table->string('gambar')->nullable(); // Path gambar acara (nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
