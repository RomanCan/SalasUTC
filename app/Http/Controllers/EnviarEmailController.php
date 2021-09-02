<?php

namespace App\Http\Controllers;

use App\Models\Profesores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EnviarEmailController extends Controller
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
        //
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
    public function mensaje(Request $request)
    {
        $subject = "Solicitud de laboratirio";
        $nombreDirector = $request->director;
        $cargo = $request->cargo;
        $fecha = $request->fecha;
        $laboratorio = $request->laboratorio;
        $motivo = $request->motivo;

        $emailSchool = "romancan33@gmail.com";
        $docente = $request->docente;
        $fromemail = $request->email;

        Mail::send('emails.contactanos', $request->all(), function ($mensaje) use ($subject, $docente, $emailSchool, $fromemail, $nombreDirector, $cargo, $fecha, $laboratorio, $motivo) {
            $mensaje->from($fromemail, $docente);
            $mensaje->subject($subject);
            $mensaje->to($emailSchool, "Laboratorios");
        });
        return redirect()->back();
    }
    public function user(Request $request)
    {
        $subject = "Nombre de usuario y contraseña";
        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;
        $tratamiento = $request->tratamiento;
        // $docente = $tratamiento + $nombre + $apellidop + $apellidom;
        $director = "Puga Sosa";
        $emailDirec = "directorCarreras@Utcentro.com";
        $user = $request->usuario;
        $password = $request->password;
        $email = $request->email;

        Mail::send('emails.username', $request->all(), function ($mensaje) use ($director, $emailDirec, $nombre, $user, $password, $email, $subject) {
            $mensaje->from($emailDirec, $director);
            $mensaje->subject($subject);
            $mensaje->to($email, $nombre);
        });
    }
    public function aceptarSolicitud(Request $request)
    {

        // $email_director = DB::select('SELECT email FROM profesores WHERE id_rol = 1 ');
        $email_director = "romancan33@gmail.com";
        // $nombre_director = DB::select


        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;

        // $docente = $nombre + ' ' + $apellidom + ' ' + $apellidop;
        $email = $request->email;

        $fecha = $request->fecha_solicitada;
        $titulo_actividad = $request->titulo_actividad;
        $detalle_actividad = $request->detalle_actividad;
        $ClaveGrupo = $request->ClaveGrupo;
        $hora = $request->hora;

        $espacio = $request->espacio;
        $ubicacion = $request->ubicacion;
        $asignatura = $request->asignatura;
        $subject = "Solicitud Aprobada";


        Mail::send('emails.aceptar_solicitud', $request->all(), function ($message) use (
            $email_director,
            $email,
            $nombre,
            $apellidop,
            $apellidom,
            $subject,
            $fecha,
            $titulo_actividad,
            $detalle_actividad,
            $ClaveGrupo,
            $hora,
            $espacio,
            $ubicacion,
            $asignatura
        ) {
            $message->from($email_director, 'Puga');

            $message->to($email, $nombre);

            $message->subject($subject);
        });
        return redirect()->back();
    }
    public function rechazarSolicitud(Request $request)
    {
        // $email_director = DB::select('SELECT email FROM profesores WHERE id_rol = 1 ');
        $email_director = "romancan33@gmail.com";
        // $nombre_director = DB::select


        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;

        // $docente = $nombre + ' ' + $apellidom + ' ' + $apellidop;
        $email = $request->email;

        $fecha = $request->fecha_solicitada;
        $titulo_actividad = $request->titulo_actividad;
        $detalle_actividad = $request->detalle_actividad;
        $ClaveGrupo = $request->ClaveGrupo;
        $hora = $request->hora;

        $espacio = $request->espacio;
        $ubicacion = $request->ubicacion;
        $asignatura = $request->asignatura;
        $subject = "Solicitud Rechazada";


        Mail::send('emails.rechazar_solicitud', $request->all(), function ($message) use (
            $email_director,
            $email,
            $nombre,
            $apellidop,
            $apellidom,
            $subject,
            $fecha,
            $titulo_actividad,
            $detalle_actividad,
            $ClaveGrupo,
            $hora,
            $espacio,
            $ubicacion,
            $asignatura
        ) {
            $message->from($email_director, 'Puga');

            $message->to($email, $nombre);

            $message->subject($subject);
        });
        return redirect()->back();
    }
}
