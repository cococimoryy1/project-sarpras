<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('manajemen_pengembalian', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('pengembalian_id');
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->foreign('pengembalian_id')->references('pengembalian_id')->on('pengembalian')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_pengembalian');
    }
};
