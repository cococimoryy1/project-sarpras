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
        Schema::create('jenis_users', function (Blueprint $table) {
            $table->id('id_jenis_user');
            $table->string('jenis_user');
            $table->string('create_by')->nullable();
            $table->timestamp('create_date')->useCurrent();
            $table->string('update_by')->nullable();
            $table->timestamp('update_date')->useCurrent();
            $table->timestamps();

        });
        DB::table('jenis_users')->insert([
            ['id_jenis_user' => 1, 'jenis_user' => 'admin', 'CREATE_BY' => 'system'],
            ['id_jenis_user' => 2, 'jenis_user' => 'mahasiswa', 'CREATE_BY' => 'system'],
            ['id_jenis_user' => 3, 'jenis_user' => 'dosen', 'CREATE_BY' => 'system'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_users');
    }
};
