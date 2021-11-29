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
                ->addColumn('action', function ($data) {
                    $id_solicitud = $data->id_solicitud;
                    $id_espacio = $data->id_espacio;
                    $status = $data->status;
                    if ($status === 0) {
                        return $mensaje = '<span style=" color: rgb(233, 32, 18)"> <i class="material-icons">warning</i></span>';
                    } elseif ($status === 1) {
                        $btn = '<button type="button" class="edit btn btn-success btn-sm btn-ver-dato" data-id_solicitud="' . $id_solicitud . '" data->Editar</button>';
                        return $btn;
                    } elseif ($status === 2) {
                        $btn = '<button type="button" class="edit btn btn-info btn-sm btn-finalizar" data-id_solicitud="' . $id_solicitud . '" data-id_espacio = "' . $id_espacio . '">Finalizar</button>';
                        return $btn;
                    } elseif ($status === 3) {
                        return $mensaje = '<span style=" color: rgb(0, 102, 255)"> <i class="material-icons">verified</i></span>';
                    }
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
    public function update_solicitud(Request $request)
    {
        $s = $request->get('status');
        $id_solicitud = $request->get('id');
        $soli = Solicitudes::find($id_solicitud);
        $soli->status = $s;
        if ($request->status === 3) {
            $cupo = 1;
            $id_espacio = $request->get('id_espacio');
            DB::update("UPDATE res_espacios SET cupo = $cupo WHERE id_espacio = $id_espacio");
        }
        $soli->update();
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
