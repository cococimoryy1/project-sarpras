<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->timestamps();
        });

     // Menambahkan data awal ke tabel menu_levels
     DB::table('menu_levels')->insert([
        ['level' => 'Level 1'],
        ['level' => 'Level 2'],
        ['level' => 'Level 3'],
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_levels');
    }
};
