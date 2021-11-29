$(document).ready(function(){

    $('.select_espacio').on('change', function () {
     get_horarios();
    });

    $('#requested_date').on('focusout', function () {
    get_horarios();
    });

});

function get_horarios() {

if($('#select_espacio option:selected').val() == null){

    Swal.fire({
        icon: 'warning',
        title: '¡Cuidado!',
        text: 'Seleccione un espacio para poder buscar horas disponibles'
    })
    return;
}


    var url = $('#horarios').val();
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
            espacio_id: $('#select_espacio option:selected').val(),
            fecha_solicitada: $('#requested_date').val()
        },
        success: function (data) {
            html = "";
           $.each(data.horas_espacios, function(idx, item){
               html += '<option value="'+item.id_horario+'">'+ item.hora_inicio +' - '+ item.hora_final +'</option>'
           });
            $('#start_time').html(html);
        },
        error:function(data){
        }
    });
}
