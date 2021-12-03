var id_espacio = null;
// var errors = [];
// var error_nombre = $('#error_nombre').val();
// var error_ubicacion = $('#error_ubicacion').val();

$(function () {
    var table = $("#dt_admin_espacios").DataTable({
        processing: true,
        // "bAutoWidth": true,
        // ajax: "{{ url('apiEspacios') }}",
        ajax: $("#url_espacios").val(),

        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "nombre",
                name: "nombre",
            },
            {
                data: "ubicacion",
                name: "ubicacion",
            },
            // {
            //     data: 'cupo',
            //     name: 'cupo'
            // },
            {
                data: "action",
                name: "action",
            },
        ],
        drawCallback: function (e) {
            $(".btn-ver-dato").on("click", function () {
                id_espacio = $(this).data("espacio");
                ver_datos_espacios(id_espacio);
            });
        },
    });
});

function agregar_datos_espacios() {
    // var url = $('#url_espacio_update').val() + "/" + id_espacio;
    $(function () {
        $("#agregar_espacio").modal("show");
    });
}

function ver_datos_espacios(id_espacio) {
    var url_u = $("#url_espacios_all").val() + "/" + id_espacio;
    $.ajax({
        url: url_u,
        type: "GET",
        dataType: "json",
        data: {},
        success: function (data) {
            // console.log(data);

            $("#nombre_espacio").val(data.nombre);
            $("#ubicacion_espacio").val(data.ubicacion);
            $("#cupo_espacio").val(data.cupo);

            $("#editar_espacio").modal("show");
            $("#btn_actualizar").on("click", function () {
                if ($("#nombre_espacio").val().length < 1) {
                    Swal.fire({
                        icon: "error",
                        title: "Ha ocurrido un error",
                        text: "No deje el campo nombre vacio",
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                } else if ($("#nombre_espacio").val().length >= 1) {
                    actualizar_datos_espacio(data);
                }
            });
        },
        error: function (data) {},
    });

    function actualizar_datos_espacio(data) {
        Swal.fire({
            title: "No podrás revertir este cambio!,¿Estás seguro de aceptar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, aceptar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((resultado) => {
            if (resultado.value) {
                var url_update = $("#url_espacios_update").val();
                var espacio = {
                    id_espacio: data.id_espacio,
                    nombre: $("#nombre_espacio").val(),
                    ubicacion: $("#ubicacion_espacio").val(),
                    cupo: $("#cupo_espacio").val(),
                };
                $.ajax({
                    url: url_update,
                    type: "get",
                    dataType: "json",
                    data: espacio,
                });
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "¡Actualizado exitosamente!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                $("#dt_admin_espacios").DataTable().ajax.reload();
                $("#editar_espacio").modal("hide");
            } else {
            }
        });
    }
}
