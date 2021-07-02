@extends('layouts.masterDocente')

@section('contenido')
    
    {{-- probando vue --}}
    {{-- @{{n}} --}}

    {{-- Campos de formulario para envio de email funcionando --}}
    {{-- <h3>Formulario de contacto</h3>
    <form action={{ url('contact') }} method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Docente</label>
             <input name="docente" type="text" class="form-control" placeholder="Docente" required>
        </div>
        <div class="form-group">
             <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
         </div>
                        

        <div class="form-group">
            <label for="director">Nombre Director</label>
            <input name="director" type="text" class="form-control" placeholder="Nombre del director" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input name="cargo" type="text" class="form-control" placeholder="Cargo" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
             <input name="fecha" type="date" class="form-control" placeholder="Fecha" required>
        </div>
        <div class="form-group">
            <label for="laboratorio">Laboratorio</label>
            <input name="laboratorio" type="text" class="form-control" placeholder="Laboratorio" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo</label>
            <input name="motivo" type="text" class="form-control" placeholder="Motivo" required>
        </div>
        <div class="form-group">
            <button type="submit" id='btn-contact' class="btn btn-success">Enviar</button>
         </div>
    </form>  --}}

    {{-- Fin de envio de email --}}

    {{-- calendario --}}
<div>
    <div class="container">
        <div id="solicitudes">
            calendario
            
        </div>
    </div>  
    {{-- fin de calendario --}}

    {{-- modal --}}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Agregar">
      Launch
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="Agregar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="sol">
                    <form action="">
                        {{-- identificar los datos que estan llegando solo de este formulario --}}
                        @csrf
                    @{{n}}
                        <div class="form-group">
                          <label for="id_solicitud">ID</label>
                          <input type="text" class="form-control" name="id_solicitud" id="id_solicitud" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="titulo_actividad">Titulo de Actividad</label>
                          <input type="text" class="form-control" name="titulo_actividad" id="titulo_actividad" aria-describedby="helpId" placeholder="Escribe el titulo de la actividad">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="detalle_actividad">Descripción de la actividad</label>
                          <textarea class="form-control" name="detalle_actividad" id="detalle_actividad" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="fecha_solicitud">Fecha de solicitud</label>
                          <input type="text" class="form-control" name="fecha_solicitud" id="fecha_solicitud" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="cedula">Cedula</label>
                          <input type="text" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="id_espacio">Espacio</label>
                          <input type="text" class="form-control" name="id_espacio" id="id_espacio" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="ClaveGrupo">Clave de Grupo</label>
                          <input type="text" class="form-control" name="ClaveGrupo" id="ClaveGrupo" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="ClaveAsig">Asignatura</label>
                          <input type="text" class="form-control" name="ClaveAsig" id="ClaveAsig" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="participantes">Participantes</label>
                          <input type="number" class="form-control" name="participantes" id="participantes" aria-describedby="helpId" placeholder="" min="0">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="hora_solicitada">Hora de Actividad</label>
                          <input type="time" class="form-control" name="hora_solicitada" id="hora_solicitada" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal --}}
</div>


@endsection

@push('scripts')

<script src="js/vue-resource.js"></script>

<script src="js/docente/solicitudes.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
