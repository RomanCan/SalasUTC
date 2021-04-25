@extends('layouts.masterDirector')
@section('contenido')
    <div id="usuario">


        <div class="row">

            <div class="col-md-12">
                <div class="col-md-5">
                    <button class="btn btn-outline-primary" @click="showModal">Agregar</button>
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
                <table class="table table-responsive table-hover" v-if="usuarios.length != 0">
                    <thead>
                        <th>Docente</th>
                        <th>Nivel de estudio</th>
                        <th>Nombre de usuario</th>
                        <th>Contraseña</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        <tr v-for="(user,index) in usuarios">
                            <td>@{{ user . tratamiento }} @{{ user . nombre }} @{{ user . apellidop }}
                                @{{ user . apellidom }}
                            </td>
                            <td>@{{ user . nivelestudio }}</td>
                            <td>@{{ user . usuario }}</td>
                            <td>@{{ user . password }}</td>
                            <td>@{{ user . email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- modal --}}
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="modal fade" tabindex="-1" role="dialog" id="agregar_user">
                    <div class="modal-dialog" role="document">
                        {{-- @csrf --}}
                        <div class="modal-content">
                            <div class="modal-header" style="background: #2387FF; color: #fff">

                                <h4 class="modal-title" v-if="editar">Editar Espacio</h4>
                                <h4 class="modal-title" v-if="!editar">Guardar información del docente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                        aria-hidden="true" @click="salir()">x</span></button>
                            </div>
                            <div class="modal-body" align="center">
                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-6">
                                        <select class="form-control" v-model="cedula">

                                            <option v-for="doc in docentes" :value="doc.cedula">
                                                @{{ doc . nombre }} @{{ doc . apellidop }} @{{ doc . apellidom }}

                                            </option>

                                        </select>
                                        <br>
                                        <button v-if="cedula" class="btn btn-outline-success" :href="cedula"
                                            @click="editarI(cedula)">Editar</button>
                                        <hr>

                                    </div>
                                    <div class="col-md-12 col-sm-6 col-xs-6 text-left" v-if="editarInfo">
                                        <label for="">Nombre de usuario:</label><input type="text" class="form-control"
                                            placeholder="Nombre de usuario" v-model="usuario">
                                        <label for="">Contraseña:</label><input type="text" class="form-control"
                                            placeholder="Contraseña" v-model="password">
                                        <label for="">Email:</label><input type="email" class="form-control"
                                            placeholder="Email" v-model="email">
                                        <br>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" v-if="editarInfo">
                                <button class="btn btn-outline-primary" @click="guardar()">Guardar</button>
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
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
