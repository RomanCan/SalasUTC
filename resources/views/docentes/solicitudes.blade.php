@extends('layouts.masterDocente')
@section('contenido')
    <div id="soli">
        <!-- Button trigger modal -->

        <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Agregar"><i
                class="material-icons">speaker_notes</i>
            &nbsp;Hacer una solicitud
        </button>
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
                        {{-- <tr v-for="(sol,index) in solicitudes">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ sol . espacio . nombre }}</td>
                            <td>@{{ sol . titulo_actividad }}</td>
                            <td>@{{ sol . detalle_actividad }}</td>
                            <td>@{{ sol . asignatura . Nombre }}</td>
                            <td>@{{ sol . fecha_solicitada }}</td>
                            <td>@{{ sol . horarios . hora_inicio }}</td>
                            <td>@{{ sol . horarios . hora_final }}</td>

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


                            </td>


                            <td class="" role=" group" v-if="sol.status === 2">
                                <span class="btn btn-danger" @click="finPractica(sol.id_solicitud)">
                                    Finalizar</span>


                            </td>
                            <td v-if="sol.status === 3">
                                <span>LA PRÁCTICA SE HA CONCLUIDO CON ÉXITO</span>
                            </td>
                            <td v-if="sol.status === 0">
                                <span>SOLICITUD RECHAZADA</span>
                            </td>

                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
        <!-- {{-- modal --}} -->
        <div class="modal fade" id="Agregar" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(242 145 0); color: #fff">
                        <h5 class="modal-title">Nueva Solicitud</h5>
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
                                        <div v-if="errors && errors.cedula">
                                            <p class="text-danger">@{{ errors . cedula[0] }}</p>
                                        </div>
                                    </div>
                                </div><br><br><br><br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave de Grupo</label>
                                        <select name="" id="" class="form-control" v-model="ClaveGrupo"
                                            @change="getDocentesGrupos" class="form-control" v-if="!editar">
                                            <option v-for="d in clavegrupos" :value="d.ClaveGrupo">
                                                @{{ d . ClaveGrupo }}</option>
                                        </select>
                                        <div v-if="errors && errors.ClaveGrupo">
                                            <p class="text-danger">@{{ errors . ClaveGrupo[0] }}</p>
                                        </div>
                                        <!-- Para no probocar conflicto -->
                                        {{-- <select name="" id="" class="form-control" v-model="ClaveGrupo"
                                            @change="getDocentesGrupos" class="form-control" v-if="editar">
                                            <option v-for="da in dg">@{{ da . ClaveGrupo }}</option>
                                        </select> --}}
                                        {{-- <input type="text" v-model="ClaveGrupo" disabled class="form-control"
                                            v-if="editar"> --}}
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
                                        <div v-if="errors && errors.ClaveAsig">
                                            <p class="text-danger">@{{ errors . ClaveAsig[0] }}</p>
                                        </div>
                                        <!-- evitar conflicto al actualizar-->
                                        {{-- <select name="" id="" class="form-control" v-model="ClaveAsig"
                                            @change="getAsignaturas" class="form-control" v-if="editar">
                                            <option v-for="di in dg">@{{ di . ClaveAsig }}</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ClaveAsig">Asignatura</label>
                                        <select name="" id="" v-model="asignatura" class="form-control" v-if="!editar">
                                            <option v-for="a in asignaturas">
                                                @{{ a . Nombre }}</option>
                                        </select>
                                        <div v-if="errors && errors.asignatura">
                                            <p class="text-danger">@{{ errors . asignatura[0] }}</p>
                                        </div>
                                        <!-- evitar conflicto con actualizar -->
                                        {{-- <input type="text" v-model="asignatura" disabled class="form-control"
                                            v-if="editar"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Espacio</label>
                                        <select name="id_espacio" id="" v-model="id_espacio" class="form-control">
                                            <option v-for="e in espacios" :value="e.id_espacio">@{{ e . nombre }}
                                            </option>
                                        </select>
                                        <div v-if="errors && errors.id_espacio">
                                            <p class="text-danger">@{{ errors . id_espacio[0] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha de Solicitud</label><br>
                                        <input type="date" class="form-control" v-model="fecha_solicitud" disabled>
                                        <div v-if="errors && errors.fecha_solicitud">
                                            <p class="text-danger">@{{ errors . fecha_solicitud[0] }}</p>
                                        </div>
                                        {{-- <input type="date" class="form-control" v-model="fecha_solicitud"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha Solicitada</label> <br>
                                        <input type="date" class="form-control" id="" v-model="fecha_solicitada">
                                        <div v-if="errors && errors.fecha_solicitada">
                                            <p class="text-danger">@{{ errors . fecha_solicitada[0] }}</p>
                                        </div>
                                        {{-- <select name="" id="" v-model="fecha_solicitada" class="form-control"> --}}
                                        {{-- <option v-for="f in horarios">@{{ f . fecha }}
                                        </option> --}}
                                        {{-- </select> --}}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Horarios</label>
                                            <select name="" id="" class="form-control" v-model="id_horario">
                                                <option v-for="h in horarios" :value="h.id_horario">
                                                    @{{ h . hora_inicio }}-@{{ h . hora_final }}
                                                </option>
                                            </select>
                                            <div v-if="errors && errors.id_horario">
                                                <p class="text-danger">@{{ errors . id_horario[0] }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Hora de finalización</label>
                                        <select name="" id="" v-model="hora_final" class="form-control">
                                            <option v-for="h in horarios">
                                                @{{ h . hora_final }}</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Titulo de la actividad</label> <br>
                                        <input type="text" class="form-control" v-model="titulo_actividad">
                                        <div v-if="errors && errors.titulo_actividad">
                                            <p class="text-danger">@{{ errors . titulo_actividad[0] }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Detalle de la actividad</label> <br>
                                        <input type="text" class="form-control" v-model="detalle_actividad">
                                        <div v-if="errors && errors.detalle_actividad">
                                            <p class="text-danger">@{{ errors . detalle_actividad[0] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cantidad de participantes</label> <br>
                                        <input type="number" class="form-control" v-model="participantes" min="0">
                                        <div v-if="errors && errors.participantes">
                                            <p class="text-danger">@{{ errors . participantes[0] }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="agregarSol()">Guardar</button>

                    </div>
                </div>
            </div>

        </div>
        <!--{{-- fin del modal --}}-->

        <!-- {{-- modal editar --}} -->
        <div class="  modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(242 145 0); color: #fff">
                        <h5 class="modal-title">Editar Solicitud</h5>
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
                                        <select name="" id="select_docente" class="form-control"> </select>

                                    </div>
                                </div><br><br><br><br>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave de Grupo</label>
                                        <select name="" id="select_clave_grupo" class="form-control"
                                            class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Clave de Asignatura</label>
                                        <select id="select_clave_asignatura" class="form-control"
                                            class="form-control"></select>

                                        {{-- <select id="select_clave_asignatura" class="form-control"
                                            class="form-control"></select> --}}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ClaveAsig">Asignatura</label>
                                        <select name="" id="select_nombre_asignatura" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Espacio</label>
                                        <select name="" id="select_espacio" class="form-control select_espacio">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha de Solicitud</label><br>
                                        <input type="text" class="form-control" id="fecha_solicitud" disabled>

                                        {{-- <input type="text" class="form-control" id="fecha_solicitud" disabled> --}}

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha Solicitada</label><br>
                                        <input type="date" class="form-control" id="requested_date"
                                            class="requested_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Horarios</label>
                                        <select name="" id="select_horario" class="form-control start_time">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Titulo de la actividad</label><br>
                                        <input type="text" class="form-control" id="titulo_actividad">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Detalle de la actividad</label><br>
                                        <input type="text" class="form-control" id="detalle_actividad">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cantidad de participantes</label><br>
                                        <input type="number" class="form-control" id="cantidad_participantes" min="0">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="limpiar()">
                            Cerrar</button>

                    </div>
                </div>
            </div>

        </div>
        <!--{{-- fin del modal --}}-->



    </div>
@endsection

@push('scripts')
    <script src="js/moment-with-locales.js"></script>
    <script src="js/docente/solicitudes.js"></script>
    <script src="js/docente/solicitudes_dt.js"></script>
    <script src="js/docente/validaciones_fechas.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
<input type="hidden" id="horarios" value="{{ url('/getHorarios') }}">
<input type="hidden" id="url_ver_solicitud" value="{{ url('/apiSolicitudes') }}">
<input type="hidden" id="url_get_clave_grupo" value="{{ url('/getClaveGrupo') }}">
<input type="hidden" id="url_get_clave_asignatura" value="{{ url('/getDocentesGrupos') }}">
<input type="hidden" id="url_get_nombre_asignatura" value="{{ url('/getAsignaturas') }}">
<input type="hidden" id="url_get_espacios" value="{{ url('/apiEspacioSolicitud') }}">
{{-- <input type="hidden" id="url_get_espacios" value="{{ url('/apiEspacioSolicitud') }}"> --}}
<input type="hidden" id="url_finish_espacio" value="{{ url('apiUpdateSolicitudDocente') }}">
