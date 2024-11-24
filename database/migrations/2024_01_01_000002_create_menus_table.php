<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->string('nama_menu');
            $table->text('deskripsi_menu')->nullable();
            $table->timestamps(); // for created_at and updated_at
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
