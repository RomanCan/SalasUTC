<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesporgrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentesporgrupo', function (Blueprint $table) {
            $table->id('ClaveCarga');
            $table->string('ClaveAsig');
            $table->string('cedula');
            $table->string('ClaveGrupo');
            $table->string('Periodo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentesporgrupo');
    }
}
