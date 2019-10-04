"use strict";

var jasonPath = 'https://s3-us-west-2.amazonaws.com/q3buxya/WeddingHelper/L30/web/images.json';
var prefix = 'https://s3-us-west-2.amazonaws.com/q3buxya/';

//toss in Object
function showImg(thumbname){

    var imageSource = thumbname.src;
    $('.show').attr('src' , imageSource);
}

function bindImage(){
    //Bind the event when clicked on a thumb
    $('.image_thumbs>img').on('click', function (e) {
        console.log('clicked');
        showImg(this);
    });
}

//DOM Ready
$(function () {
    $.ajax({

        dataType: "json",
        url: jasonPath,
        success: function(data) {

            var imgAlbum = '';
            var result = data.forEach(function(item, index, array){

                if(item.indexOf('.jpg') >= 0){
                    var currentImage = prefix + item;
                    imgAlbum += '<img src="' + currentImage + '" alt="Loading" height="75" width="75">';
                }
            });

            //Mount
            $(".images").after( imgAlbum );
            bindImage();
        }
    });
});

