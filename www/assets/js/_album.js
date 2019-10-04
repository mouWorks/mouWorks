"use strict";

  //toss in Object
  function showImg(thumbname){

    var src_small = thumbname.src;
    var img_alt = thumbname.alt;
      
    var src_mid = get_diff_image_size(thumbname.src, 'M');

    //show the Mid photo
    $('.show').attr('src' , src_mid);
    $('.desc').html(img_alt);
    add_more_button();
    
  }

  //Change Content and Desc
  function change_by_cat(cat_data)
  {
    $('.title').html(cat_data.text());

    $('.title_desc').html(cat_data.data('desc'));

  }

  //getting different_size images
  function get_diff_image_size(orig_img_url, type)
  {
    var replace_word;
    switch(type)
    {
      case 'S':
        break;
      case 'M':
        replace_word = 'c'; //800x600
        break;
      case 'L':
        replace_word = 'b'; //1024x768
        break;
      case 'O': //original
        replace_word = 'o';
        break;
    }

    replace_word = replace_word + '.jpg';
    return orig_img_url.replace('s.jpg', replace_word);
  }

  function add_more_button()
  {
    $('.more_button>a').remove();

    var button = '<a class="btn btn-default enlarge_photo" href="#" role="button">More&raquo;</a>';
    //alert(button);
    $('.more_button').append(button);
    bind_actions();
  }

  function bind_actions()
  {
      $('.enlarge_photo').on('click', function(){

      var enlarged_image_url = $('.show').attr('src');

      swal({
        title    : $('.desc').html(),
        imageUrl : enlarged_image_url,
        imageSize: "800x600"

      });
    })
  }

  //Trying the button and connect to Flickr
  function flickr_conn()
  {
    swal('yo Daug!');















  }


//DOM Ready
$(function (){

  //Bind the event when clicked on a thumb
  $('.image_thumbs>img').on('click',function(e){
    e.preventDefault();
    showImg(this);
  })
  
  //Try sweet alert
  $('#manage').on('click', function(){
    swal(
      { 
        type: "info",
        title:"Feature still working...",
        text: "(Close in 2s)",
        timer: 2000 });
  })

  //Change content based on Cat
  $('.cat').on('click',function(){

    //Toss object over 
    change_by_cat($(this));

  })
  

  $('#try_flickr').on('click',function(){

    flickr_conn();
  })



});
