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

        // $nombreDirector = DB::select('select nombre from profesores where id_rol = ?', [1]);
        // $apD = $director->apellidop;
        // $amD = $director->apellidom;
        $fecha_solicitada = $request->fecha_solicitada;
        $espacio = $request->espacio;

        $titulo_actividad = $request->titulo_actividad;
        $hora_inicio = $request->hora_inicio;
        $hora_final = $request->hora_final;
        $asignatura = $request->asignatura;

        $subject = "Solicitud";
        $emailSchool = "atencion.salas@gmail.com";
        $nombre_docente = $request->nombre_docente;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;
        $email = $request->email;

        Mail::send('emails.contactanos', $request->all(), function ($mensaje) use (
            $subject,
            $nombre_docente,
            $apellidop,
            $apellidom,
            $emailSchool,
            $email,

            $espacio,
            $fecha_solicitada,
            $titulo_actividad,
            $asignatura,
            $hora_inicio,
            $hora_final

        ) {
            $mensaje->from($email, $nombre_docente);
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
        $emailDirec = "atencion.salas@gmail.com";
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

        $email_director = "atencion.salas@gmail.com";
        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;
        $email = $request->email;

        $fecha = $request->fecha_solicitada;
        $titulo_actividad = $request->titulo_actividad;
        $detalle_actividad = $request->detalle_actividad;
        $ClaveGrupo = $request->ClaveGrupo;
        $hora_inicio = $request->hora_inicio;
        $hora_final = $request->hora_final;

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
            $hora_inicio,
            $hora_final,
            $espacio,
            $ubicacion,
            $asignatura
        ) {
            $message->from($email_director, 'Director de carreras');

            $message->to($email, $nombre);

            $message->subject($subject);
        });
        return redirect()->back();
    }
    public function rechazarSolicitud(Request $request)
    {

        $email_director = "atencion.salas@gmail.com";

        $nombre = $request->nombre;
        $apellidop = $request->apellidop;
        $apellidom = $request->apellidom;

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
            $message->from($email_director, 'Director de carreras');

            $message->to($email, $nombre);

            $message->subject($subject);
        });
        return redirect()->back();
    }
}
