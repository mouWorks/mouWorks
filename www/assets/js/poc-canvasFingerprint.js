'use strict';
var chokeString = '';

//DOC Ready
$( document ).ready(function() {

    $('.version').html('0024');

    $('.get_print').on('click', function(){

        var options =
            {fonts: {extendedJsFonts: true},
                excludes: {
                userAgent: true,
                // deviceMemory: true,
                // hardwareConcurrency: true,
                // plugins: true
            }
        };

        Fingerprint2.get(function (components) {

            console.table(components) // an array of components: {key: ..., value: ...}

            var murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 200)
            mountResult(murmur);

            //List all the diff
            mountDetail(components);

        })
    });

    function mountResult(string) {
        $('#result').text(string);
    }

    function mountDetail(detailArray) {

        var table = '<table>';

        $.each( detailArray, function( id, data ) {
            table += '<tr><td>' + data.key + '</td><td>' + data.value + '</td></tr>';
        });
        table += '</table>';

        $('#detail').html(table);
    }

});
