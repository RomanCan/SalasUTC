@extends('layouts.masterDirector')

@section('contenido')
    <div id="solicitudes">
        <div class="row">
            <div class="col-md-12 ">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th>Docente</th>
                        <th>Motivio</th>
                        <th>Detalle</th>
                        <th>Lugar</th>
                        <th>Ubicacion</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Grupo</th>
                        <th>Materia</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="sol in solicitudes" style="text-transform: uppercase">
                            <td>@{{ sol . profesor . tratamiento }} @{{ sol . profesor . nombre }}
                            <td>@{{ sol . titulo_actividad }}</td>
                            <td>@{{ sol . detalle_actividad }}</td>
                            <td>@{{ sol . espacio . nombre }}</td>
                            <td>@{{ sol . espacio . ubicacion }}</td>
                            <td>@{{ sol . fecha_solicitada }}</td>
                            <td>@{{ sol . hora }}</td>
                            <td>@{{ sol . ClaveGrupo }}</td>
                            <td>@{{ sol . asignatura . Nombre }}</td>
                            <td v-if="sol.status === 2">
                                <span style=" color: rgb(0, 187, 0)"> <i class="material-icons">check</i></span>
                            </td>
                            <td v-if="sol.status === 1">
                                <span style=" color: rgb(201, 201, 0)"> <i class="material-icons">hourglass_top</i>
                                </span>
                            </td>
                            <td v-if="sol.status === 0">
                                <span style=" color: red"> <i class="material-icons">close</i>
                                </span>
                            </td>
                            <td v-if="sol.status === 1">
                                <div>
                                    <button class="btn btn-outline-primary" @click="aprobar(sol.id_solicitud)">
                                        <i class="material-icons">done</i>
                                    </button>
                                    <button class="btn btn-outline-danger" @click="rechazar(sol.id_solicitud)">
                                        <i style=" color: red"> <i class="material-icons">highlight_off</i>
                                        </i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="js/director/solicitudes.js"></script>
@endpush

<input type="hidden" name="route" value="{{ url('/') }}">
