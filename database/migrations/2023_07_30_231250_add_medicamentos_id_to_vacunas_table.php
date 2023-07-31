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
        Schema::table('vacunas', function (Blueprint $table) {
            $table->unsignedInteger('med_id');
    
            $table->foreign('med_id')->references('id')->on('medicamentos')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacunas', function (Blueprint $table) {
            //
        });
    }
};