<!DOCTYPE html>
<html>
<head>
 <!-- <meta charset="utf-8"> -->
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta http-equiv="Content-Type" content-"text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="/statics/css/main.css">
  <script src="/statics/js/masonry.min.js"></script>
  <script src="/statics/js/imagesLoaded.js"></script>
  <script type="text/javascript">
      function board_search_enter(form){
      var keycode = window.event.keyCode;
      if(keycode == 13) $("#search_btn").click();
    }
      function like_box_control(){
    $("document").ready(function(){
      var like_id_index;
      $(".like_box_container").hide(0);

      $(".main_cards_wrapper").each(function(index, card){
        var index=index+1;

        $(card).hover(function(){
          like_id_index = ".like_box_"+index;
          $(like_id_index).show(100);
        },
        function(){
          like_id_index=".like_box_"+index;
          $(like_id_index).hide(100);
        }
        );
      });
      $(".main_img").each(function(index, card){
        var index=index+1;
        var like_box_id = "#like_box_"+index;
        var img=$(card);

        img.load(function(){
          var width=img.width();

          var sub_width = 220-width;
          var left_width = sub_width/2;
          $(like_box_id).css("width", width);
          $(like_box_id).css("left", left_width);
        })
      });
    });
  }

  function pinter_layout(){
    $(function(){
      var $container = $('div.main_cards_container');
      $container.imagesLoaded(function(){
        $container.masonry({
            itemSelector: 'div.main_cards_wrapper'
        });
      });
    });
  }

  function lastPostFunc(){
    var last_id = $("div.main_cards_wrapper:last").attr("id");
    $.ajax({
      url : "/ajax_board/more_lists",
      dataType : "html",
      type : "GET",
      data : "last_id=" +last_id,
      success:function(result){
        $('div.main_cards_container').masonry();
        $('div.main_cards_container').append(result).masonry('reloadItems');
        pinter_layout();
        like_box_control();
      }
    });
  }

  $(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){
      lastPostFunc();
    }
  });
  </script>
  <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/statics/css/cards_view.css">
</head>
<body>
<header id="head">
  <div style="margin:25px;">
    hello
  </div>
</header>
