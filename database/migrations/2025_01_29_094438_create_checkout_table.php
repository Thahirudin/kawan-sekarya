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
        Schema::create('checkout', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->unsignedBigInteger('pelanggan_id'); // Foreign key ke tabel pelanggans
            $table->unsignedBigInteger('event_id'); // Foreign key ke tabel events
            $table->decimal('total', 10, 2); // Total pembayaran dalam format decimal
            $table->enum('status', ['pending', 'paid', 'cancelled', 'failed'])->default('pending');
            $table->text('snap_token')->nullable();
            $table->timestamps();

            // Tambahkan foreign key
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};
