@extends('layouts.masterDocente')

@section('contenido')


    <div id="soli">



        <!-- probando vue  -->
        <!-- {{-- @{{n}} --}} -->

        <!-- {{-- Campos de formulario para envio de email funcionando --}} -->
        <!-- <h3>Formulario de contacto</h3>
                                                                                                                                            <form action={{ url('contact') }} method="POST">
                                                                                                                                                @csrf
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="nombre">Docente</label>
                                                                                                                                                     <input name="docente" type="text" class="form-control" placeholder="Docente" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                     <label for="email">Email</label>
                                                                                                                                                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                                                                                                                                                 </div>
                                                                                                                                                                

                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="director">Nombre Director</label>
                                                                                                                                                    <input name="director" type="text" class="form-control" placeholder="Nombre del director" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="cargo">Cargo</label>
                                                                                                                                                    <input name="cargo" type="text" class="form-control" placeholder="Cargo" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="fecha">Fecha</label>
                                                                                                                                                     <input name="fecha" type="date" class="form-control" placeholder="Fecha" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="laboratorio">Laboratorio</label>
                                                                                                                                                    <input name="laboratorio" type="text" class="form-control" placeholder="Laboratorio" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label for="motivo">Motivo</label>
                                                                                                                                                    <input name="motivo" type="text" class="form-control" placeholder="Motivo" required>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <button type="submit" id='btn-contact' class="btn btn-success">Enviar</button>
                                                                                                                                                 </div>
                                                                                                                                            </form>  -->

        <!-- {{-- Fin de envio de email --}} -->



        <!-- {{-- modal --}} -->
        <!-- Button trigger modal -->

        <button type="submit" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#Agregar"><i
                class="material-icons">speaker_notes</i>
            &nbsp;Hacer una solicitud
        </button>

        <!-- Modal -->
        <div class="modal fade" id="Agregar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #2387FF; color: #fff">
                        <h5 class="modal-title">Nueva Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="limpiar()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="sol">
                        <form action="">
                            <!-- {{-- identificar los datos que estan llegando solo de este formulario --}} -->
                            @csrf
                            <!-- @{{ n }} -->



                            <div class="form-group">
                                <label for="">Docente</label>
                                <select name="" id="" v-model="cedula" @change="getClaveGrupo" class="form-control">
                                    <option v-for="doc in docentes" :value="doc.cedula">@{{ doc . nombre }}</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Clave de Grupo</label>
                                <select name="" id="" class="form-control" v-model="ClaveGrupo"
                                    @change="getDocentesGrupos" class="form-control" v-if="!editar">
                                    <option v-for="d in clavegrupos">@{{ d . ClaveGrupo }}</option>
                                </select>
                                <!-- Para no probocar conflicto -->
                                <!-- <select name="" id="" class="form-control" v-model="ClaveGrupo" @change="getDocentesGrupos" class="form-control" v-if="editar">
                                                                                                                                                                    <option v-for="da in dg" >@{{ da . ClaveGrupo }}</option>
                                                                                                                                                                  </select> -->
                                <input type="text" v-model="ClaveGrupo" disabled class="form-control" v-if="editar">



                            </div>
                            <div class="form-group">
                                <label for="">Clave de Asignatura</label>
                                <select name="" id="" class="form-control" v-model="ClaveAsig" @change="getAsignaturas"
                                    class="form-control" v-if="!editar">
                                    <option v-for="de in docentesgrupos">@{{ de . ClaveAsig }}</option>
                                </select>
                                <!-- evitar conflicto al actualizar-->
                                <!-- <select name="" id="" class="form-control" v-model="ClaveAsig" @change="getAsignaturas" class="form-control" v-if="editar">
                                                                                                                                                                    <option v-for="di in dg" >@{{ di . ClaveAsig }}</option>
                                                                                                                                                                  </select> -->
                                <input type="text" v-model="ClaveAsig" disabled class="form-control" v-if="editar">
                            </div>
                            <div class="form-group">
                                <label for="ClaveAsig">Asignatura</label>
                                <select name="" id="" v-model="asignatura" class="form-control" v-if="!editar">
                                    <option v-for="a in asignaturas">@{{ a . Nombre }}</option>
                                </select>
                                <!-- evitar conflicto con actualizar -->
                                <input type="text" v-model="asignatura" disabled class="form-control" v-if="editar">
                            </div>

                            <div class="form-group">
                                <label for="">Espacio</label>
                                <select name="" id="" v-model="id_espacio" class="form-control">
                                    <option v-for="e in espacios" :value="e.id_espacio">@{{ e . nombre }}</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">Fecha de Solicitud</label>
                                <input type="date" class="form-control" v-model="fecha_solicitud">

                            </div>
                            <div class="form-group">
                                <label for="">Fecha Solicitada</label>
                                <select name="" id="" v-model="fecha_solicitada" class="form-control">
                                    <option v-for="f in horarios">@{{ f . fecha }}</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Hora Solicitada</label>
                                <select name="" id="" v-model="hora" class="form-control">
                                    <option v-for="h in horarios">@{{ h . horario }}</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Titulo de la actividad</label>
                                <input type="text" class="form-control" v-model="titulo_actividad">

                            </div>
                            <div class="form-group">
                                <label for="">Detalle de la actividad</label>
                                <input type="text" class="form-control" v-model="detalle_actividad">

                            </div>
                            <div class="form-group">
                                <label for="">Cantidad de participantes</label>
                                <input type="number" class="form-control" v-model="participantes" min="0">

                            </div>
                            <div class="form-group">
                                <label for="">Tipo de solicitud</label>
                                <input type="text" class="form-control" v-model="tipo_solicitud">

                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal" @click="agregarSol()"
                            v-if="!editar">Guardar</button>
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal"
                            @click="actualizarSolicitud(id_solicitud)" v-if="editar">Actualizar</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"
                            @click="limpiar()">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- {{-- fin modal --}} -->

        <br><br><br>

        <!-- mostrar tabla de solicitud -->
        <div class="row">
            <div class="col-md-12 ">

                <!-- {{-- tabla --}} -->
                <table class="table table-responsive table table-hove">
                    <thead>
                        <th>Id</th>
                        <th>Cedula</th>
                        <th>Espacio</th>
                        <th>Estado</th>
                        <th>Fecha de Solicitud</th>
                        <td>Opciones</td>
                    </thead>
                    <tbody>
                        <tr v-for="sol in solicitudes">
                            <td>@{{ sol . id_solicitud }}</td>
                            <td>@{{ sol . cedula }}</td>
                            <td>@{{ sol . espacio . nombre }}</td>
                            <td>@{{ sol . status }}</td>
                            <td>@{{ sol . fecha_solicitud }}</td>
                            <span>
                                <td class="" role=" group">
                                    <span class="btn btn-outline-success" @click="showSolicitud(sol.id_solicitud)"><i
                                            class="material-icons">mode_edit_outline</i>&nbsp;Editar</span>
                                    &nbsp;

                                    <span class="btn btn-outline-danger" @click="eliminarSolicitud(sol.id_solicitud)"><i
                                            class="material-icons">delete</i>&nbsp;Eliminar</span>

                                </td>
                            </span>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection

@push('scripts')

    <script src="js/vue-resource.js"></script>

    <script src="js/docente/solicitudes.js"></script>

@endpush
<input type="hidden" name="route" value="{{ url('/') }}">
