var route = document.querySelector("[name=route]").value;
var UrlEspacio = route + "/apiEspacioSolicitud";
new Vue({
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },
    el: "#espacio",
    data: {
        errors: [],
        espacio: [],
        id_espacio: "",
        id_e: "",
        nombre: "",
        ubicacion: "",
        cupo: "",
        editar: false,
        search: "",
    },
    created: function () {
        this.getEspacio();
    },
    methods: {
        getEspacio: function () {
            this.$http.get(UrlEspacio).then(function (json) {
                this.espacio = json.data;
            });
        },
        showModal: function () {
            $("#agregar_espacio").modal("show");
        },
        agregarEspacio: function () {
            var e = {
                nombre: this.nombre,
                ubicacion: this.ubicacion,
                cupo: 1,
            };
            this.$http
                .post(UrlEspacio, e)
                .then(function (json) {
                    $("#agregar_espacio").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Guardado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    $("#dt_admin_espacios").DataTable().ajax.reload();
                    this.salir();
                    this.errors = "";
                })
                .catch(function (error) {
                    if (error.status === 422) {
                        this.errors = error.data.errors;
                    }
                });
        },
        editarEspacio: function (id) {
            this.editar = true;
            this.$http.get(UrlEspacio + "/" + id).then(function (json) {
                this.nombre = json.data.nombre;
                this.ubicacion = json.data.ubicacion;
                this.cupo = json.data.cupo;
                this.id_e = json.data.id_espacio;
                $("#agregar_espacio").modal("show");
            });
        },
        actualizarEspacio: function () {
            var espac = {
                nombre: this.nombre,
                ubicacion: this.ubicacion,
                cupo: this.cupo,
            };
            console.log(espac);
            this.$http
                .put(UrlEspacio + "/" + this.id_espacio, espac)
                .then(function () {
                    $("#agregar_espacio").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Actualizado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    salir();
                })
                .catch(function (error) {
                    if (error.status === 422) {
                        this.errors = error.data.errors;
                    }
                    // location.reload();
                });
        },
        eliminarEspacio: function (id) {
            Swal.fire({
                title: "No podrás revertir este cambio!,¿Estás seguro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, bórralo",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.value) {
                    this.$http
                        .delete(UrlEspacio + "/" + id)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Eliminado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            this.getEspacio();
                        })
                        .catch(function (json) {});
                }
            });
        },
        salir: function () {
            this.editar = false;
            this.nombre = "";
            this.ubicacion = "";
            this.cupo = "";
        },
    },
    computed: {
        searchE: function () {
            return this.espacio.filter((espac) => {
                return (
                    espac.nombre
                        .toLowerCase()
                        .match(this.search.trim().toLowerCase()) ||
                    espac.ubicacion
                        .toLowerCase()
                        .match(this.search.trim().toLowerCase()) ||
                    espac.cupo
                        .toLowerCase()
                        .match(this.search.trim().toLowerCase())
                );
            });
        },
    },
});
