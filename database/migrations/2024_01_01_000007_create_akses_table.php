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
        Schema::create('akses', function (Blueprint $table) {
            $table->id('akses_id'); // Primary key
            $table->unsignedBigInteger('role_id'); // Foreign key ke tabel roles
            $table->unsignedBigInteger('menu_id'); // Foreign key ke tabel menus
            $table->enum('hak_akses', ['lihat', 'tambah', 'ubah', 'hapus']); // Hak akses
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraints
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses');
    }
};
