<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use DB;
use Codedge\Fpdf\Fpdf\Fpdf;

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
        //
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

    public function reporte($id)
    {
        $docentes = Solicitudes::find($id);
        
        $pdf = new Fpdf('P','mm','Letter');
        
        // agregar una pagina
        $pdf -> AddPage();
        // definicion de letra, estilo y tamaño
        $pdf -> SetFont('Arial','B',14);
        $pdf->Cell(190,8,utf8_decode('EVIDENCIA DE PRÁCTICA'),0,1,'C');
        $pdf->Image('img/logoUTC.png',10,6,40,20);
        // salto de linea
        $pdf->Ln(20);
        $pdf -> SetFont('Arial','',12);
        // $pdf->Cell(190,8,utf8_decode('Responsable de práctica: '.$prueba),1,1,'L');
        $pdf->Cell(190,8,utf8_decode('Responsable de práctica: '.$docentes->profesor->nombre.' '.$docentes->profesor->apellidop.' '.$docentes->profesor->apellidom),0,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Espacio reservado: '.$docentes->espacio->nombre),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Fecha de solicitud: '.$docentes->fecha_solicitud),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Fecha Solicitada: '.$docentes->fecha_solicitada),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Titulo de la actividad: '.$docentes->titulo_actividad),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Detalle de la actividad: '.$docentes->detalle_actividad),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Clave del Grupo: '.$docentes->ClaveGrupo),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Clave de asignatura: '.$docentes->ClaveAsig),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Cantidad de participantes: '.$docentes->asignatura),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Cantidad de participantes: '.$docentes->participantes),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Hora de inicio: '.$docentes->horarios->hora_inicio),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Hora de inicio: '.$docentes->horarios->hora_final),1,1,'L');
        $pdf->Ln(1);
        $pdf->Cell(190,8,utf8_decode('Cuatrimestre: '.$docentes->asignaturas->Cuatrimestre),1,1,'L');
        $pdf->Ln(50);
        $pdf->Cell(190,8,utf8_decode('____________________________________'),0,1,'C');
        $pdf->Cell(190,8,utf8_decode('Firma del Coordinador de carreras '),0,1,'C');
        
        


        // Enviar a impresion
        $pdf->Output();
        exit;


    }
}
