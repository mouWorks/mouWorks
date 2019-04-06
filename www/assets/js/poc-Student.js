'use strict';
//DOC Ready
$( document ).ready(function() {
    var studentName = $('#studentName').html();

    console.log('1123');

    $('input[name=studentStatus]').on('change', function(){
        var status = checkStudentStatus();
        console.log(studentName + ' is ' + status);
    });

    /**
     * Fetch student status
     * @returns {jQuery}
     */
    function checkStudentStatus(){

        return $('input[name=studentStatus]:checked').attr('data-id');
    }

});//end of Doc Ready