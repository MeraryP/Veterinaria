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
        Schema::create('anamns', function (Blueprint $table) {
            $table->id();
            $table->string('tiempo_enfermedad');
            $table->string('manifestaciones');
            $table->string('funcion_organos');
            $table->string('causas_posibles');
            $table->string('enfermo_antes');
            $table->string('enfermos_multiples');
            $table->string('tratamiento');
            $table->string('vacuna');
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
        Schema::dropIfExists('anamns');
    }
};
