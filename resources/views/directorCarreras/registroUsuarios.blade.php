@extends('layouts.masterDirector')
@section('contenido')
    <div id="usuario">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <button class="btn btn-info" @click="showModal"><i class="material-icons">person_add
                        </i>&nbsp;Agregar</button>
                </div>
                <br>
                <div v-if="usuarios.length == 0">
                    <p class="text-center">
                        <strong>
                            Agrege a los docentes
                            <hr>
                        </strong>
                    </p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="dt_admin_usuarios" class="data-table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Docente</th>
                                <th>Nivel de estudio</th>
                                <th>Nombre de usuario</th>
                                <th>Contraseña</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                {{-- <tr v-for="(user,index) in usuarios">
                                    <td>@{{ user . tratamiento }} @{{ user . nombre }} @{{ user . apellidop }}
                                        @{{ user . apellidom }}</td>
                                    <td>@{{ user . nivelestudio }}</td>
                                    <td>@{{ user . usuario }}</td>
                                    <td>@{{ user . password }}</td>
                                    <td>@{{ user . email }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="modal fade" tabindex="-1" role="dialog" id="agregar_user">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        {{-- @csrf --}}
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(242 145 0); color: #fff">

                                <h4 class="modal-title" v-if="editar">Editar Espacio</h4>
                                <h4 class="modal-title" v-if="!editar">Guardar información del docente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                        aria-hidden="true" @click="salir()">x</span></button>
                            </div>
                            <div class="modal-body" align="center">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="" style="color: #000000"><b>Seleccione al docente:</b></label>
                                            <select class="form-control" v-model="cedula">
                                                <option v-for="doc in docentes" :value="doc.cedula">
                                                    @{{ doc . nombre }} @{{ doc . apellidop }} @{{ doc . apellidom }}
                                                </option>
                                            </select>
                                        </div>
                                        <button v-if="cedula" class="btn btn-success" :href="cedula"
                                            @click="editarI(cedula)"><i
                                                class="material-icons">manage_accounts</i>&nbsp;Editar</button>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-left" v-if="editarInfo">
                                        <div class="form-group">
                                            <label for="" style="color: #000000"><b>Nombre de usuario:</b></label>
                                            <input type="text" class="form-control" placeholder="Nombre de usuario"
                                                v-model="usuario">
                                            <div v-if="errors && errors.usuario">
                                                <small class="text-danger">@{{ errors . usuario[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="color: #000000"><b>Contraseña:</b></label>
                                            <input type="text" class="form-control" placeholder="Contraseña"
                                                v-model="password">
                                            <div v-if="errors && errors.password">
                                                <small class="text-danger">@{{ errors . password[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="color: #000000"><b>Email:</b></label>
                                            <input type="email" class="form-control" placeholder="Email" v-model="email">
                                            <div v-if="errors && errors.email">
                                                <small class="text-danger">@{{ errors . email[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" v-if="editarInfo">
                                <button class="btn btn-outline-info" @click="guardar()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="js/director/usuarios.js"></script>
    <script src="js/director/usuarios_dt.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
<input type="hidden" id="url_usuarios" value="{{ url('apiUsuarios') }}">
