<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // Primary key (menu_id)
            $table->string('nama_menu', 100); // Nama menu
            $table->text('deskripsi_menu')->nullable(); // Deskripsi menu
            $table->string('link')->nullable(); // Link menu (opsional, bisa null)
            $table->unsignedBigInteger('parent_id')->nullable(); // Parent menu untuk hierarki
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade'); // Relasi ke tabel menus
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
