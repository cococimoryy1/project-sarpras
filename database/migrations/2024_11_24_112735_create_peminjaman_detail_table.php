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
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id('peminjaman_detail_id');  // Primary key
            $table->unsignedBigInteger('peminjaman_id');  // Foreign key ke tabel peminjaman
            $table->unsignedBigInteger('barang_id');  // Foreign key ke tabel barangs
            $table->integer('jumlah_barang');  // Jumlah barang yang dipinjam
            $table->timestamps();  // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('peminjaman_id')->references('peminjaman_id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('barang_id')->references('barang_id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_detail');
    }
};
