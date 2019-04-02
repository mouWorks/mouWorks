var offsets = [];
var counter = 0;
var maxTimes = 10;
var beforeTime = null;
var host = window.location.hostname;

if (host.indexOf('localhost') !== -1) {
    targetUrl = 'http://localhost:8080/index.php/time';
    // alert('Local Env');

}else{
    // alert('Not Local');
    targetUrl = '/time';
}

// get average
var mean = function(array) {
    var sum = 0;

    array.forEach(function (value) {
        sum += value;
    });

    return sum/array.length;
}

var getTimeDiff = function() {
    beforeTime = Date.now();
    $.ajax(targetUrl, {
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

            console.log(offset);

            // Push to array
            offsets.push(offset)
            if (counter < maxTimes) {
                // Repeat
                getTimeDiff();
            } else {
                var averageOffset = mean(offsets);

                //result
                var result = "Average offset :" + averageOffset;
                $('#result').text(result);

                console.log(result);

                // console.log("average offset:" + averageOffset);

            }
        }
    });
}

// populate 'offsets' array and return average offsets
getTimeDiff();