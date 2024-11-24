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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id('pengembalian_id');  // Primary key
            $table->unsignedBigInteger('peminjaman_id');  // Foreign key ke tabel peminjaman
            $table->date('tanggal_kembali');  // Tanggal pengembalian
            $table->enum('status_pengembalian', ['belum dikembalikan', 'dikembalikan'])->default('belum dikembalikan');  // Status pengembalian
            $table->decimal('denda', 10, 2)->default(0);  // Denda yang dikenakan jika ada keterlambatan
            $table->timestamps();  // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('peminjaman_id')->references('peminjaman_id')->on('peminjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
