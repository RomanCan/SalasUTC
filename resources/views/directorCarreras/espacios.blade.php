@extends('layouts.masterDirector')

@section('contenido')
    <div id="espacio">
        <div class="row">
            <div class="col-md-12 ">

                <div class="col-md-5">
                    <button class="btn btn-info" @click="showModal"><i class="material-icons">add_location_alt
                        </i>&nbsp;Agregar</button>
                    <input type="text" placeholder="Buscar" v-model="search" class="form-control">
                </div>

                <div class="card">
                    <div class="card-body">
                    {{-- tabla --}}
                        <table class="table table-responsive table table-hove">
                            <thead>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Cupo</th>
                                <td>Opciones</td>
                            </thead>
                            <tbody>
                                <tr v-for="(esp, index) in searchE" v-bind:value="esp.id_espacio">
                                    <td>@{{ esp . nombre }}</td>
                                    <td>@{{ esp . ubicacion }}</td>
                                    <td>@{{ esp . cupo }}</td>
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
                                </tr>
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
                        {{-- @csrf --}}
                        <div class="modal-content">
                            <div class="modal-header" style="background: #2387FF; color: #fff">

                                <h4 class="modal-title" v-if="editar">Editar Espacio</h4>
                                <h4 class="modal-title" v-if="!editar">Guardar Espacio</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                        aria-hidden="true" @click="salir">x</span></button>
                            </div>
                            <div class="modal-body" align="center">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label>Nombre:</label><input type="text" placeholder="Nombre" v-model="nombre"
                                            class="form-control" required>
                                        <label>Ubicación:</label><input type="text" placeholder="Ubicación"
                                            v-model="ubicacion" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label>Cupo:</label><input type="text" placeholder="Cupo" v-model="cupo"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success" @click="actualizarEspacio()"
                                    v-if="editar">Actualizar</button>
                                <button type="submit" class="btn btn-outline-info" @click="agregarEspacio()"
                                    v-if="!editar">Guardar</button>
                                <!-- <button type="submit" class="btn btn-success" @click="salir">Cancelar</button> -->

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
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
