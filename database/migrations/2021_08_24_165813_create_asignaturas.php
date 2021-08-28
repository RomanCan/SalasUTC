<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id('claveAsig');
            $table->string('Nombre');
            $table->integer('Cuatrimestre');
            $table->integer('HrsTotales');
            $table->integer('HrsPracticas');
            $table->integer('HrsTeoricas');
            $table->string('id_plan');
            $table->string('idCarrera');
            $table->string('id_area');
            $table->string('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaturas');
    }
}
