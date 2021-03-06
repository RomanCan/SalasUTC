@extends('layouts.masterDirector')
@section('contenido')
    <div id="solicitudes">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-body">
                        <div v-if="solicitudes == ''">
                            <h4><b>No han realizado solicitudes</b></h4>
                        </div>
                        <table id="dt_admin_solicitudes" class="data-table table-hover">
                            <thead>
                                <th>Docente</th>
                                <th>Materia</th>
                                <th>Titulo/Motivio</th>
                                <th>Detalle</th>
                                <th>Lugar</th>
                                <th>Fecha solicitada</th>
                                <th>Hora de inicio</th>
                                <th>Hora de finalización</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                {{-- <tr v-for="sol in solicitudes" style="text-transform: uppercase">
                                    <td>@{{ sol . profesor . tratamiento }} @{{ sol . profesor . nombre }}
                                    <td>@{{ sol . ClaveGrupo }} @{{ sol . asignatura . Nombre }}</td>
                                    <td>@{{ sol . titulo_actividad }}</td>
                                    <td>@{{ sol . detalle_actividad }}</td>
                                    <td>@{{ sol . espacio . nombre }}</td>
                                    <td>@{{ sol . fecha_solicitada }}</td>
                                    <td>@{{ sol . hora_inicio }}</td>
                                    <td>@{{ sol . hora_final }}</td>

                                    <td v-if="sol.status === 2">
                                        <span style=" color: rgb(0, 187, 0)"> <i class="material-icons">check</i></span>
                                    </td>
                                    <td v-if="sol.status === 1">
                                        <span style=" color: rgb(201, 201, 0)"> <i
                                                class="material-icons">hourglass_top</i></span>
                                    </td>
                                    <td v-if="sol.status === 0">
                                        <span style=" color: red"> <i class="material-icons">close</i></span>
                                    </td>
                                    ÁREA DE NUEVO STATUS (FINALIZADO)
                                    <td v-if="sol.status === 3">
                                        <span style=" color: rgb(0, 102, 255)"> <i class="material-icons">verified</i></span>
                                    </td>
                                    <td v-if="sol.status === 1 && sol.espacio.cupo === 1">
                                        <div>
                                            <button class="btn btn-success btn-sm" @click="aprobar(sol.id_solicitud)">
                                                <i class="material-icons">done</i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" @click="rechazar(sol.id_solicitud)">
                                                <i class="material-icons">highlight_off</i>
                                            </button>
                                        </div>
                                    </td>
                                    <td v-if="sol.status === 0">
                                        <span>HAZ RECHAZADO LA SOLICITUD</span>
                                    </td>
                                    <td v-if="sol.status === 2">
                                        <span>ESPACIO OCUPADO</span>
                                    </td>
                                    <td v-if="sol.status === 3">
                                        <span>LA PRÁCTICA EN EL ESPACIO SE HA CONCLUIDO CON ÉXITO</span>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="js/director/solicitudes.js"></script>
    <script src="js/director/solicitudes_dt.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
<input type="hidden" id="url_solicitud" value="{{ url('/apiSoliDirector') }}">
<input type="hidden" id="url_solicitud_patch" value="{{ url('/apiUpdate') }}">
