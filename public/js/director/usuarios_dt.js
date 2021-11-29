$(function() {
    var table = $('#dt_admin_usuarios').DataTable({
        processing: true,
        ajax: $('#url_usuarios').val(),
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'nivel',
                name: 'nivel'
            },
            {
                data: 'usuario',
                name: 'usuario'
            },
            {
                data: 'password',
                name: 'password'
            },
            {
                data: 'email',
                name: 'email',
            },
            // {
            //     data: 'action',
            //     name: 'action'
            // }
        ],

    });
});
