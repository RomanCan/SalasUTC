@extends('layouts.masterDocente')
@section('contenido')
<script>
    $(document).ready(function() {
    $('#datatable_teacher_requests').DataTable({
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    });
} );
</script>
    <div id="soli">
        <!-- Button trigger modal -->

        <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Agregar"><i
                class="material-icons">speaker_notes</i>
            &nbsp;Hacer una solicitud
        </button>

        <!-- {{-- modal --}} -->
        <div class="modal fade" id="Agregar" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(242 145 0); color: #fff">
                        <h5 class="modal-title" v-if="editar != true">Nueva Solicitud</h5>
                        <h5 class="modal-title" v-if="editar == true">Editar Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="limpiar()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <!-- {{-- identificar los datos que estan llegando solo de este formulario --}} -->
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Docente</label>
                                        <select name="" id="" v-model="cedula" @change="getClaveGrupo"
                                            class="form-control">
                                            <option v-for="doc in docentes" :value="doc.cedula">
                                                @{{ doc . nombre }}
                                            </option>
                                        </select>

                                    </div>
                                </div><br><br><br><br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave de Grupo</label>
                                        <select name="" id="" class="form-control" v-model="ClaveGrupo"
                                            @change="getDocentesGrupos" class="form-control" v-if="!editar">
                                            <option v-for="d in clavegrupos">
                                                @{{ d . ClaveGrupo }}</option>
                                        </select>
                                        <!-- Para no probocar conflicto -->
                                        <!-- <select name="" id="" class="form-control" v-model="ClaveGrupo" @change="getDocentesGrupos" class="form-control" v-if="editar">
                                                                                                                                                                                                                                                                                                                                                                                                                                    <option v-for="da in dg" >@{{ da . ClaveGrupo }}</option>                                                                                                                                                                                                                            </select> -->
                                        <input type="text" v-model="ClaveGrupo" disabled class="form-control"
                                            v-if="editar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave de Asignatura</label>
                                        <select name="" id="" class="form-control" v-model="ClaveAsig"
                                            @change="getAsignaturas" class="form-control" v-if="!editar">
                                            <option v-for="de in docentesgrupos">
                                                @{{ de . ClaveAsig }}</option>
                                        </select>
                                        <!-- evitar conflicto al actualizar-->
                                        <!-- <select name="" id="" class="form-control" v-model="ClaveAsig" @change="getAsignaturas" class="form-control" v-if="editar">
                                                                                                                                                                                                                                                                                                                                                                                                                        <option v-for="di in dg" >@{{ di . ClaveAsig }}</option>                                                                                                                                                                                                                                                           </select> -->
                                        <input type="text" v-model="ClaveAsig" disabled class="form-control"
                                            v-if="editar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ClaveAsig">Asignatura</label>
                                        <select name="" id="" v-model="asignatura" class="form-control" v-if="!editar">
                                            <option v-for="a in asignaturas">
                                                @{{ a . Nombre }}</option>
                                        </select>
                                        <!-- evitar conflicto con actualizar -->
                                        <input type="text" v-model="asignatura" disabled class="form-control"
                                            v-if="editar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Espacio</label>
                                        <select name="" id="select_espacio" v-model="id_espacio" class="form-control">
                                            <option v-for="e in espacios" :value="e.id_espacio">@{{ e . nombre }} 
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <label for="">Fecha de Solicitud</label>
                                        <input type="date" class="form-control" :value="fecha_solicitud" disabled>
                                        {{-- <input type="date" class="form-control" v-model="fecha_solicitud"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <label for="">Fecha Solicitada</label>
                                        <input type="date" class="form-control" id="requested_date" v-model="fecha_solicitada">
                                        {{-- <select name="" id="" v-model="fecha_solicitada" class="form-control"> --}}
                                        {{-- <option v-for="f in horarios">@{{ f . fecha }}
                                        </option> --}}
                                        {{-- </select> --}}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Hora de inicio</label>
                                        <select name="" id="start_time" v-model="hora_inicio" class="form-control">
                                            <option v-for="h in horarios">
                                                @{{ h . hora_inicio }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Hora de finalización</label>
                                        <select name="" id="" v-model="hora_final" class="form-control">
                                            <option v-for="h in horarios">
                                                @{{ h . hora_final }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <label for="">Titulo de la actividad</label>
                                        <input type="text" class="form-control" v-model="titulo_actividad">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Detalle de la actividad</label>
                                        <input type="text" class="form-control" v-model="detalle_actividad">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cantidad de participantes</label>
                                        <input type="number" class="form-control" v-model="participantes" min="0">

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="agregarSol()"
                            v-if="!editar">Guardar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            @click="actualizarSolicitud(id_solicitud)" v-if="editar">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="limpiar()">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>
        {{-- fin del modal --}}

        <!-- mostrar tabla de solicitud -->
        <div class="card">
            <div class="card-body">
                <!-- {{-- tabla --}} -->
                <table id="datatable_teacher_requests" class="table table-striped table-condensed">
                    <thead class="thead">
                        <th>#</th>
                        <th>Espacio</th>
                        <th>Titulo / Motivo</th>
                        <th>Detalle</th>
                        <th>Asignatura</th>
                        <th>Fecha solicitada</th>
                        <th>Hora de inicio</th>
                        <th>Hora de finalización</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody class="tbody">
                        <tr v-for="(sol,index) in solicitudes">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ sol . espacio . nombre }}</td>
                            <td>@{{ sol . titulo_actividad }}</td>
                            <td>@{{ sol . detalle_actividad }}</td>
                            <td>@{{ sol . asignatura . Nombre }}</td>
                            <td>@{{ sol . fecha_solicitada }}</td>
                            <td>@{{ sol . hora_inicio }}</td>
                            <td>@{{ sol . hora_final }}</td>

                            <td v-if="sol.status === 0">
                                <span
                                    style="background-color: rgb(184, 0, 0); color:white; padding:5px;border-radius: 14px;">Rechazado</span>
                            </td>
                            <td v-if="sol.status === 1">
                                <span
                                    style="background-color: orange; color:white; padding:5px;border-radius: 14px;">Pendiente</span>
                            </td>
                            <td v-if="sol.status === 2">
                                <span
                                    style="background-color: rgb(76, 175, 80); color:white; padding:5px;border-radius: 14px;">Aprobado</span>
                            </td>
                            <td v-if="sol.status === 3">
                                <span
                                    style="background-color: rgb(12, 103, 252); color:white; padding:5px;border-radius: 14px;">Finalizado</span>
                            </td>


                            <td class="" role=" group" v-if="sol.status === 1">
                                <span class="btn btn-success" @click="showSolicitud(sol.id_solicitud)"><i
                                        class="material-icons">mode_edit_outline</i>&nbsp;Editar</span>
                                {{-- &nbsp;

                                    <span class="btn btn-outline-danger" @click="eliminarSolicitud(sol.id_solicitud)"><i
                                            class="material-icons">delete</i>&nbsp;Eliminar</span> --}}

                            </td>

                            {{-- habilitar el cupo --}}
                            <td class="" role=" group" v-if="sol.status === 2">
                                <span class="btn btn-danger" @click="finPractica(sol.id_solicitud)">
                                    Finalizar</span>
                                {{-- &nbsp;

                                    <span class="btn btn-outline-danger" @click="eliminarSolicitud(sol.id_solicitud)"><i
                                            class="material-icons">delete</i>&nbsp;Eliminar</span> --}}

                            </td>
                            <td v-if="sol.status === 3">
                                <span>LA PRÁCTICA SE HA CONCLUIDO CON ÉXITO</span>
                            </td>
                            <td v-if="sol.status === 0">
                                <span>SOLICITUD RECHAZADA</span>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>


@endsection

@push('scripts')
    <script src="js/moment-with-locales.js"></script>
    <script src="js/docente/solicitudes.js"></script>
    <script src="js/docente/validaciones_fechas.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
<input type="hidden" id="reuel_ruta" value="{{ url('/getHorarios') }}">

