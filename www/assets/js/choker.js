'use strict';
var chokeString = '';


//DOC Ready
$( document ).ready(function() {

    let ver = '0019';

    $('.version').html(ver);

    //Bind Events
    $('.choke').on('click', function(){

        simpleChoke();

        tempDisableButton($('.choke'));

    });

    $('.memeGen').on('click', function(){

       memeChoke();
       tempDisableButton($('.memeGen'));
    });


    function checkTextType(){
        return $('input[name=textOptions]:checked').attr('data-id');
    }

    function simpleChoke(){

        chokeString = $('.chokeTextInput').val();
        var chokeTextFormat = checkTextType();
        //var Url = '/choke/text/' + chokeTextFormat + '/' + (chokeString);

        var Url = '/chokeText';

        var data = {
            textType : chokeTextFormat,
            text : chokeString
        }

        $.ajax({
            type: "POST",
            url: Url,
            data: data,
            dataType: 'json'
        });
    }

    function memeChoke(){

        let chokeText = $('.chokeImageText').val();

        let chokeUrl = 'https://njs.m0u.work/leoShout/' + chokeText;

        $.ajax({
            method: "get",
            url: chokeUrl,
            data: ''
        })
            .done(function( msg ) {
                // alert( "Data Saved: " + msg );
                console.log('success');
                mountImage(msg.body);

            }).fail(function(err){
                console.log(err);
                console.log('sth wrong');
        });
    }

    function mountImage(imgUrl){

        $('#imgResult > img').attr('src', imgUrl);
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
