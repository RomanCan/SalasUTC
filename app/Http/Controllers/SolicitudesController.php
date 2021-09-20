<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //res_solicitudes.id_solicitud,
        //profesores.nombre,
        // docentesporgrupo.ClaveCarga, docentesporgrupo.ClaveGrupo,
        // asignaturas.ClaveAsig, asignaturas.nombre AS asignatura
        //FROM res_solicitudes
        //INNER JOIN profesores
        //ON res_solicitudes.cedula = profesores.cedula
        //INNER JOIN docentesporgrupo
        //ON res_solicitudes.ClaveGrupo = docentesporgrupo.ClaveGrupo
        //INNER JOIN Asignaturas
        //ON res_solicitudes.ClaveAsig = asignaturas.ClaveAsig
        // return $solicitudes = Solicitudes::all();
        // return $solicitudes = DB::select(
        //     'SELECT  res_espacios.nombre AS Espacio, profesores.cedula AS Cedula,
        //     profesores.nombre AS Docente,
        //     res_solicitudes.fecha_solicitud,
        //     res_solicitudes.fecha_solicitada,
        //     res_solicitudes.fecha_autorizacion,
        //     res_solicitudes.titulo_actividad,


        //     res_solicitudes.detalle_actividad,
        //     res_solicitudes.participantes,
        //     res_solicitudes.tipo_solicitud,
        //     res_solicitudes.status,


        //     docentesporgrupo.ClaveGrupo AS ClaveGrupo,
        //     asignaturas.ClaveAsig AS ClaveAsignatura, asignaturas.nombre AS Asignatura
        //     FROM res_solicitudes
        //     INNER JOIN res_espacios
        //     ON res_solicitudes.id_espacio = res_espacios.id_espacio
        //     INNER JOIN profesores
        //     ON res_solicitudes.cedula = profesores.cedula
        //     INNER JOIN docentesporgrupo
        //     ON res_solicitudes.ClaveGrupo = docentesporgrupo.ClaveGrupo
        //     INNER JOIN Asignaturas
        //     ON res_solicitudes.ClaveAsig = asignaturas.ClaveAsig
        //     LIMIT 1
        //     '
        // );

        // return $soli = Solicitudes::all();
        $soli = Session::get('cedula');
        return $rsoli = Solicitudes::where('cedula', '=', $soli)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $soli = new Solicitudes;
        $soli->cedula = $request->get('cedula');
        $soli->id_espacio = $request->get('id_espacio');
        $soli->fecha_solicitud = $request->get('fecha_solicitud');
        $soli->fecha_solicitada = $request->get('fecha_solicitada');
        $soli->hora_inicio = $request->get('hora_inicio');
        $soli->hora_final = $request->get('hora_final');
        $soli->titulo_actividad = $request->get('titulo_actividad');
        $soli->detalle_actividad = $request->get('detalle_actividad');
        $soli->status = $request->get('status');
        $soli->ClaveGrupo = $request->get('ClaveGrupo');
        $soli->ClaveAsig = $request->get('ClaveAsig');
        $soli->asignatura = $request->get('asignatura');
        $soli->participantes = $request->get('participantes');
        $soli->tipo_solicitud = $request->get('tipo_solicitud');
        $soli->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $soli = Solicitudes::find($id);

        $soli->update($request->all());
        return response()->json($soli, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Solicitudes::destroy($id);
    }
}
