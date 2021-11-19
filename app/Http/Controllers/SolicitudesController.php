<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use App\Models\Horarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DataTables;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        // return $rsoli = Solicitudes::where('cedula', '=', $soli)->get();

        // '(CASE res_solicitudes.status WHEN 0 THEN "rechazado" WHEN 1 THEN "espera" WHEN 2 THEN "aprobado" WHEN 3 THEN "finalizado" END) AS status from res_solicitudes'
        if ($request->ajax()) {
            $docente = Session::get('cedula');
            //$data = DB::select('select * from res_solicitudes rs INNER JOIN res_espacios re ON re.id = rs.res_espacio_id  where cedula = ?', $soli)->get();
            $data = DB::table('res_solicitudes')
                ->join('res_espacios', 'res_solicitudes.id_espacio', '=', 'res_espacios.id_espacio')
                ->join('res_horarios', 'res_solicitudes.id_horario', '=', 'res_horarios.id_horario')
                ->select('res_solicitudes.id_espacio as id_espacio', 'res_espacios.nombre as nombre_espacio', 'res_solicitudes.id_solicitud as id_solicitud', 'res_solicitudes.titulo_actividad as titulo_actividad', 'res_solicitudes.detalle_actividad as detalle_actividad', 'res_solicitudes.asignatura as asignatura', 'res_horarios.hora_inicio as hora_inicio', 'res_horarios.hora_final as hora_final', 'res_solicitudes.fecha_solicitada as fecha_solicitada', 'res_solicitudes.status as status')
                ->where('cedula', '=', $docente)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm btn-ver-dato" id="btn-ver-dato" data-info="$row->id_solicitud">Editar</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('docentes.solicitudes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $soli = new Solicitudes();
        $soli->cedula = $request->get('cedula');
        $soli->id_espacio = $request->get('id_espacio');
        $soli->id_horario = $request->get('id_horario');
        $soli->fecha_solicitud = $request->get('fecha_solicitud');
        $soli->fecha_solicitada = $request->get('fecha_solicitada');
        // $soli->hora_inicio = $request->get('hora_inicio');
        // $soli->hora_final = $request->get('hora_final');
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
        $soli->cedula = $request->get('cedula');
        $soli->id_espacio = $request->get('id_espacio');
        $soli->id_horario = $request->get('id_horario');
        $soli->fecha_solicitud = $request->get('fecha_solicitud');
        $soli->fecha_solicitada = $request->get('fecha_solicitada');
        $soli->fecha_autorizacion = $request->get('fecha_autorizacion');
        // $soli->hora_inicio = $request->get('hora_inicio');
        // $soli->hora_final = $request->get('hora_final');
        $soli->titulo_actividad = $request->get('titulo_actividad');
        $soli->detalle_actividad = $request->get('detalle_actividad');
        $soli->status = $request->get('status');
        $soli->ClaveGrupo = $request->get('ClaveGrupo');
        $soli->ClaveAsig = $request->get('ClaveAsig');
        $soli->asignatura = $request->get('asignatura');
        $soli->participantes = $request->get('participantes');
        $soli->tipo_solicitud = $request->get('tipo_solicitud');
        $soli->update();
        $cupo = 1;
        $id_espacio = $request->id_espacio;
        DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
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

    public function getHorarios(Request $request)
    {
        $espacio_id = $request->get('espacio_id');
        $fecha_solicitada = $request->get('fecha_solicitada');

        $solicitudes_existentes = DB::select("Select *
         from res_solicitudes where (status = 2)
         AND id_espacio = $espacio_id AND DATE(fecha_solicitada) = STR_TO_DATE('$fecha_solicitada', '%Y-%m-%d')");

        $horas_espacios = DB::select("Select * from res_horarios where id_espacio = $espacio_id");

        if (count($solicitudes_existentes) > 0) {
            $horarios_ids = collect($solicitudes_existentes)->pluck('id_horario');
            $string = str_replace('[', ' ', $horarios_ids);
            $string2 = str_replace(']', ' ', $string);
            $horas_espacios = DB::select("Select * from res_horarios where id_espacio = $espacio_id AND id_horario not in ($string2)");
        }

        return response()->json([
            'horas_espacios' => $horas_espacios,
        ]);
    }
}
