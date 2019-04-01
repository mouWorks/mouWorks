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

        console.log(timestamp);

        var original = + timestamp[0];
        var receive = + timestamp[1];
        var transmit = + timestamp[2];

        var sending = receive - original; // time diff :: go ->
        var receiving = returned - transmit // time diff :: <- back

        var roundtrip = sending + receiving;

        var oneway = roundtrip / 2;
        var difference = sending - oneway; // this is what you want

        $('#original').text(original); //JS Ajax Make GET Request
        $('#receive').text(receive); //Server Side Receive
        $('#sending').text(sending); //time Diff

        $('#returned').text(returned); //Client Side Received
        $('#receiving').text(receiving); //Server Side RESPOND

        var diffMs = difference / 1000 + 'ms';

        $('#diff').text(diffMs); //Add the Diff



        console.log(difference);
        // so the server time will be client time + difference
    }
}