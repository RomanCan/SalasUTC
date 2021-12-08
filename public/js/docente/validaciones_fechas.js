$(document).ready(function(){
    $('#select_espacio_nuevo').on('change', function () {
        get_horarios(true)
    });
    $('#select_fecha_nuevo').on('focusout', function () {
        get_horarios(true)
    });
        $('.select_espacio').on('change', function () {
        console.log("cambaindo")
     get_horarios(false);
    });

    $('.requested_date').on('focusout', function () {
        console.log("focusout")
    get_horarios(false);
    });

});

function get_horarios(is_new) {
    console.log("entrando en horario")

    console.log($('.select_espacio option:selected').val())
    console.log($('.requested_date').val())

    espacio_id = $('.select_espacio option:selected').val();
    fecha_solicitada = $('.requested_date').val();
    if(is_new){

        espacio_id = $('#select_espacio_nuevo option:selected').val();
        fecha_solicitada = $('#select_fecha_nuevo').val();
        if($('#select_espacio_nuevo option:selected').val() == null){

            Swal.fire({
                icon: 'warning',
                title: '¡Cuidado!',
                text: 'Seleccione un espacio para poder buscar horas disponibles'
            })
            return;
        }
    }else{
        if($('.select_espacio option:selected').val() == null){

            Swal.fire({
                icon: 'warning',
                title: '¡Cuidado!',
                text: 'Seleccione un espacio para poder buscar horas disponibles'
            })
            return;
        }
    }

    var url = $('#horarios').val();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        async: false,
        data: {
            espacio_id: espacio_id,
            fecha_solicitada: fecha_solicitada
        },
        success: function (data) {
            html = "";
           $.each(data.horas_espacios, function(idx, item){
               html += '<option value="'+item.id_horario+'">'+ item.hora_inicio +' - '+ item.hora_final +'</option>'
           });
            $('.start_time').html(html);
        },
        error:function(data){
        }
    });
}
