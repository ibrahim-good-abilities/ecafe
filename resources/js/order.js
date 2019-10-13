$(document).ready(function() {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('parista');
    channel.bind('new-order', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        snd.play();
        notify(data.message)
    });

});
