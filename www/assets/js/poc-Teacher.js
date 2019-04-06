// 'use strict';
//DOC Ready
$( document ).ready(function() {
    // var studentName = $('#studentName').html();

    console.log('1144');

    connectWS();
    // mountMessage();

    function mountMessage(message){

        $('#result').text(message);
    }

    function connectWS(){

        var webSocketUri = 'ws://127.0.0.1:8282';
        conn = new WebSocket(webSocketUri);


        conn.onmessage = function(e){
            mountMessage(e.data);
            console.log(e.data);
        };
    }













});//end of Doc Ready