document.addEventListener('DOMContentLoaded', function() {
    var route = document.querySelector("[name=route]").value;
    var baseURL = route + '/apiEventosDirector';

    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        // plugins:[dayGridPlugin],
        initialView: 'dayGridMonth',
        locale:"es",

        // windowResize: 'true',
        // contentHeight: 'auto',
        height: 'auto',
        width: 'auto',
        events: baseURL,
        eventDisplay:'block',
        eventColor: '#3788D8',
        dayMaxEvents: 0,
        // fixedWeekCount: true,
        // showNonCurrentDates:true,

        // información emergente
        // eventDidMount: function (info) {
        //     $(info.el).tooltip({ title: info.event.title});
        // },

        headerToolbar:{
            left:'prev,today,next',
            center:'title',
            right: 'dayGridMonth,listMonth',
            // timeGridDay,
        },

        businessHours: [ // specify an array instead
            {
              daysOfWeek: [ 1,2,3,4,5], // L - V
              startTime: '01:00', // 1am
              endTime: '23:00' // 11pm
            },
        ],

    });

    calendar.render();
});
