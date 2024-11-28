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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('peminjaman_id');  // Primary key
            $table->unsignedBigInteger('user_id');  // Foreign key ke tabel users
            $table->date('tanggal_pinjam');  // Tanggal peminjaman
            $table->date('tanggal_kembali')->nullable();  // Tanggal pengembalian (opsional)
            $table->enum('status_peminjaman', ['dipinjam', 'pending', 'selesai', 'dibatalkan', 'menunggu pengembalian'])->default('dipinjam');
            $table->integer('total_hari')->nullable();  // Total hari peminjaman (opsional)
            $table->timestamps();  // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('iduser')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
