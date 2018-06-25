$(document).ready(function() {
    $.get("/admin/getevents/", function(data) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            locale: 'ru',
            eventLimit: true,
            eventLimit: 6,
            events: data,
            height: 700,
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url, "_blank");
                    return false;
                }
            },

        });
    });
});