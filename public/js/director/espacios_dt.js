var id_espacio = null;

$(function() {
    var table = $('#dt_admin_espacios').DataTable({
        processing: true,
        // "bAutoWidth": true,
        // ajax: "{{ url('apiEspacios') }}",
        ajax : $("#url_espacios").val(),

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'ubicacion',
                name: 'ubicacion'
            },
            // {
            //     data: 'cupo',
            //     name: 'cupo'
            // },
            {
                data: 'action',
                name: 'action'
            }
        ],
        drawCallback: function(e) {
            $('.btn-ver-dato').on('click', function() {
                id_espacio = $(this).data('espacio');
                ver_datos_espacios(id_espacio);
            });
        },
    });
});

function agregar_datos_espacios() {

    // var url = $('#url_espacio_update').val() + "/" + id_espacio;

    $(function() {
        $('#agregar_espacio').modal('show');
    })
};

function ver_datos_espacios(id_espacio) {

    var url_u = $('#url_espacios_update').val() + "/" + id_espacio;
    $.ajax({
        url: url_u,
        type: "GET",
        dataType: "json",
        data: {},
        success: function(data) {
            // console.log(data);

            $('#nombre_espacio').val(data.nombre);
            $('#ubicacion_espacio').val(data.ubicacion);
            $('#cupo_espacio').val(data.cupo);

            $('#editar_espacio').modal('show');
            $('#btn_actualizar').on('click', function(){

                var espacio ={
                    // id_espacio:$(''),
                    nombre:$('#nombre_espacio').val(),
                    ubicacion:$('#ubicacion_espacio').val(),
                    cupo:$('#cupo_espacio').val(),
                };
                console.log(espacio);

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                    },
                    url: url_u,
                    type: "PUT",
                    dataType: "json",
                    data: espacio,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {}
                });
            })
        },
        error: function(data) {}
    });
};

