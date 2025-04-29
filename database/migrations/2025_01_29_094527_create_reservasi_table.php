<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->unsignedBigInteger('pelanggan_id'); // Foreign key ke tabel pelanggans
            $table->unsignedBigInteger('meja_id'); // Foreign key ke tabel mejas
            $table->unsignedBigInteger('aktivitas_id')->nullable(); // Foreign key ke tabel aktivitas (opsional)
            $table->dateTime('waktu_kedatangan'); // Tanggal & waktu kedatangan
            $table->dateTime('waktu_selesai'); // Tanggal & waktu selesai
            $table->integer('total'); // Total harga reservasi
            $table->integer('jumlah_orang'); // jumlah orang
            $table->integer('dp');
            $table->text('snap_token')->nullable();
            $table->enum('status', ['pending', 'booking', 'pending-paid', 'paid', 'cancelled', 'failed'])->default('pending');
            $table->timestamps();

            // Tambahkan foreign key
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('meja_id')->references('id')->on('mejas')->onDelete('cascade');
            $table->foreign('aktivitas_id')->references('id')->on('aktivitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
