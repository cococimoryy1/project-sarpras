<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_mk', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis dengan tipe data unsigned bigint
            $table->string('kode_mk', 20)->unique(); // Kolom kode_mk dengan tipe string, unique
            $table->string('nama_mk', 255); // Kolom nama_mk dengan tipe string
            $table->integer('sks'); // Kolom sks dengan tipe integer
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_mk');
    }
}
