@extends('layouts.masterDirector')
@section('contenido')

    <style type="text/css">
        :root {
            --border-color: #D8D8D8;
        }

        .form-neon {
            border: 2px solid var(--border-color);
            background-color: #FFF;
            padding: 15px;
            border-radius: 2px;
        }

        legend {
            text-align: center;
            border-radius: 3px;
            padding: 10px;
        }

    </style>
    <div class="row container-fluid" id="usuariodocente">
        <div hidden="true">@{{ id_session = "{!!Session::get('cedula')!!}" }}</div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form class="form-neon" v-for="usdoc in docentes">
                <fieldset>
                    <legend><i class="material-icons">badge</i>&nbsp;Información general</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <b><label class="bmd-label-floating">Nombre:</label></b><br>
                                    <label>@{{ usdoc . tratamiento }} @{{ usdoc . nombre }} @{{ usdoc . apellidop }}
                                        @{{ usdoc . apellidom }}</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <b><label class="bmd-label-floating">Profesión:</label></b><br>
                                    <label>@{{ usdoc . profesion }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <legend><i class="material-icons">admin_panel_settings</i>&nbsp;Información de la cuenta</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <b><label class="bmd-label-floating">Nombre de usuario:</label></b><br>
                                    <label>@{{ usdoc . usuario }}</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <b><label class="bmd-label-floating">Contraseña:</label></b><br>
                                    <label id="pass">@{{ usdoc . password }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <b><label class="bmd-label-floating">Correo:</label></b><br>
                                    <label>@{{ usdoc . email }}</label>
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
                                <button type="button" class="btn btn-outline-success btn-lg float-right"
                                    @click="editarDatos(usdoc.cedula)"><i class="material-icons"
                                        style="font-size: 20px;">manage_accounts</i>
                                    &nbsp;Editar datos</button>
                            </div>
                            <!-- <div class="col-md-3"></div> -->
                        </div>
                    </div>
                    <!-- Ventana modal  -->
                    <div class="modal fade" id="Mostrar" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #2387FF; color: #fff">
                                    <h5 class="modal-title">Actualizar datos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        @click="">
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
                                        <button type="button" class="btn btn-outline-success"
                                            @click="actualizarDatosDocente()">Actualizar</button>
                                        <button type="button" class="btn btn-outline-danger"
                                            data-dismiss="modal">Cerrar</button>
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
