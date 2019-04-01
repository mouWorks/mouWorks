var request = new XMLHttpRequest();
request.onreadystatechange = readystatechangehandler;
// request.open("POST", "http://m0u.work/sync.php", true);

var host = window.location.hostname;

if (host.indexOf('localhost') !== -1) {
    targetUrl = 'http://localhost:8080/index.php/getServerTime';
    // alert('Local Env');

}else{
    // alert('Not Local');
    targetUrl = '/getServerTime';
}

request.open("GET", targetUrl + "?original=" + (new Date).getTime());
request.send();

function readystatechangehandler() {
    var returned = (new Date).getTime();
    if (request.readyState === 4 && request.status === 200) {
        var timestamp = request.responseText.split('|');
        var original = + timestamp[0];
        var receive = + timestamp[1];
        var transmit = + timestamp[2];
        var sending = receive - original;
        var receiving = returned - transmit;
        var roundtrip = sending + receiving;
        var oneway = roundtrip / 2;
        var difference = sending - oneway; // this is what you want

        $('#original').text(original); //Original Time
        $('#receive').text(receive); //Original Time
        //$('#receive_diff').text(transmit);

        console.log(difference);
        // so the server time will be client time + difference
    }
}