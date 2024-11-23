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
            $table->string('kategori_barang', 50)->nullable(); // Kategori barang
            $table->enum('status_barang', ['tersedia', 'terpinjam', 'dalam perbaikan'])->default('tersedia'); // Status barang
            $table->integer('jumlah_total'); // Jumlah total barang
            $table->integer('jumlah_tersedia'); // Jumlah barang tersedia
            $table->timestamps(); // Kolom created_at dan updated_at
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
