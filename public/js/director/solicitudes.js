var route = document.querySelector("[name=route]").value;
var soliDirect = route + "/apiSoliDirector";
var varAceptar = route + "/aceptar_soli";
var varRechazar = route + "/rechazar_soli";
new Vue({
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },
    el: "#solicitudes",
    data: {
        solicitudes: [],
        id_solicitud: "",
        cedula: "",
        id_espacio: "",
        fecha_solicitud: "",
        fecha_solicitada: "",
        fecha_autorizacion: "",
        titulo_actividad: "",
        detalle_actividad: "",
        status: "",
        ClaveGrupo: "",
        ClaveAsig: "",
        participantes: "",
        tipo_solicitud: "",
        hora_inicio: "",
        hora_final: "",
        asignatura: "",
        id: "",
        aprobado: 2,
        rechazado: 0,
        profesor: "",
        email: "",
        espacio: "",
        ubicacion: "",
        materia: "",
        profesor_apellidop: "",
        profesor_apellidom: "",
        nombre_asignatura: "",
    },
    created() {
        this.getSoli();
    },
    methods: {
        getSoli() {
            this.$http.get(soliDirect).then(function (json) {
                this.solicitudes = json.data;
            });
        },
        aprobar(id) {
            this.$http.get(soliDirect + "/" + id).then(function (json) {
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
                this.tipo_solicitud = json.data.tipo;

                this.id = this.id_solicitud;

                this.nombre_asignatura = json.body.asignatura.Nombre;
                this.espacio = json.body.espacio.nombre;
                this.ubicacion = json.body.espacio.ubicacion;
                this.profesor = json.body.profesor.nombre;
                this.profesor_apellidom = json.data.profesor.apellidom;
                this.profesor_apellidop = json.data.profesor.apellidop;
                this.email = json.data.profesor.email;
            });

            Swal.fire({
                title: "No podrás revertir este cambio!,¿Estás seguro de aceptar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, aceptar",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.value) {
                    var soli = {
                        cedula: this.cedula,
                        id_espacio: this.id_espacio,
                        fecha_solicitud: this.fecha_solicitud,
                        fecha_solicitada: this.fecha_solicitada,
                        fecha_autorizacion: this.fecha_autorizacion,
                        titulo_actividad: this.titulo_actividad,
                        detalle_actividad: this.detalle_actividad,
                        ClaveGrupo: this.ClaveGrupo,
                        ClaveAsig: this.ClaveAsig,
                        participantes: this.participantes,
                        tipo_solicitud: this.tipo_solicitud,
                        hora_inicio: this.hora_inicio,
                        hora_final: this.hora_final,
                        status: this.aprobado,
                        nombre_asignatura: this.nombre_asignatura,
                        ubicacion: this.ubicacion,
                        espacio: this.espacio,
                        nombre: this.profesor,
                        apellidop: this.profesor_apellidop,
                        apellidom: this.profesor_apellidom,
                        email: this.email,
                    };

                    this.$http
                        .patch(soliDirect + "/" + id, soli)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Ha sido aprobado!",
                                showConfirmButton: false,
                                timer: 2000,
                            });

                            this.getSoli();
                            this.aceptar_soli();
                        })
                        .catch(function (json) {
                            console.log(json);
                        });
                }
            });
        },
        aceptar_soli() {
            var solicitud = {
                cedula: this.cedula,
                id_espacio: this.id_espacio,
                fecha_solicitud: this.fecha_solicitud,
                fecha_solicitada: this.fecha_solicitada,
                fecha_autorizacion: this.fecha_autorizacion,
                titulo_actividad: this.titulo_actividad,
                detalle_actividad: this.detalle_actividad,
                ClaveGrupo: this.ClaveGrupo,
                ClaveAsig: this.ClaveAsig,
                participantes: this.participantes,
                tipo_solicitud: this.tipo_solicitud,
                hora_inicio: this.hora_inicio,
                hora_final: this.hora_final,
                status: this.aprobado,

                asignatura: this.nombre_asignatura,
                nombre: this.profesor,
                apellidop: this.profesor_apellidop,
                apellidom: this.profesor_apellidom,
                email: this.email,
                espacio: this.espacio,
                ubicacion: this.ubicacion,
            };
            this.$http.post(varAceptar, solicitud).then(function (json) {
                console.log(json);
            });
            return console.log(solicitud);
        },
        rechazar(id) {
            this.$http.get(soliDirect + "/" + id).then(function (json) {
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
                this.tipo_solicitud = json.data.tipo;

                this.id = this.id_solicitud;

                this.nombre_asignatura = json.body.asignatura.Nombre;
                this.espacio = json.body.espacio.nombre;
                this.ubicacion = json.body.espacio.ubicacion;
                this.profesor = json.body.profesor.nombre;
                this.profesor_apellidom = json.data.profesor.apellidom;
                this.profesor_apellidop = json.data.profesor.apellidop;
                this.email = json.data.profesor.email;
            });

            Swal.fire({
                title: "No podrás revertir este cambio!,¿Estás seguro de cancelar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, cancelar",
                cancelButtonText: "No, salir",
            }).then((result) => {
                if (result.value) {
                    var soli = {
                        cedula: this.cedula,
                        id_espacio: this.id_espacio,
                        fecha_solicitud: this.fecha_solicitud,
                        fecha_solicitada: this.fecha_solicitada,
                        fecha_autorizacion: this.fecha_autorizacion,
                        titulo_actividad: this.titulo_actividad,
                        detalle_actividad: this.detalle_actividad,
                        ClaveGrupo: this.ClaveGrupo,
                        ClaveAsig: this.ClaveAsig,
                        participantes: this.participantes,
                        tipo_solicitud: this.tipo_solicitud,
                        hora_inicio: this.hora_inicio,
                        hora_final: this.hora_final,
                        status: this.rechazado,
                        nombre_asignatura: this.nombre_asignatura,
                        ubicacion: this.ubicacion,
                        espacio: this.espacio,
                        nombre: this.profesor,
                        apellidop: this.profesor_apellidop,
                        apellidom: this.profesor_apellidom,
                        email: this.email,
                    };

                    this.$http
                        .patch(soliDirect + "/" + id, soli)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Ha sido cancelado!",
                                showConfirmButton: false,
                                timer: 2000,
                            });

                            this.getSoli();
                            this.rechazar_soli();
                        })
                        .catch(function (json) {
                            console.log(json);
                        });
                }
            });
        },
        rechazar_soli() {
            var solicitud = {
                cedula: this.cedula,
                id_espacio: this.id_espacio,
                fecha_solicitud: this.fecha_solicitud,
                fecha_solicitada: this.fecha_solicitada,
                fecha_autorizacion: this.fecha_autorizacion,
                titulo_actividad: this.titulo_actividad,
                detalle_actividad: this.detalle_actividad,
                ClaveGrupo: this.ClaveGrupo,
                ClaveAsig: this.ClaveAsig,
                participantes: this.participantes,
                tipo_solicitud: this.tipo_solicitud,
                hora_inicio: this.hora_inicio,
                hora_final: this.hora_final,
                status: this.aprobado,
                asignatura: this.nombre_asignatura,
                nombre: this.profesor,
                apellidop: this.profesor_apellidop,
                apellidom: this.profesor_apellidom,
                email: this.email,
                espacio: this.espacio,
                ubicacion: this.ubicacion,
            };
            this.$http.post(varRechazar, solicitud).then(function (json) {
                console.log(json);
            });
            return console.log(solicitud);
        },
    },
});
