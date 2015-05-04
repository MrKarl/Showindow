<script>
    $(document).ready(function(){
      $("#search_btn").click(function(){
        if($("#q").val() == ''){
          alert('검색어를 입력하세요');
          return false;
        }else{
          var act = '/controlls/lists/ci_board/q/'+$("#q").val()+'/page/1';
          $("#bd_search").attr('action',act).submit();
        }
      });
    });

    function board_search_enter(form){
      var keycode = window.event.keyCode;
      if(keycode == 13) $("#search_btn").click();
    }

    function lastPostFunc()	{
		var last_id = $(".wrdLatest:last").attr("id") ;

		$('div#lastPostsLoader').html('<img src="/images/bigLoader.gif">');
		$.ajax({ 
			type:'POST',
			url:'/ajax_board/more_list',
			data:{
				"csrf_test_name":getCookie('csrf_cookie_name'),
				"last_id":$(".wrdLatest:last").attr("id")
			},
			dataType:"text",
			complete:function(data){
				if (data != "") {
					alert(data);
					$(".wrdLatest:last").html(data.responseText);
				}
				$('div#lastPostsLoader').empty();
			}

		});
	}

	$(window).scroll(function(){
		if  ($(window).scrollTop() >= $(document).height() - $(window).height()){
			lastPostFunc();
		}
	});


	
	function getCookie( name )
	{
		var nameOfCookie = name + "=";
		var x = 0;

		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);

			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;

				return unescape( document.cookie.substring( y, endOfCookie ) );
			}

			x = document.cookie.indexOf( " ", x ) + 1;

			if ( x == 0 )

			break;
		}

		return "";
	}
  </script>
<div class="container">
<article id = "board_area" style="margin-top:100px;align:center;margin-left:20px;">
	<?php
				$attributes =array('id' => 'bd_search', 'method' => 'post', 'style' => 'display:inline;');
				echo form_open('', $attributes);
				?>	
			<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" />
			<input class="btn btn-success"type="button" value="검색" id="search_btn" />
		</form>
			<a href="/board/write/<?php echo $this->uri->segment(3);?>/page/<?php if($this->uri->segment(5) == ''){echo 1;}else{echo $this->uri->segment(5);}?>" class="btn btn-primary">쓰기</a>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<tbody>
			<tr class="wrdLatest">
<?php
$i=1;
foreach ($list as $lt)
{
	$file_info = explode(".", $lt->file_name);
	if(is_file('./uploads/'.$file_info[0]."_thumb.".$file_info[1]))
	{
		$thumb_img = '/uploads/'.$file_info[0]."_thumb.".$file_info[1];
	}
	else
	{
		$thumb_img = '/uploads/'.$lt->file_name;
	}
?>

				<th scope="row">
					<img src="<?php echo $thumb_img;?>"><br>
					<a rel="external" href="/controlls/view/<?php echo $lt->id;?>"><?php echo $lt->subject;?></a> <br>
					<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time>
				</th>
<?php
	if($i % 2 == 0)
	{
?>
			</tr>
			<tr class="wrdLatest" id="<?php echo $i?>">
<?php
	}
	$i++;
}
?>
			</tr>
			</tbody>

		</table>
		<div id="lastPostsLoader"></div>
</article>
</div>