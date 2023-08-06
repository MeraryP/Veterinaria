<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dosis');
            $table->enum('unidad', ['mililitros', 'miligramos']);
            $table->enum('unidad_desparasitante', ['ml', 'mg', 'tabletas', 'cucharaditas']);
            $table->date('fecha_aplicada');
            $table->boolean('aplicada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicados');
    }
};
