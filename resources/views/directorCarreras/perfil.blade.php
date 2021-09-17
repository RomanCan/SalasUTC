@extends('layouts.masterDirector')
@section('contenido')
<div class="row container-fluid" id="usuariodocente">
  <div hidden="true">@{{ id_session = "{!!Session::get('cedula')!!}" }}</div>
  <div class="col-md-2"></div>
  <div class="col-md-8" v-for="usdoc in docentes">
    <form>
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title"><i class="material-icons">badge</i>&nbsp;Información general</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating" style="color: #000000;">Nombre:</label></b><br>
                <label style="color: #000000;">@{{ usdoc . tratamiento }} @{{ usdoc . nombre }} @{{ usdoc . apellidop }} @{{ usdoc . apellidom }}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating" style="color: #000000;">Profesión:</label></b><br>
               <label style="color: #000000;">@{{ usdoc . profesion }}</label>
              </div>
            </div>
          </div>
        </div>  
      </div>

      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title"><i class="material-icons">admin_panel_settings</i>&nbsp;Información de la cuenta</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating" style="color: #000000;">Nombre de usuario:</label></b><br>
                <label style="color: #000000;">@{{ usdoc . usuario }}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating" style="color: #000000;">Contraseña:</label></b><br>
                <label id="pass" style="color: #000000;">@{{ usdoc . password }}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <b><label class="bmd-label-floating" style="color: #000000;">Correo:</label></b><br>
                <label style="color: #000000;">@{{ usdoc . email }}</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-success btn-lg float-right" @click="editarDatos(usdoc.cedula)">
              <i class="material-icons" style="font-size: 20px;">manage_accounts</i> &nbsp;Editar datos</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Ventana modal  -->
      <div class="modal fade" id="Mostrar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background: #2c3134; color: #fff">
              <h5 class="modal-title">Actualizar datos</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group">
                  <label style="color: #000000">Usuario</label>
                  <input type="text" class="form-control" v-model="usuario" required>
                </div>
                <div class="form-group">
                  <label style="color: #000000">Contraseña</label>
                  <input type="text" class="form-control" v-model="password" required>
                </div>
                <div class="form-group">
                  <label style="color: #000000">Correo</label>
                  <input type="email" class="form-control" v-model="email" required>
                </div>
              </form>
               <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" @click="actualizarDatosDocente()">Actualizar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin ventana modal -->

    </form>
  </div>
  <div class="col-md-2"></div>
</div>

<script>
    var pass = document.getElementById("pass").innerHTML;
    var char = pass.length;
    var password = "";
    for (i = 0; i < char; i++) {
      password += "*";
    }
    document.getElementById("pass").innerHTML = password;
</script>
@endsection
@push('scripts')
    <script src="js/docente/usuario.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
