'use strict';
var chokeString = '';
//DOC Ready
$( document ).ready(function() {

    $('h6').html('0004');

    $('.choke').on('click', function(){

        simpleChoke();

        var target = $('.choke');
        tempDisableButton(target);

    });

    function formatText(chokeString){

        var type = checkTextType();

        switch(type) {

            case 'bold':

                return " *" + chokeString + "* ";

                break;


            case 'italic':

                return " _" + chokeString + "_ ";
                break;


            case 'highlight':

                return " `" + chokeString + "` ";
                break;

        }

        return chokeString;
    }


    function checkTextType(){
        return $('input[name=textOptions]:checked').attr('data-id');
    }

    function simpleChoke(){

        chokeString = $('.chokeTextInput').val();

        ajaxCurl(formatText(chokeString));
        //ajaxCurl(chokeString);
    }

    function ajaxCurl(chokeString){

        // console.log(chokeString);

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
