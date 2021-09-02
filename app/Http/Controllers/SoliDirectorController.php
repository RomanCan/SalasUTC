<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;

class SoliDirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $soli = Solicitudes::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $soli = Solicitudes::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $soli = Solicitudes::find($id);
        $soli->cedula = $request->get('cedula');
        $soli->id_espacio = $request->get('id_espacio');
        $soli->fecha_solicitud = $request->get('fecha_solicitud');
        $soli->fecha_solicitada = $request->get('fecha_solicitada');
        $soli->fecha_autorizacion = $request->get('fecha_autorizacion');
        $soli->hora = $request->get('hora');
        $soli->titulo_actividad = $request->get('titulo_actividad');
        $soli->detalle_actividad = $request->get('detalle_actividad');
        $soli->status = $request->get('status');
        $soli->ClaveGrupo = $request->get('ClaveGrupo');
        $soli->ClaveAsig = $request->get('ClaveAsig');
        $soli->asignatura = $request->get('asignatura');
        $soli->participantes = $request->get('participantes');
        $soli->tipo_solicitud = $request->get('tipo_solicitud');
        $soli->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
