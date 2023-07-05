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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion');
            $table->string('especie');
            $table->string('raza');
            $table->string('color');
            $table->string('genero');
            $table->string('edad_dias');
            $table->string('edad_meses');
            $table->string('edad_anio');
            $table->string('peso');
            $table->string('talla');
            $table->string('aptitud');
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
        Schema::dropIfExists('pacientes');
    }
};
