<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    </style>
</head>

<body>

    <div>



        {{-- <h3>Presente.-</h3><span>Estimado (a) Sr. (a): </span><span>{{ $cargo }}</span>
        <br> --}}
        <span>
            Me dirijo a usted respetuosamente con la finalidad de solicitar su autorización para el
            evento a realizarse el dia de <strong>{{ $fecha_solicitada }}</strong> en <strong>el
                {{ $espacio }}</strong>, dando inicio a las"{{ $hora_inicio }}" con terminacion a las
            "{{ $hora_final }}", para la asignatura de "{{ $asignatura }}" <br>

            Cabe destacar que la mencionada actividad forma parte del cronograma organizado por
            <strong>{{ $nombre_docente }} {{ $apellidop }} {{ $apellidom }}</strong>
            para conmemorar " {{ $titulo_actividad }} ". <br>

            Por todo lo expuesto, le reitero mi solicitud de autorización, agradeciendo de antemano toda la cooperación
            que pueda prestar al respecto. <br>

            Sin más a qué referirme y en espera de una pronta y favorable respuesta a esta solicitud, me despido. <br>

            Atentamente: <br>

            {{ $nombre_docente }} {{ $apellidop }} {{ $apellidom }}docente de la universidad tecnologia del
            centro

        </span>

    </div>

</body>

</html>
