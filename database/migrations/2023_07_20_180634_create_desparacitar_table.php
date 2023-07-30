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
    public function up(){
        Schema::create('desparacitars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('antiparacitario');
            $table->string('dosis');
            $table->string('fecha_desparacitacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('desparacitars');
    }
};
