<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_solicitudes', function (Blueprint $table) {
            $table->id('id_solicitud');

            $table->string('cedula');
            $table->foreign('cedula')->references('cedula')->on('profesores');

            $table->unsignedBigInteger('id_espacio');
            $table->foreign('id_espacio')->references('id_espacio')->on('res_espacios');

            $table->date('fecha_solicitud');
            $table->date('fecha_solicitada');
            $table->date('fecha_autorizacion');
            $table->string('titulo_actividad');
            $table->string('detalle_actividad');
            $table->boolean('status');
            $table->string('ClaveGrupo');
            $table->string('ClaveAsig');
            $table->integer('participantes');
            $table->string('tipo_solicitud');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_solicitudes');
    }
}
