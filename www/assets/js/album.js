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

    //Go to S3 to manage
    $('#manage').on('click', function(){
        swal(
            {
                type: "info",
                title:"Feature still working...",
                text: "(Close in 2s)",
                timer: 2000
            });

        var s3url = 'https://s3.console.aws.amazon.com/s3/buckets/q3buxya/WeddingHelper/L30/photos/?region=ap-northeast-2';

        //somehow this doesn't work right now
        // setTimeout(function() {
        //     swal({
        //         type: "info",
        //         title:"Heading to S3 bucket to manage...",
        //         text: "(Close in 2s)",
        //     }, function() {
        //         window.location = "s3url";
        //     });
        // }, 2000);

    })
});

