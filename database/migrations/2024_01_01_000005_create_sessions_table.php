<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi
            $table->foreignId('user_id')->nullable()->constrained('users', 'iduser')->onDelete('cascade'); // Relasi ke tabel users
            $table->string('ip_address', 45)->nullable(); // IP Address
            $table->text('user_agent')->nullable(); // User Agent
            $table->longText('payload'); // Data sesi
            $table->integer('last_activity')->index(); // Timestamp terakhir aktivitas sesi
            $table->timestamps(); // Waktu sesi dibuat dan diperbarui
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
