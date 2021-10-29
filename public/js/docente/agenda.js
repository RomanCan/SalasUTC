document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",

        // windowResize: 'true',
        // contentHeight: 'auto',
        height: 'auto',
        width: 'auto',
        events: "http://127.0.0.1:8000/apiEventos",

        headerToolbar:{
            left:'prev,today,next',
            center:'title',
            right: 'dayGridMonth,listWeek',
        },

        businessHours: [ // specify an array instead
            {
              daysOfWeek: [ 1,2,3,4,5], // Monday, Tuesday, Wednesday
              startTime: '01:00', // 1am
              endTime: '23:00' // 11pm
            },
          ]

    });


    calendar.render();
});


