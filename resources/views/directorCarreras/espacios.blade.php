@extends('layouts.masterDirector')

@section('contenido')
    <div id="espacio">
        <div class="row">
            <div class="col-md-12 ">

                <div class="col-md-5">
                    <button class="btn btn-outline-primary" @click="showModal">Agregar</button>
                    <input type="text" placeholder="Buscar" v-model="search" class="form-control">
                </div>


                {{-- tabla --}}
                <table class="table table-responsive table table-hove">
                    <thead>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                        <th>Cupo</th>
                        <td>Opciones</td>
                    </thead>
                    <tbody>
                        <tr v-for="(esp, index) in searchE" v-bind:value="esp.id_espacio">
                            <td>@{{ esp . nombre }}</td>
                            <td>@{{ esp . ubicacion }}</td>
                            <td>@{{ esp . cupo }}</td>
                            <span>
                                <td class="btn-group" role="group">
                                    <span class="btn btn-outline-success" @click="editarEspacio(esp.id_espacio)"><i
                                            class="fas fa-edit"></i></span>

                                    <span class="btn btn-outline-danger" @click="eliminarEspacio(esp.id_espacio)"><i
                                            class="fas fa-trash"></i></span>
                                </td>
                            </span>
                        </tr>
                    </tbody>
                </table>
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
                                        <label>Ubicacion</label><input type="text" placeholder="Ubicacion"
                                            v-model="ubicacion" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label>Cupo:</label><input type="text" placeholder="Cupo" v-model="cupo"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary" @click="actualizarEspacio()"
                                    v-if="editar">Actualizar</button>
                                <button type="submit" class="btn btn-outline-primary" @click="agregarEspacio()"
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