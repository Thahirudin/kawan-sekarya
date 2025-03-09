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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama aktivitas
            $table->integer('durasi'); // Durasi dalam menit
            $table->decimal('harga', 10, 2); // Harga aktivitas dalam format decimal
            $table->text('detail'); // Detail atau deskripsi aktivitas
            $table->string('gambar')->nullable(); // Path gambar aktivitas (nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
