@extends('layouts.masterDocente')

@section('contenido')


<div id="soli">

 
    
     <!-- probando vue  -->
    <!-- {{-- @{{n}} --}} -->

    <!-- {{-- Campos de formulario para envio de email funcionando --}} -->
     <!-- <h3>Formulario de contacto</h3>
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
    </form>  -->

    <!-- {{-- Fin de envio de email --}} -->

  

    <!-- {{-- modal --}} -->
    <!-- Button trigger modal -->
    <div>
      @{{id_session = "{!!Session::get('usuario')!!}"}}
    </div>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Agregar">
      Hacer una solicitud
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
                        <!-- {{-- identificar los datos que estan llegando solo de este formulario --}} -->
                        @csrf
                    <!-- @{{n}} -->
                        
                        
                       
                        <div class="form-group" >
                          <label for="">Docente</label>
                          <select name="" id="" v-model="cedula" @change="getDocentesGrupos" class="form-control">
                            <option v-for="doc in docentes" :value="doc.cedula" >@{{doc.nombre}}</option>
                          </select>
                          
                        </div>
                        
                        <div class="form-group">
                          <label for="ClaveGrupo">Clave de Grupo</label>
                          <select name="" id="" class="form-control" v-model="ClaveGrupo" @change="getAsignaturas" class="form-control">
                            <option v-for="d in docentesgrupos" :value="d.ClaveAsig">@{{d.ClaveGrupo}}</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="ClaveAsig">Asignatura</label>
                          <select name="" id="" v-model="ClaveAsig" class="form-control">
                            <option v-for="a in asignaturas" :value="a.ClaveAsig">@{{a.Nombre}}</option>
                          </select>
                          
                        
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
    <!-- {{-- fin modal --}} -->
</div>


@endsection

@push('scripts')

<script src="js/vue-resource.js"></script>

<script src="js/docente/solicitudes.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
