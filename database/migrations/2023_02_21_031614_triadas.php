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
        Schema::create('triadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('frecuencia_respiratoria');
            $table->string('frecuencia_pulso');
            $table->string('femperatura_corporaral');
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
        Schema::dropIfExists('triadas'); 
    }
};
