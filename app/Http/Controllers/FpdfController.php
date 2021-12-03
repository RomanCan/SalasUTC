<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Session;

class FpdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function reporte(Request $request)
    {
        // datos del jquery
        // $cedula = $request->get('cedula');
        $id_solicitud = $request->get('id_solicitud');
        $cedula = Session::get('cedula');
        $id_espacio = $request->get('id_espacio');
        $id_horario = $request->get('id_horario');
        $ClaveAsig = $request->get('ClaveAsig');

        // consultas
        $profesores = DB::select("SELECT * FROM profesores WHERE cedula = $cedula");
        $espacios = DB::select("SELECT * FROM res_espacios WHERE id_espacio = $id_espacio");
        $solicitudes = DB::select("SELECT * FROM res_solicitudes WHERE id_solicitud = $id_solicitud");
        $horarios = DB::select("SELECT * FROM res_horarios WHERE id_horario = $id_horario");
        $asignaturas = DB::select("SELECT * FROM asignaturas WHERE ClaveAsig = '$ClaveAsig'");

        $pdf = new Fpdf('P', 'mm', 'Letter');
        $pdf->SetMargins(25, 20, 25, 20);

        // agregar una pagina
        $pdf->AddPage();
        // definicion de letra, estilo y tamaño
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Image('img/logoUTC.png', 10, 10, 40, 20);
        $pdf->Image('img/logoUTC.png', 167, 10, 40, 20);
        $pdf->Cell(167, 8, utf8_decode('EVIDENCIA DE PRÁCTICA'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(167, 8, utf8_decode($solicitudes[0]->titulo_actividad), 0, 0, 'C');
        $pdf->Ln(14);
        $pdf->SetFont('Arial', 'BI', 12);
        $pdf->Cell(190, 8, utf8_decode('Fecha de solicitud: ' . $solicitudes[0]->fecha_solicitud), 0, 1, 'J');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Multicell(0, 10, utf8_decode('El siguiente reporte hace constatar que yo: ' . $profesores[0]->nombre . ' ' . $profesores[0]->apellidop . ' ' . $profesores[0]->apellidom . ' con la ' . 'asignatura ' . $solicitudes[0]->asignatura . ' del ' . $asignaturas[0]->Cuatrimestre . '°' . ' cuatrimestre, ' . 'impartido al grupo ' . $solicitudes[0]->ClaveGrupo . ' en la fecha ' . $solicitudes[0]->fecha_solicitada . ' con un total de: ' . $solicitudes[0]->participantes . ' participantes, en un horario de ' . $horarios[0]->hora_inicio . ' a ' . $horarios[0]->hora_final . ' HRS; ' . 'he finalizado el uso del espacio: ' . strtoupper($espacios[0]->nombre) . ', que se encuentra en el: ' . strtoupper($espacios[0]->ubicacion) . '.'), 0, 'J');
        $pdf->Ln(5);
        $pdf->Cell(220, 8, utf8_decode('A continuación, se describe  el detalle de la actividad: '), 0, 1, 'J');
        $pdf->Ln(5);
        $pdf->Multicell(0, 10, utf8_decode($solicitudes[0]->detalle_actividad), 0, 'J');
        $pdf->Ln(40);
        $pdf->Cell(167, 8, utf8_decode('____________________________________'), 0, 1, 'C');
        $pdf->Cell(167, 8, utf8_decode('Firma del Coordinador de carreras '), 0, 1, 'C');
        // Enviar a impresion
        $pdf->Output();
        exit();
    }
}
