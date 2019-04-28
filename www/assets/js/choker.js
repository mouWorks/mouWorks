'use strict';
var chokeString = '';
//DOC Ready
$( document ).ready(function() {

    $('h6').html('0005');

    $('.choke').on('click', function(){

        simpleChoke();

        var target = $('.choke');
        tempDisableButton(target);

    });

    function checkTextType(){
        return $('input[name=textOptions]:checked').attr('data-id');
    }

    function simpleChoke(){

        chokeString = $('.chokeTextInput').val();
        var chokeTextFormat = checkTextType();
        var Url = '/choke/text/' + chokeTextFormat + '/' + chokeString;

        ajaxCurl(Url);
    }

    function ajaxCurl(chokeString){

        $( document ).ready(function() {

            $.get( chokeString, function( data ) {
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
