'use strict';
var chokeString = '';

//DOC Ready
$( document ).ready(function() {

    $('.version').html('0017 -with O');

    $('.get_print').on('click', function(){

        var options =
            {fonts: {extendedJsFonts: true}, excludes: {userAgent: true}
        };

        Fingerprint2.get(options, function (components) {

            console.log(components) // an array of components: {key: ..., value: ...}

            var murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 200)
            mountResult(murmur);


        })
    });

    function mountResult(string) {
        $('#result').text(string);
    }
});
