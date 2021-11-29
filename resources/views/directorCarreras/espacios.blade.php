@extends('layouts.masterDirector')
@section('contenido')
    <div id="espacio">
        <div class="row">
            <div class="col-md-12 ">

                <div class="col-md-5">
                    <button class="btn btn-info" @click="showModal"><i class="material-icons">add_location_alt
                        </i>&nbsp;Agregar</button>
                    <!-- <input type="text" placeholder="Buscar" v-model="search" class="form-control"> -->
                </div>

                <div class="card">
                    <div class="card-body">
                        {{-- tabla --}}
                        <table id="dt_admin_espacios" class="data-table">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                {{-- <th>Cupo</th> --}}
                                <th>Opciones</td>
                            </thead>
                            <tbody>
                                {{-- <tr v-for="(esp, index) in searchE" v-bind:value="esp.id_espacio">
                                    <td>@{{ esp . nombre }}</td>
                                    <td>@{{ esp . ubicacion }}</td>
                                    <td v-if="esp.cupo === 0">
                                        <span
                                            style="background-color: rgb(184, 0, 0); color:white; padding:5px;border-radius: 14px;">Ocupado</span>
                                    </td>
                                    <td v-if="esp.cupo === 1">
                                        <span
                                            style="background-color: rgb(41, 153, 26); color:white; padding:5px;border-radius: 14px;">Disponible</span>
                                    </td>

                                    <span>
                                        <td class="" role=" group">
                                            <span class="btn btn-success" @click="editarEspacio(esp.id_espacio)">
                                                <i class="material-icons">mode_edit_outline</i>&nbsp;Editar
                                            </span>
                                            <span class="btn btn-danger" @click="eliminarEspacio(esp.id_espacio)">
                                                <i class="material-icons">delete</i>&nbsp;Eliminar
                                            </span>
                                        </td>
                                    </span>
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
                <div class="modal fade" tabindex="-1" role="dialog" id="agregar_espacio">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #2387FF; color: #fff">
                                <h4 class="modal-title">Guardar Espacio</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                        aria-hidden="true" @click="salir">x</span></button>
                            </div>
                            <div class="modal-body" align="center">
                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-6">
                                        <label>Nombre:</label><input type="text" placeholder="Nombre" class="form-control"
                                            required> <br>
                                        {{-- <label>Ubicación:</label><input type="text" placeholder="Ubicación"
                                            v-model="ubicacion" class="form-control" required> --}}
                                        <select name="" id="" v-model="ubicacion">
                                            <option value="" disabled="">Seleccione un edificio</option>
                                            <option value="Edificio 1">Edificio 1</option>
                                            <option value="Edificio 2">Edificio 2</option>
                                            <option value="Edificio 3">Edificio 3</option>
                                        </select>
                                    </div>
                                    <div hidden="true" class="col-md-6 col-sm-6 col-xs-6">
                                        {{-- <label>Cupo:</label><input type="text" placeholder="Cupo" v-model="cupo" --}}
                                        {{-- class="form-control" required> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-info"
                                    @click="agregarEspacio()">Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin del modal --}}
        {{-- modal --}}
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="modal fade" tabindex="-1" role="dialog" id="editar_espacio">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <div class="modal-header" style="background: #2387FF; color: #fff">
                                <h4 class="modal-title">Editar Espacio</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                        aria-hidden="true" @click="salir">x</span></button>
                            </div>
                            <div class="modal-body" align="center">
                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-6">
                                        <label>Nombre:</label><input type="text" id="nombre_espacio" placeholder="Nombre"
                                            class="form-control" required>
                                        <br>
                                        {{-- <label>Ubicación:</label><input type="text" id="ubicacion_espacio"
                                            placeholder="Ubicación" v-model="ubicacion" class="form-control" required> --}}
                                        <select id="ubicacion_espacio" required>
                                            <option value="" disabled="">Seleccione un edificio</option>
                                            <option value="Edificio 1">Edificio 1</option>
                                            <option value="Edificio 2">Edificio 2</option>
                                            <option value="Edificio 3">Edificio 3</option>
                                        </select>
                                    </div>
                                    <div hidden="true" class="col-md-6 col-sm-6 col-xs-6">
                                        <label>Cupo:</label><input type="text" id="cupo_espacio" placeholder="Cupo"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn_actualizar"
                                    class="btn btn-outline-success">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fin espacio --}}
@endsection

@push('scripts')
    <script src="js/director/espacios.js"></script>
    <script src="js/director/espacios_dt.js"></script>

@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
<input type="hidden" id="url_espacios" value="{{ url('apiEspacios') }}">
<input type="hidden" id="url_espacios_update" value="{{ url('apiEspacioSolicitud') }}">
