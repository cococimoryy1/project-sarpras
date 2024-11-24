<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('barang_id'); // Primary key
            $table->string('nama_barang', 100); // Nama barang
            $table->text('deskripsi_barang')->nullable(); // Deskripsi barang (opsional)
            $table->unsignedBigInteger('kategori_barang_id'); // Foreign key
            $table->integer('jumlah_total'); // Jumlah total barang
            $table->enum('status', ['tersedia', 'dipinjam', 'sedang_diperbaiki'])->default('tersedia'); // Status barang
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key
            $table->foreign('kategori_barang_id')
                ->references('id_kategori')->on('kategori')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
