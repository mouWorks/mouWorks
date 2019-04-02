var offsets = [];
var counter = 0;
var maxTimes = 10;
var beforeTime = null;

var request = new XMLHttpRequest();
request.onreadystatechange = readystatechangehandler;

var host = window.location.hostname;

//Local or Remote Server
if (host.indexOf('localhost') !== -1) {
     targetUrl = 'http://localhost:8080/index.php/getServerTime';
    getTimeUrl = 'http://localhost:8080/index.php/time';
}else{
     targetUrl = '/getServerTime';
    getTimeUrl = '/time';
}

$('#version').text('try 18');

request.open("GET", targetUrl + "?original=" + (new Date).getTime());
request.send();

function readystatechangehandler() {

    if (request.readyState === 4 && request.status === 200) {

        //Move Inside here
        var returned = (new Date).getTime();

        var timestamp = request.responseText.split('|');

        var original = + timestamp[0];
        var receive = + timestamp[1];
        var transmit = + timestamp[2];

        var sending = receive - original; // time diff :: go ->
        var receiving = returned - transmit // time diff :: <- back

        var roundtrip = sending + receiving;

        var oneway = roundtrip / 2;
        var difference = sending - oneway; // this is what you want

        var originalText = timeConverter(original);
        var receiveText = timeConverter(receive);

        $('#original').text(original); //JS Ajax Make GET Request
        $('#originalText').text(originalText); //JS Ajax Make GET Request
        $('#receive').text(receive); //Server Side Receive
        $('#receiveText').text(receiveText); //JS Ajax Make GET Request

        //Diff
        $('#sending').text(sending); //time Diff

        $('#returned').text(returned); //Client Side Received
        var returnedText = timeConverter(returned);
        $('#returnedText').text(returnedText); //Client Side Received


        //Diff
        $('#receiving').text(receiving); //Server Side RESPOND

        var diffMs = difference;
        // var diffMs = difference / 1000 + 'ms'; //Not sure about this

        $('#diff').text(diffMs); //Add the Diff

        $('#oneway').text(oneway);
    }
}

var timeConverter = function(UNIX_timestamp){
    var a = new Date(UNIX_timestamp);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes() < 10 ? '0' + a.getMinutes() : a.getMinutes(); var sec = a.getSeconds() < 10 ? '0' + a.getSeconds() : a.getSeconds();
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec + ' - ' + UNIX_timestamp;
    return time;
}

//掛載時間
function mountTime(location, text){
    $(location).html(timeConverter(text));
}

var interval = 1000;
var start = (new Date).getTime();

function JScountdown(interval, location) {

    var x = setInterval(function () {

        //0. As System Default Get todays date and time
        var current = (new Date).getTime();
        mountTime(location, current); //每次都重新 New 一個

        //2. Adjust
        mountAdjustDiff(start);
        //console.log(adjustValue);

        //1. Simply cal by 1000 Cal = start + 1000;
        start += 1000; //每次 +1000
        mountTime('#mod', start);

    }, interval);
}

// function mountAdjustDiff(start){
//
//     getTimeDiff(start);
// }

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}

// get average
// var mean = function(array) {
//     var sum = 0;
//
//     array.forEach(function (value) {
//         sum += value;
//     });
//
//     return sum/array.length;
// }

var mountAdjustDiff = function(start) {

    if(start == 'undefined'){
        return;
    }

    beforeTime = Date.now();
    $.ajax(getTimeUrl, {
        type: 'GET',
        success: function(response) {

            response = JSON.parse(response);
            var now, timeDiff, serverTime, offset;
            counter++;

            // Get offset
            now = Date.now();
            timeDiff = (now-beforeTime)/2;
            serverTime = response.body.time-timeDiff;
            offset = now-serverTime;

            adjustValue = start + offset + 1000;
            mountTime('#adj', adjustValue);
        }
    });
}

JScountdown(interval, '#demo');
