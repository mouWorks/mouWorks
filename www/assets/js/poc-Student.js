// 'use strict';
//DOC Ready
$( document ).ready(function() {
    var studentName = $('#studentName').html();

    console.log('1140');

    /**
     * Fetch student status
     * @returns {jQuery}
     */
    function checkStudentStatus(){
        return $('input[name=studentStatus]:checked').attr('data-id');
    }

    function triggerWS(studentName, status){

        var webSocketUri = 'ws://127.0.0.1:8282';

        // var ws = new WebSocket('ws://127.0.0.1:8282');

        init();
       // var output;
        function init() {
         //   output = document.getElementById("output");
            testWebSocket();
        }
        function testWebSocket() {

            conn = new WebSocket(webSocketUri);

            conn.onmessage = function(e){ console.log(e.data); };
            conn.onopen = () => conn.send('yolo');

            //websocket.send(studentName);

            // websocket.send(JSON.stringify({
            //     'studentName': studentName,
            //     'status': status,
            // }));

            // websocket.onopen = function(evt) {
            //     onOpen(evt)
            // };
            // websocket.onclose = function(evt) {
            //     onClose(evt)
            // };
            // websocket.onmessage = function(evt) {
            //     onMessage(evt)
            // };
            // websocket.onerror = function(evt) {
            //     onError(evt)
            // };
        }

        // ws.onmessage = function(e){
        //     // json数据转换成js对象
        //     var data = eval("("+e.data+")");
        //     var type = data.type || '';
        //     switch(type){
        //         // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
        //         case 'init':
        //             // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
        //             $.post('./bind.php', {client_id: data.client_id}, function(data){}, 'json');
        //             break;
        //         // 当mvc框架调用GatewayClient发消息时直接alert出来
        //         default :
        //             alert(e.data);
        //     }
        // };
    }//end of TriggerWS

    //FIXME - Bind Events
    $('input[name=studentStatus]').on('change', function(){
        var status = checkStudentStatus();
        console.log(studentName + ' is ' + status);
        triggerWS(studentName, status);
    });













});//end of Doc Ready