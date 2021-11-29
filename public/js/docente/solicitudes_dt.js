//= require public/docente/validaciones_fecha.js
var cedula_profesor = null;
$(function() {
    var table = $('#datatable_teacher_requests').DataTable({
        processing: true,
        //   serverSide: true,
        //ajax: "{{ url('apiSolicitudes') }}",
        ajax: $("#url_ver_solicitud").val(),
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nombre_espacio',
                name: 'nombre_espacio'
            },
            {
                data: 'titulo_actividad',
                name: 'titulo_actividad'
            },
            {
                data: 'detalle_actividad',
                name: 'detalle_actividad'
            },
            {
                data: 'asignatura',
                name: 'asignatura'
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
                name: 'hora_final'
            },
            {
                data: 'status',
                name: 'status',
                "render": function(data, type, row, meta) {
                    text = ""
                    switch (data) {
                        case 0:
                            text = "Rechazado"
                            break;
                        case 1:
                            text = "Pendiente"
                            break;
                        case 2:
                            text = "Aceptado"
                            break;
                        case 3:
                            text = "Finalizado"
                            break;
                    }
                    return text;
                }
            },
            {
                data: 'action',
                name: 'action',

            },

        ],
        drawCallback: function(e) {
            $('.btn-ver-dato').on('click', function() {
                var id_solicitud = $(this).data('id_solicitud');
                ver_datos_solicitud(id_solicitud);

            });
            $('.btn-finalizar').on('click', function() {
                var id_solicitud = $(this).data('id_solicitud');
                var id_espacio = $(this).data('id_espacio');
                finalizar_espacio(id_solicitud, id_espacio);
            });
        }
    });


    $('#select_clave_grupo').on('change', function () {
        get_clave_asignatura($(this).val())
    });

    $('#select_clave_asignatura').on('change', function () {
        get_nombre_asignatura($(this).val(), $('#select_clave_grupo option:selected').val());
    });

});

function ver_datos_solicitud(id_solicitud) {

    var url = $('#url_ver_solicitud').val() + "/" + id_solicitud;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {},
        success: function(data) {
            console.log(data);
            $('#modal_edit').modal('show');
            var html = '<option id="'+data.profesor.cedula+'">'+data.profesor.nombre+' '+data.profesor.apellidop+' '+data.profesor.apellidom+'</option>'


            $('#select_docente').html(html);
            $('#select_docente').val(data.cedula).change();
            cedula_profesor = data.cedula;
            get_clave_grupo(data.ClaveGrupo)
            get_clave_asignatura(data.ClaveGrupo, data.ClaveAsig);
           get_espacios(data.id_espacio, data.id_horario);
           var formattedDate = new Date(data.fecha_solicitud);
           var d = formattedDate.getDate() + 1;
           var m =  formattedDate.getMonth();
           m += 1;  // JavaScript months are 0-11
           var y = formattedDate.getFullYear();

           fecha_solicitud = d + "/" + m + "/" + y
           $('#fecha_solicitud').val(fecha_solicitud);

           var formattedDate = new Date(data.fecha_solicitada);
           var d = formattedDate.getDate() + 1;
           var m =  formattedDate.getMonth();
           m += 1;  // JavaScript months are 0-11
           var y = formattedDate.getFullYear();

           fecha_solicitada = d + "/" + m + "/" + y
           console.log(fecha_solicitada)

           $('#requested_date').val(fecha_solicitada);
           $('#titulo_actividad').val(data.titulo_actividad);
           $('#detalle_actividad').val(data.detalle_actividad);
           $('#cantidad_participantes').val(data.participantes);

        },
        error: function(data) {}
    });
}

function get_clave_grupo(clave_grupo) {
    var url = $('#url_get_clave_grupo').val() + "/" + cedula_profesor;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {},
        success: function(data) {
            html = "";
            $.each(data, function(idx, item) {
                html += '<option value="' + item.ClaveGrupo + '">' + item.ClaveGrupo +
                    '</option>'
            });
            $('#select_clave_grupo').html(html);

            $('#select_clave_grupo').val(clave_grupo)//.change();

            //$('#select_clave_grupo').selectpicker('refresh');

        },
        error: function(data) {}
    });
}

function get_clave_asignatura(clave_grupo,clave_asig = "") {
    var url = $('#url_get_clave_asignatura').val() + "/" + clave_grupo;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        async: false,
        data: {},
        success: function(data) {
            html = "";
            $.each(data, function(idx, item) {
                html += '<option value="' + item.ClaveAsig + '">' + item.ClaveAsig +
                    '</option>'
            });
            $('#select_clave_asignatura').html(html);
            if(clave_asig != ""){
                $('#select_clave_asignatura').val(clave_asig)//.change();

            }
            clave_asig = $('#select_clave_asignatura').val();
           get_nombre_asignatura(clave_asig, clave_grupo);

        },
        error: function(data) {}
    });
}

function get_nombre_asignatura(clave_asig,clave_grupo) {
    var url = $('#url_get_nombre_asignatura').val() + "/" + clave_asig;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        async:false,
        data: {
            clave_asig: clave_asig,
        },
        success: function(data) {
            html = "";
            $.each(data, function(idx, item) {
                html += '<option value="' + item.clave_grupo + '">' + item.Nombre +
                    '</option>'
            });
            $('#select_nombre_asignatura').html(html);
            $('#select_nombre_asignatura').val(clave_grupo)//.change();
        },
        error: function(data) {}
    });
}


function get_espacios(id_espacio, id_horario) {
    var url = $('#url_get_espacios').val();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
        },
        success: function(data) {
            html = "";
            $.each(data, function(idx, item) {
                html += '<option value="' + item.id_espacio + '">' + item.nombre +
                    '</option>'
            });
            $('#select_espacio').html(html);
            $('#select_espacio').val(id_espacio)//.change();
            get_horarios();

           $('#select_horario').val(id_horario)//.change();
                },
        error: function(data) {}
    });
}
function finalizar_espacio(id_solicitud, id_espacio){
    var urlUpdate = $('#url_finish_espacio').val();
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
                status: 3,
                id: id_solicitud,
                id_espacio: id_espacio
            };
            $.ajax({
                url: urlUpdate,
                type: "GET",
                dataType: "json",
                data: solicitud,
                success: function(data) {
                    console.log(data);
                    // $('#dt_admin_solicitudes').dataTable.ajax.reload(null, false)
                }
            })
        }
    });
}
