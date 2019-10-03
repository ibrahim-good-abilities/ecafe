$(document).ready(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#orders').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: 5 }
        ]
    });


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c015a0a925da1961bddf', {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('parista');
    channel.bind('new-order', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        snd.play();
        location.reload();
    });
});