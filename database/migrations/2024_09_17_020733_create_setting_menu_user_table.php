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
        Schema::create('setting_menu_user', function (Blueprint $table) {
            $table->id('no_setting');
            $table->unsignedBigInteger('id_jenis_user');
            $table->unsignedBigInteger('id_menu');
            $table->string('CREATE_BY', 30); // Siapa yang membuat setting ini
            $table->timestamp('CREATE_DATE')->useCurrent(); // Waktu setting dibuat
            $table->string('UPDATE_BY', 30)->nullable(); // Siapa yang terakhir update
            $table->timestamp('UPDATE_DATE')->nullable(); // Waktu terakhir update
            $table->timestamps();

            // Menambahkan foreign key untuk id_jenis_user yang merujuk ke id di jenis_user
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_users')->onDelete('cascade');
            // Menambahkan foreign key untuk id_menu yang merujuk ke id di jenis_user
            $table->foreign('id_menu')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_menu_user');
    }
};
