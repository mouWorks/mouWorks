'use strict';
var chokeString = '';
//DOC Ready
$( document ).ready(function() {

    $('.choke').on('click', function(){

        simpleChoke();

        var target = $('.choke');
        tempDisableButton(target);

    });

    function simpleChoke(){

        chokeString = $('.chokeTextInput').val();
        ajaxCurl(chokeString);
    }

    function ajaxCurl(chokeString){

        $( document ).ready(function() {

            var getUrl = '/choke/text/' + chokeString;

            $.get( getUrl, function( data ) {
                $( ".result" ).html( data );
            });

        });
    }

    function tempDisableButton(target) {

        target.attr('disabled','disabled');
        target.addClass('btn-secondary');
        target.removeClass('btn-success');
        setTimeout(function() {
            target.removeAttr('disabled');
            target.addClass('btn-success');
            target.removeClass('btn-secondary');
        },800);   // enable after 1 seconds
    }

});
