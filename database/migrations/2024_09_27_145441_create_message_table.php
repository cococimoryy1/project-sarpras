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
        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->string('sender', 30)->nullable();
            $table->string('subject', 300)->nullable();
            $table->string('message_reference', 30)->nullable();
            $table->text('message_text');
            $table->string('messege_status', 30)->nullable();
            $table->unsignedBigInteger('no_mk')->nullable();
            $table->string('create_by', 30)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->string('update_by', 30)->nullable();

            // Menambahkan foreign key untuk id_jenis_user yang merujuk ke id di jenis_user
            $table->foreign('no_mk')->references('no_mk')->on('message_kategori')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
