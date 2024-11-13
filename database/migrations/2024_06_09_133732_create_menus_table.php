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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menuLevels_id');
            $table->foreign('menuLevels_id')->references('id')->on('menu_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('menu_name');
            $table->string('menu_link');
            $table->string('menu_icon');
            // $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
