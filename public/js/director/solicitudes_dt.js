$(function() {
    var table = $("#dt_admin_solicitudes").DataTable({
        processing: true,
        // ajax: "{{ url('apiSoliDirector') }}",
        ajax: $("#url_solicitud").val(),
        columns: [
            // {
            //     data: 'DT_RowIndex',
            //     name: 'DT_RowIndex'
            // },
            {
                data: 'nombre_docente',
                name: 'nombre_docente'
            },
            {
                data: 'materia',
                name: 'materia'
            },
            {
                data: 'titulo',
                name: 'titulo'
            },
            {
                data: 'detalle',
                name: 'detalle'
            },
            {
                data: 'nombre_espacio',
                name: 'nombre_espacio',
            },
            {
                data: 'fecha_solicitada',
                name: 'fecha_solicitada'
            },
            {
                data: 'hora_inicio',
                name: 'hora_inicio'
            },
            {
                data: 'hora_final',
                name: 'hora_final',
            },
            {
                data: 'status',
                name: 'status',
                "render": function(data, type, row, meta) {
                    switch (data) {
                        case 0:
                            return text = "Rechazado"
                            break;
                        case 1:
                            return text = "Pendiente"
                            break;
                        case 2:
                            return text = "Aceptado"
                            break;
                        case 3:
                            return text = "Finalizado"
                            break;
                    }

                }
            },
            {
                data: 'action',
                name: 'action',
            }
        ],
        drawCallback: function(e) {
            $('.btn_aceptar').on('click', function() {
                var id_solicitud = $(this).data('info');
                var id_espacio = $(this).data('espacio');
                get_solicitud(id_solicitud, id_espacio);
            });
            $('.btn_rechazar').on('click', function() {
                var id_solicitud = $(this).data('info');
                var id_espacio = $(this).data('espacio');
                rechazar_solicitud(id_solicitud, id_espacio);
            });
        }
    });
});

function get_solicitud(id_solicitud, id_espacio) {
    var url = $('#url_solicitud_patch').val();
    Swal.fire({
        title: "No podrás revertir este cambio!,¿Estás seguro de aceptar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        buttons: {
            confirm: {
                text: "Aceptar",
                value: true,
                visible: true,
                className: "",
                closeModal: true
            },
            cancel: {
                text: "Cancelar",
                value: false,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((isConfirm) => {
        if (isConfirm) {
            var solicitud = {
                status: 2,
                id: id_solicitud,
                id_espacio: id_espacio,

            };
            console.log(solicitud);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: solicitud,
                success: function() {
                    $('#dt_admin_solicitudes').dataTable.ajax.reload(null, false)
                }
            })
        }
    });
}

function rechazar_solicitud(id_solicitud, id_espacio) {
    var url = $('#url_solicitud_patch').val();
    Swal.fire({
        title: "No podrás revertir este cambio!,¿Estás seguro de aceptar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        buttons: {
            confirm: {
                text: "Aceptar",
                value: true,
                visible: true,
                className: "",
                closeModal: true
            },
            cancel: {
                text: "Cancelar",
                value: false,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((isConfirm) => {
        if (isConfirm) {
            var solicitud = {
                status: 0,
                id: id_solicitud,
                id_espacio: id_espacio
            };
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: solicitud,
                success: function() {
                    $('#dt_admin_solicitudes').dataTable.ajax.reload(null, false)
                }
            })
        }
    });
};
