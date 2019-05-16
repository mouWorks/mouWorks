'use strict';
var chokeString = '';


//DOC Ready
$( document ).ready(function() {

    // $('h6 > .version').html('0011');

    $('.get_print').on('click', function(){

        // alert('getting your fingerprint');

        var options = {fonts: {extendedJsFonts: true}, excludes: {userAgent: true}}

        Fingerprint2.get(function (components) {
            console.log(components) // an array of components: {key: ..., value: ...}

            var murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31)
            mountResult(murmur);

        })

        //Trigger the fingerprint
        //mountResult('here it is!!')

    });


    function mountResult(string)
    {
        $('#result').text(string);

    }

    function checkTextType(){
        return $('input[name=textOptions]:checked').attr('data-id');
    }
});
