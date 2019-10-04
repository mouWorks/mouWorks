"use strict";


var jasonPath = 'https://s3-us-west-2.amazonaws.com/q3buxya/WeddingHelper/L30/web/images.json';
var prefix = 'https://s3-us-west-2.amazonaws.com/q3buxya/';

$.ajax({
    // beforeSend: function(request) {
    //     request.setRequestHeader("Access-Control-Allow-Origin", '*');
    // },
    dataType: "json",
    url: jasonPath,
    success: function(data) {

        var imgAlbum = '';
        var result = data.forEach(function(item, index, array){

            if(item.indexOf('.jpg') >= 0){
                var currentImage = prefix + item;
                imgAlbum += '<img src="' + currentImage + '" alt="Loading" height="75" width="75">';
                // imgAlbum += '<a href="' + currentImage + '"><img class="lazy" data-src="' + currentImage + '" alt="Loading" height="100" width="100">';
            }
        });

        //Mount
        $(".images").after( imgAlbum );
}
});

//toss in Object
function showImg(thumbname){

    var src_small = thumbname.src;
    // var img_alt = thumbname.alt;
    // var src_mid = get_diff_image_size(thumbname.src, 'M');
    //show the Mid photo
    $('.show').attr('src' , thumbname.src);
    // $('.desc').html(img_alt);
}


//DOM Ready
$(function () {

    //Bind the event when clicked on a thumb
    $('.image_thumbs>img').on('click', function (e) {
        e.preventDefault();
        showImg(this);
    });
});

