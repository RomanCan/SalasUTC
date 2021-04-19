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

        <h2>{{ $director }}</h2>
        <h2>{{ $cargo }}</h2>

        <h3>Presente.-</h3><span>Estimado (a) Sr. (a): </span><span>{{ $cargo }}</span>
        <br>
        <span>
            Me dirijo a usted respetuosamente con la finalidad de solicitar su autorización para el
            evento a realizarse el dia de <strong>{{ $fecha }}</strong> en <strong>el
                {{ $laboratorio }}</strong>. <br>

            Cabe destacar que la mencionada actividad forma parte del cronograma organizado por
            <strong>{{ $docente }}</strong>
            para conmemorar {{ $motivo }}. <br>

            Por todo lo expuesto, le reitero mi solicitud de autorización, agradeciendo de antemano toda la cooperación
            que pueda prestar al respecto. <br>

            Sin más a qué referirme y en espera de una pronta y favorable respuesta a esta solicitud, me despido. <br>

            Atentamente: <br>

            {{ $docente }} docente de la universidad tecnologia del centro

        </span>

    </div>

</body>

</html>
