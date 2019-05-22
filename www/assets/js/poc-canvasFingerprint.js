'use strict';
var fingerprint = ''; //Make it Global

//DOC Ready
$( document ).ready(function() {

    $('.version').html('0059');

    $('.get_print').on('click', function(){

        console.log(fingerprint);

        mountResult(fingerprint);
    });


    Fingerprint2.get(function (components) {

        //這邊一但 Doc.Ready 就開始跑, 跑完就 assign 給 global fingerprint
        //如果要 return 寫法, 則需要用 async 之類的擋住, 讓他算完再 return

        fingerprint = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 200)
    })

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
