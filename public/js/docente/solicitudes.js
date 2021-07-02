document.addEventListener('DOMContentLoaded', function() {
    // seleccionar datos de calendario
    let formulario = document.querySelector("form");

    var calendarEl = document.getElementById('solicitudes');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      initialView: 'dayGridMonth',
    //   traducir a español
      locale: 'es',
    //   agregar cabecera
    headerToolbar: {
        left: 'prev, next, today',
        center: 'title',
        right: 'dayGridMonth, timeGridWeek, listWeek'

    }, 
    dateClick: function(info) {
        $("#Agregar").modal("show");
    }

    });
    calendar.render();

    // capturar accion del boton
    new Vue({
        el:'#sol',
        data:{
            n:'hola'
        }
    })
  });