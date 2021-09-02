<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud rechazada</title>
</head>

<body>
    <div style="text-transform:uppercase">
        <h2>Asunto: Solicitud Rechazada</h2>
        <h3>Estimado docente {{ $nombre }} {{ $apellidop }} {{ $apellidom }}, se ha rechazado su solicitud
            para la
            asignatura de {{ $asignatura }}, del grupo {{ $ClaveGrupo }}, el cual se realizara en la sala
            {{ $espacio }} que se encuentra en el
            {{ $ubicacion }} con el siguiente concepto: </h3>
        <h3>{{ $detalle_actividad }}.</h3>
        <p>Nota: esta informacion se encuentra en su panel de solicitudes.</p>
    </div>
</body>

</html>
