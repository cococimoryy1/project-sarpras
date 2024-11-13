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
        Schema::create('message_dokumen', function (Blueprint $table) {
            $table->id('no_mdok');
            $table->string('file', 200)->nullable();
            $table->string('description', 150)->nullable();
            $table->unsignedBigInteger('id_message');
            $table->string('create_by', 30)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
            $table->timestamps();

            // Menambahkan foreign key untuk id_jenis_user yang merujuk ke id di jenis_user
            $table->foreign('id_message')->references('id')->on('message')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_dokumen');
    }
};
