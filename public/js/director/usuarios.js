var route = document.querySelector("[name=route]").value;
var UrlUsuarios = route + "/apiUsuarios";
var UrlDocentes = route + "/apiDocentes";
var UserName = route + "/username";
new Vue({
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },
    el: "#usuario",
    data: {
        docentes: [],
        usuarios: [],

        cedula: "",
        i_cedula: "",

        id_rol: "",
        nombre: "",
        apellidop: "",
        apellidom: "",
        nivelestudio: "",
        profesion: "",
        tratamiento: "",
        activo: "",
        foto: "",
        usuario: "",
        password: "",
        email: "",
        errors:[],

        editar: false,
        editarInfo: false,
    },
    created() {
        this.getUsuarios();
        this.getDocentes();
    },
    methods: {
        getUsuarios: function () {
            this.$http.get(UrlUsuarios).then(function (json) {
                this.usuarios = json.data;
            });
        },
        getDocentes: function () {
            this.$http.get(UrlDocentes).then(function (json) {
                this.docentes = json.data;
            });
        },
        showModal: function () {
            $("#agregar_user").modal("show");
        },
        editarI: function (id) {
            this.$http.get(UrlDocentes + "/" + id).then(function (json) {
                this.id_rol = json.data.id_rol;
                this.nombre = json.data.nombre;
                this.apellidop = json.data.apellidop;
                this.apellidom = json.data.apellidom;
                this.nivelestudio = json.data.nivelestudio;
                this.profesion = json.data.profesion;
                this.tratamiento = json.data.tratamiento;
                this.activo = json.data.activo;
                this.foto = json.data.foto;
                this.usuario = json.data.usuario;
                this.password = json.data.password;
                this.email = json.data.email;
                this.i_cedula = json.data.cedula;
                this.editarInfo = true;
            });
        },
        guardar: function () {
            var doc = {
                id_rol: this.id_rol,
                nombre: this.nombre,
                apellidop: this.apellidop,
                apellidom: this.apellidom,
                nivelestudio: this.nivelestudio,
                profesion: this.profesion,
                tratamiento: this.tratamiento,
                activo: this.activo,
                foto: this.foto,
                usuario: this.usuario,
                password: this.password,
                email: this.email,
            };

            // Swal.fire({
            //     title: "No podrás revertir este cambio!,¿Estás seguro?",
            //     icon: "warning",
            //     showCancelButton: true,
            //     confirmButtonColor: "#3085d6",
            //     cancelButtonColor: "#d33",
            //     confirmButtonText: "Sí, guardar",
            //     cancelButtonText: "No, cancelar",
            // })
            // .then((result) => {
            //     if (result.value) {
                    this.$http
                        .patch(UrlDocentes + "/" + this.i_cedula, doc)
                        .then(function (json) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Guardado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            this.enviarEmail();
                            this.salir();
                            window.location.reload();
                        }).catch(function(error){
                            if(error.status === 422){
                                this.errors = error.data.errors;
                            }
                        });
                // }
            // }
            // );
        },
        enviarEmail: function () {
            var user = {
                nombre: this.nombre,
                apellidop: this.apellidop,
                apellidom: this.apellidom,
                tratamiento: this.tratamiento,
                email: this.email,
                usuario: this.usuario,
                password: this.password,
            };
            this.$http
                .post(UserName, user)
                .then(function () {})
                .catch(function () {});
        },
        salir: function () {
            this.errors = "";
            $("#agregar_user").modal("hide");
            this.cedula = "";
            this.id_rol = "";
            this.nombre = "";
            this.apellidop = "";
            this.apellidom = "";
            this.nivelestudio = "";
            this.profesion = "";
            this.tratamiento = "";
            this.activo = "";
            this.foto = "";
            this.usuario = "";
            this.password = "";
            this.email = "";
            this.i_cedula = "";
            this.editarInfo = false;
        },
    },
});
