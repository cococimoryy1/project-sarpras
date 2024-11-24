<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetersediaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketersediaan_barang', function (Blueprint $table) {
            $table->id('ketersediaan_id');  // Primary key
            $table->unsignedBigInteger('barang_id');  // Foreign key ke tabel barangs
            $table->enum('status_tersedia', ['tersedia', 'terpinjam', 'dalam perbaikan'])->default('tersedia');  // Status ketersediaan barang
            $table->integer('jumlah_tersedia')->default(0);  // Jumlah barang berdasarkan status
            $table->date('tanggal_terakhir_update');  // Tanggal terakhir update ketersediaan
            $table->timestamps();  // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('barang_id')->references('barang_id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ketersediaan_barang');
    }
}
