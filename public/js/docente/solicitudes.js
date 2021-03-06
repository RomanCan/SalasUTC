var route = document.querySelector("[name=route]").value;
var urlSolicitudes = route + "/" + "apiSolicitudes";
var urlSoliDocentes = route + "/" + "apiSoliDocentes";
var urlDocentesGrupos = route + "/" + "getDocentesGrupos/";
var urlClaveGrupo = route + "/" + "getClaveGrupo/";
var urlAsignaturas = route + "/" + "getAsignaturas/";
var urlEspacios = route + "/" + "apiEspacioSolicitud";
var urlHorarios = route + "/" + "apiHorarios";
var urlDg = route + "/" + "apiDocentesGrupos";
var urlsolicitud_docente = route + "/solicitud_docente";



new Vue({
    el: "#soli",
    // token
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },

    data: {
        clavegrupos: [],
        docentes: [],
        docentesgrupos: [],
        asignaturas: [],
        espacios: [],
        espacio: "",
        horarios: [],
        solicitudes: [],
        errors:[],
        // datos docentes por grupos
        dg: [],
        as: [],
        id_solicitud: "",
        cedula: "",
        ClaveGrupo: "",
        ClaveCarga: "",
        ClaveAsig: "",
        id_espacio: "",
        id_horario: "",
        fecha_solicitud: moment().format("YYYY-MM-DD"),
        fecha_solicitada: "",
        titulo_actividad: "",
        detalle_actividad: "",
        status: 1,
        participantes: "",
        tipo_solicitud: "",
        nombre_docente: "",
        apellidop: "",
        apellidom: "",
        email: "",
        asignatura: "",
        hora_inicio: "",
        hora_final: "",
        // ocultar boton de actualizar
        editar: false,

        // id para finalizar la practica
        id:"",
    },
    created: function () {
        this.getSoliDocentes();
        this.getEspacios();
        this.getHorarios();
        this.getSolicitudes();
        // para crear datos en docentesgrupos
        this.getDg();
    },
    methods: {
        getSolicitudes: function () {
            this.$http.get(urlSolicitudes).then(function (json) {
                this.solicitudes = json.data;
            });
        },

        getSoliDocentes: function () {
            this.$http.get(urlSoliDocentes).then(function (json) {
                this.docentes = json.data;
            });
        },

        getEspacios: function () {
            this.$http.get(urlEspacios).then(function (json) {
                this.espacios = json.data;
            });
        },
        // evento para traer horarios por espacios
        //traemos horarios
        getHorarios() {
            this.$http.get(urlHorarios).then(function (json) {
                this.horarios = json.data;

            }).catch(function(json){

            });
        },
        // evitar conflicto se creo datos de docentesgrupos
        getDg: function () {
            this.$http.get(urlDg).then(function (json) {
                this.dg = json.data;
            });
        },

        // evento docentes por grupo
        getDocentesGrupos(event) {
            var cedula = event.target.value;
            this.$http.get(urlDocentesGrupos + cedula).then(function (json) {
                this.docentesgrupos = json.data;
            });
        },

        // evento docentes por grupo
        getClaveGrupo(event) {
            var cg = event.target.value;
            this.$http.get(urlClaveGrupo + cg).then(function (json) {
                this.clavegrupos = json.data;
            });
        },

        // evento asignaturas
        getAsignaturas(event) {
            var ClaveAsig = event.target.value;
          this.$http.get(urlAsignaturas + ClaveAsig).then(function (json) {
                this.asignaturas = json.data;
            }  );
        },

        // guardar registro de solicitud
        agregarSol: function () {
            // crear un json
            var solicitud = {
                cedula: this.cedula,
                ClaveGrupo: this.ClaveGrupo,
                ClaveAsig: this.ClaveAsig,
                id_espacio: this.id_espacio,
                id_horario:this.id_horario,
                fecha_solicitud: this.fecha_solicitud,
                fecha_solicitada: this.fecha_solicitada,
                titulo_actividad: this.titulo_actividad,
                detalle_actividad: this.detalle_actividad,
                status: this.status,
                participantes: this.participantes,
                tipo_solicitud: this.tipo_solicitud,
                asignatura: this.asignatura,
                // hora_inicio: this.hora_inicio,
                // hora_final: this.hora_final,
            };
            this.$http.post(urlSolicitudes, solicitud)
                .then(function (json) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "??Guardado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    $("#Agregar").modal("hide");
                    $('#datatable_teacher_requests').DataTable().ajax.reload();
                    this.limpiar();
                    this.errors = "";
                })
                .catch(function (error) {
                    if(error.status === 422){
                        this.errors = error.data.errors;
                    }
                });
        },

        // show
        showSolicitud: function (id) {
            this.editar = true;
            this.$http.get(urlSolicitudes + "/" + id).then(function (json) {
                this.id_solicitud = json.data.id_solicitud;
                this.cedula = json.data.cedula;
                this.ClaveGrupo = json.data.ClaveGrupo;
                this.ClaveCarga = json.data.ClaveCarga;
                this.ClaveAsig = json.data.ClaveAsig;
                this.id_espacio = json.data.id_espacio;
                this.id_horario = json.data.id_horario;
                this.fecha_solicitud = json.data.fecha_solicitud;
                this.fecha_solicitada = json.data.fecha_solicitada;
                this.titulo_actividad = json.data.titulo_actividad;
                this.detalle_actividad = json.data.detalle_actividad;
                this.status = json.data.status;
                this.participantes = json.data.participantes;
                this.tipo_solicitud = json.data.tipo_solicitud;
                this.asignatura = json.data.asignatura.Nombre;
                // this.hora_inicio = json.data.hora_inicio;
                // this.hora_final = json.data.hora_final;
                $("#Agregar").modal("show");
            });
        },
        // eliminar Solicitud
        eliminarSolicitud: function (id) {
            Swal.fire({
                title: "No podr??s revertir este cambio!,??Est??s seguro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "S??, b??rralo",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.value) {
                    this.$http
                        .delete(urlSolicitudes + "/" + id)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "??Eliminado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            this.getSolicitudes();
                        })
                        .catch(function (json) {
                            console.log(json);
                        });
                }
            });
        },

        // actualizar solicitud
        actualizarSolicitud: function (id) {
            // crear un json
            var solicitud = {
                cedula: this.cedula,
                ClaveGrupo: this.ClaveGrupo,
                ClaveAsig: this.ClaveAsig,
                id_espacio: this.id_espacio,
                id_horario : this.id_horario,
                fecha_solicitud: this.fecha_solicitud,
                fecha_solicitada: this.fecha_solicitada,
                titulo_actividad: this.titulo_actividad,
                detalle_actividad: this.detalle_actividad,
                status: this.status,
                participantes: this.participantes,
                tipo_solicitud: this.tipo_solicitud,
                asignatura: this.asignatura,
                // hora_inicio: this.hora_inicio,
                // hora_final: this.hora_final,
            };
            console.log(solicitud);
            this.$http
                .patch(urlUpdateSolicitud + "/" + id, solicitud)
                .then(function (json) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "??Actualizado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    // this.getSolicitudes();
                    // this.limpiar();
                    // this.editar = false;
                })
                .catch(function (json) {
                    Swal.fire({
                        icon: "error",
                        title: "??Ha ocurrido un error!",
                        text: "??No deje campos vacios!",
                    });
                    console.log(json);
                });
        },
        limpiar: function () {
            this.id_solicitud = "";
            this.cedula = "";
            this.ClaveGrupo = "";
            this.ClaveAsig = "";
            this.id_espacio = "";
            this.id_horario = "";
            //this.fecha_solicitud = "";
            this.fecha_solicitada = "";
            this.titulo_actividad = "";
            this.detalle_actividad = "";
            this.status = 0;
            this.participantes = "";
            this.tipo_solicitud = "";
            this.asignatura = "";
            this.hora_inicio = "";
            this.hora_final = "";
            this.editar = false;
        },

        // ??rea de habilitar espacio o finalizacion de practica por parte del docente
        finPractica(id) {
            this.$http.get(urlSolicitudes + "/" + id).then(function (json) {
                this.id_solicitud = json.data.id_solicitud;
                this.cedula = json.data.cedula;
                this.id_espacio = json.data.id_espacio;
                this.fecha_solicitud = json.data.fecha_solicitud;
                this.fecha_solicitada = json.data.fecha_solicitada;
                this.fecha_autorizacion = json.data.fecha_autorizacion;
                this.titulo_actividad = json.data.titulo_actividad;
                this.detalle_actividad = json.data.detalle_actividad;
                this.status = json.data.status;
                this.ClaveGrupo = json.data.ClaveGrupo;
                this.ClaveAsig = json.data.ClaveAsig;
                this.hora_inicio = json.data.hora_inicio;
                this.hora_final = json.data.hora_final;
                this.participantes = json.data.participantes;
                this.tipo_solicitud = json.data.tipo_solicitud;
                this.asignatura = json.data.asignatura.Nombre;

                this.id = this.id_solicitud;


            });

            Swal.fire({
                title: "No podr??s revertir este cambio!,??Su Practica ha Finalizado?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "S??, Finalizar",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.value) {
                    var soli = {
                        cedula: this.cedula,
                        ClaveGrupo: this.ClaveGrupo,
                        ClaveAsig: this.ClaveAsig,
                        id_espacio: this.id_espacio,
                        fecha_solicitud: this.fecha_solicitud,
                        fecha_solicitada: this.fecha_solicitada,
                        titulo_actividad: this.titulo_actividad,
                        detalle_actividad: this.detalle_actividad,
                        status: 3,
                        participantes: this.participantes,
                        tipo_solicitud: this.tipo_solicitud,
                        asignatura: this.asignatura,
                        hora_inicio: this.hora_inicio,
                        hora_final: this.hora_final,
                    };

                    this.$http
                        .patch(urlSolicitudes + "/" + id, soli)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "??Ha Finalizado con ??xito!",
                                showConfirmButton: false,
                                timer: 2000,
                            });

                            this.getSolicitudes();

                        })
                        .catch(function (json) {
                            console.log(json);
                        });
                }
            });
        },
    },


});
