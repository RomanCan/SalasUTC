//= require public/docente/validaciones_fecha.js
var cedula_profesor = null;
$(function () {
    var table = $("#datatable_teacher_requests").DataTable({
        processing: true,
        //   serverSide: true,
        //ajax: "{{ url('apiSolicitudes') }}",
        ajax: $("#url_ver_solicitud").val(),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "nombre_espacio",
                name: "nombre_espacio",
            },
            {
                data: "titulo_actividad",
                name: "titulo_actividad",
            },
            {
                data: "detalle_actividad",
                name: "detalle_actividad",
            },
            {
                data: "asignatura",
                name: "asignatura",
            },
            {
                data: "fecha_solicitada",
                name: "fecha_solicitada",
            },
            {
                data: "hora_inicio",
                name: "hora_inicio",
            },
            {
                data: "hora_final",
                name: "hora_final",
            },
            {
                data: "status",
                name: "status",
                render: function (data, type, row, meta) {
                    text = "";
                    switch (data) {
                        case 0:
                            text = "Rechazado ";
                            break;
                        case 1:
                            text = "Pendiente";
                            break;
                        case 2:
                            text = "Aceptado";
                            break;
                        case 3:
                            text =
                                'Finalizado <span style=" color: rgb(0, 102, 255)"> <i class="material-icons">verified</i></span>';
                            // return btn =
                            break;
                    }
                    return text;
                },
            },
            {
                data: "action",
                name: "action",
            },
        ],
        drawCallback: function (e) {
            $(".btn-ver-dato").on("click", function () {
                var id_solicitud = $(this).data("id");
                var status = $(this).data("status");
                var asignatura = $(this).data("asignatura");

                ver_datos_solicitud(id_solicitud, status, asignatura);
            });
            $(".btn-finalizar").on("click", function () {
                var id_solicitud = $(this).data("id");
                var id_espacio = $(this).data("id_espacio");
                finalizar_espacio(id_solicitud, id_espacio);
            });
            $(".btn-pdf").on("click", function () {
                var id_solicitud = $(this).data("idsolicitud");
                var cedula = $(this).data("cedula");
                var id_espacio = $(this).data("idespacio");
                var id_horario = $(this).data("idhorario");
                var ClaveAsig = $(this).data("claveasignatura");
                generar_pdf(
                    id_solicitud,
                    cedula,
                    id_espacio,
                    id_horario,
                    ClaveAsig
                );
            });
        },
    });

    $("#select_clave_grupo").on("change", function () {
        get_clave_asignatura($(this).val());
    });

    $("#select_clave_asignatura").on("change", function () {
        get_nombre_asignatura(
            $(this).val(),
            $("#select_clave_grupo option:selected").val()
        );
    });
});
function generar_pdf(id_solicitud, cedula, id_espacio, id_horario, ClaveAsig) {
    var urlPdf = $("#url_created_pdf").val();
    // var info = {
    //     id_solicitud : id_solicitud,
    //     cedula : cedula,
    //     id_espacio :id_espacio,
    //     id_horario:id_horario,
    //     ClaveAsig : ClaveAsig
    // };
    // $.ajax({
    //     url : urlPdf,
    //     type : "get",
    //     dataType: "json",
    //     data: info,
    // })
    var news =
        urlPdf +
        "?id_solicitud=" +
        id_solicitud +
        "&" +
        "id_espacio=" +
        id_espacio +
        "&" +
        "id_horario=" +
        id_horario +
        "&" +
        "ClaveAsig=" +
        ClaveAsig;
    window.open(news, "_blank");
}

function ver_datos_solicitud(id_solicitud, status, asignatura) {
    var url = $("#url_ver_solicitud").val() + "/" + id_solicitud;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {},
        success: function (data) {
            // console.log(data);
            $("#modal_edit").modal("show");
            var html =
                '<option id="' +
                data.profesor.cedula +
                '">' +
                data.profesor.nombre +
                " " +
                data.profesor.apellidop +
                " " +
                data.profesor.apellidom +
                "</option>";
            $("#select_docente").html(html);
            $("#select_docente").val(data.cedula).change();
            cedula_profesor = data.cedula;
            get_clave_grupo(data.ClaveGrupo);
            get_clave_asignatura(data.ClaveGrupo, data.ClaveAsig);
            get_espacios(data.id_espacio, data.id_horario);

            var formattedDate = new Date(data.fecha_solicitud);
            var d = formattedDate.getDate() + 1;
            var m = formattedDate.getMonth();
            m += 1; // JavaScript months are 0-11
            var y = formattedDate.getFullYear();
            fecha_solicitud = y + "/" + m + "/" + d;
            $("#fecha_solicitud").val(fecha_solicitud);

            var formattedDates = new Date(data.fecha_solicitada);
            var d = formattedDates.getDate() + 1;
            var m = formattedDates.getMonth();
            m += 1; // JavaScript months are 0-11
            var y = formattedDates.getFullYear();
            fecha_solicitada = y + "/" + m + "/" + d;

            $("#requested_date").val(fecha_solicitada);
            $("#titulo_actividad").val(data.titulo_actividad);
            $("#detalle_actividad").val(data.detalle_actividad);
            $("#cantidad_participantes").val(data.participantes);

            $(".btn-update").on("click", function () {
                if (
                    $("#select_espacio").val().length < 1||
                    $("#select_clave_asignatura").val().length < 1||
                    $("#select_clave_grupo").val().length < 1 ||
                    $("#select_docente").val().length < 1||
                    $("#detalle_actividad").val().length < 1 ||
                    $("#requested_date").val().length < 1 ||
                    $("#fecha_solicitud").val().length < 1 ||
                    $("#select_horario").val().length < 1 ||
                    $("#cantidad_participantes").length < 1 ||
                    $("#titulo_actividad").val().length < 1
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "¡Ha ocurrido un error!",
                        text: "¡No deje campos vacios!",
                    });
                } else if(
                    $("#select_espacio").val() &&
                    $("#select_clave_asignatura").val() &&
                    $("#select_clave_grupo").val() &&
                    $("#select_docente").val() &&
                    $("#detalle_actividad").val() &&
                    $("#requested_date").val() &&
                    $("#fecha_solicitud").val() &&
                    $("#select_horario").val() &&
                    $("#cantidad_participantes").val() &&
                    $("#titulo_actividad").val() != null
                ){
                    var solici = {
                        id_solicitud: id_solicitud,
                        id_espacio: $("#select_espacio").val(),
                        status: status,
                        ClaveAsig: $("#select_clave_asignatura").val(),
                        ClaveGrupo: $("#select_clave_grupo").val(),
                        asignatura: asignatura,
                        cedula: $("#select_docente").val(),
                        detalle_actividad: $("#detalle_actividad").val(),
                        fecha_solicitada: $("#requested_date").val(),
                        fecha_solicitud: $("#fecha_solicitud").val(),
                        id_horario: $("#select_horario").val(),
                        participantes: $("#cantidad_participantes").val(),
                        titulo_actividad: $("#titulo_actividad").val(),
                    };
                    update_solicitud(solici);
                }
            });
        },
        error: function (data) {},
    });
}

function get_clave_grupo(clave_grupo) {
    var url = $("#url_get_clave_grupo").val() + "/" + cedula_profesor;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {},
        success: function (data) {
            html = "";
            $.each(data, function (idx, item) {
                html +=
                    '<option value="' +
                    item.ClaveGrupo +
                    '">' +
                    item.ClaveGrupo +
                    "</option>";
            });
            $("#select_clave_grupo").html(html);

            $("#select_clave_grupo").val(clave_grupo); //.change();

            //$('#select_clave_grupo').selectpicker('refresh');
        },
        error: function (data) {},
    });
}

function get_clave_asignatura(clave_grupo, clave_asig = "") {
    var url = $("#url_get_clave_asignatura").val() + "/" + clave_grupo;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        async: false,
        data: {},
        success: function (data) {
            html = "";
            $.each(data, function (idx, item) {
                html +=
                    '<option value="' +
                    item.ClaveAsig +
                    '">' +
                    item.ClaveAsig +
                    "</option>";
            });
            $("#select_clave_asignatura").html(html);
            if (clave_asig != "") {
                $("#select_clave_asignatura").val(clave_asig); //.change();
            }
            clave_asig = $("#select_clave_asignatura").val();
            get_nombre_asignatura(clave_asig, clave_grupo);
        },
        error: function (data) {},
    });
}

function get_nombre_asignatura(clave_asig, clave_grupo) {
    var url = $("#url_get_nombre_asignatura").val() + "/" + clave_asig;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        async: false,
        data: {
            clave_asig: clave_asig,
        },
        success: function (data) {
            html = "";
            $.each(data, function (idx, item) {
                html +=
                    '<option value="' +
                    item.clave_grupo +
                    '">' +
                    item.Nombre +
                    "</option>";
            });
            $("#select_nombre_asignatura").html(html);
            $("#select_nombre_asignatura").val(clave_grupo); //.change();
        },
        error: function (data) {},
    });
}

function get_espacios(id_espacio, id_horario) {
    var url = $("#url_get_espacios").val();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {},
        success: function (data) {
            html = "";
            $.each(data, function (idx, item) {
                html +=
                    '<option value="' +
                    item.id_espacio +
                    '">' +
                    item.nombre +
                    "</option>";
            });
            $("#select_espacio").html(html);
            $("#select_espacio").val(id_espacio); //.change();
            get_horarios();

            $("#select_horario").val(id_horario); //.change();
        },
        error: function (data) {},
    });
}

function finalizar_espacio(id_solicitud, id_espacio) {

    Swal
    .fire({
        title: "No podrás revertir este cambio!,¿Estás seguro de aceptar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sí, aceptar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
    })
    .then(resultado => {
        if (resultado.value) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡La solicitud ha sido finalizada!",
                showConfirmButton: false,
                timer: 1500,
            });
            aceptar_finalizado(id_solicitud, id_espacio);
        } else {

        }
    });
}
function aceptar_finalizado(id_solicitud,id_espacio){
    var urlUpdate = $("#url_finish_espacio").val();
    var solicitud = {
        status: 3,
        id_solicitud: id_solicitud,
        id_espacio: id_espacio,
    };
    //  $("#datatable_teacher_requests").DataTable().ajax.reload();
    $.ajax({
        url: urlUpdate,
        type: "GET",
        dataType: "json",
        data: solicitud,
    });
    $("#datatable_teacher_requests").DataTable().ajax.reload();
}

function update_solicitud(solici) {
    // console.log(solici);
    Swal
    .fire({
        title: "¿Estás seguro de aceptar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sí, aceptar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
    })
    .then(resultado => {
        if (resultado.value) {
            var urlUpdateSolicitud = $("#url_update_solicitud").val();
            $.ajax({
                url: urlUpdateSolicitud,
                type: "GET",
                dataType: "json",
                data: solici,
            });
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡La solicitud ha sido finalizada!",
                showConfirmButton: false,
                timer: 1500,
            });
            $("#datatable_teacher_requests").DataTable().ajax.reload();
            $("#modal_edit").modal("hide");
        } else {

        }
    });
}
