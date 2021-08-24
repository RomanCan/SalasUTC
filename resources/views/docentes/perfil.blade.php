@extends('layouts.masterDocente')
@section('contenido')

<style type="text/css">
  :root{
    --border-color: #D8D8D8;
  }
  .form-neon{
  border: 2px solid var(--border-color);
  background-color: #FFF;
  padding: 15px;
  border-radius: 2px;
  }

  legend{
    text-align: center;
    border-radius: 3px;
    padding: 10px;
  }
</style>
<div class="row container-fluid" id="usuariodocente">
  <div hidden="true">@{{id_session="{!!Session::get('cedula')!!}"}}</div>
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <form class="form-neon" v-for="usdoc in docentes">
      <fieldset>
        <legend><i class="fas fa-address-card">&nbsp;Información general</i></legend>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating">Nombre:</label></b><br>
                <label>@{{usdoc.tratamiento}} @{{usdoc.nombre}} @{{usdoc.apellidop}} @{{usdoc.apellidom}}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating">Profesión:</label></b><br>
                <label>@{{usdoc.profesion}}</label>
              </div>
            </div>
          </div>
        </div><hr>
        <legend><i class="fas fa-user-lock">&nbsp;Información de la cuenta</i></legend>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating">Nombre de usuario:</label></b><br>
                <label>@{{usdoc.usuario}}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating">Contraseña:</label></b><br>
                <label>@{{usdoc.password}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating">Correo:</label></b><br>
                <label>@{{usdoc.email}}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
              <button type="button" class="btn btn-primary btn-lg float-right" @click="editarDatos(usdoc.cedula)"><i class="fas fa-cog" style="font-size: 20px;"></i> &nbsp;Editar datos</button>
            </div>
            <!-- <div class="col-md-3"></div> -->
          </div>
        </div>
      <!-- Ventana modal  -->
        <div class="modal fade" id="Mostrar" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Actualizar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control" v-model="usuario">
                  </div>
                  <div class="form-group">
                    <label>Contraseña</label>
                    <input type="text" class="form-control" v-model="password">
                  </div>
                  <div class="form-group">
                    <label>Correo</label>
                    <input type="email" class="form-control" v-model="email">
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click="actualizarDatosDocente()">Actualizar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Fin ventana modal -->  
      </fieldset>
    </form>
    <div class="col-md-2"></div>
  </div>
</div>
@endsection
@push('scripts')
<script src="js/docente/usuario.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">

