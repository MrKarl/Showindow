<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="/assets/css/jquery.rating.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.css" media="screen">
	<link rel="stylesheet" type="text/css" href="/statics/css/style.css">
	<link rel="stylesheet" type="text/css" href="/statics/css/main.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="/statics/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.rating.js"></script>
	<script src="/assets/js/jquery.MetaData.js"></script>
	<script src="/assets/js/jquery.rating.pack.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script>
	function mk_modal(item_id,image_path,gender,card_id){
		$.ajax({
				url: "/mycloset/mk_modal",
				type: "POST",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
				dataType: "html",
				data:{
					"item_id":item_id,
					"image_path":image_path,
					"gender":gender,
					"card_id":card_id,
					"table":"table_card",
				},
				complete:function(xhr,textStatus){
						if(xhr.responseText == 1000)
						{
							alert('댓글 내용을 입력하세요');
						}
						else if(xhr.responseText == 2000){
							alert('다시 입력하세요');
						}
						else if(xhr.responseText == 9000){
							alert('로그인하셔야 합니다.');
						}
						else
						{
							$(".modal_contents").html(xhr.responseText);
						}
				}
			});
		card_num=card_id;
		$.ajax({
				url: "/mycloset/get_comment",
				type: "POST",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
				dataType: "html",
				data:{
					"card_id":card_id,
				},
				complete:function(xhr,textStatus){
						if(xhr.responseText == 1000)
						{
							alert('댓글 내용을 입력하세요');
						}
						else if(xhr.responseText == 2000){
							alert('다시 입력하세요');
						}
						else if(xhr.responseText == 9000){
							alert('로그인하셔야 합니다.');
						}
						else
						{
							$(".replysection").html(xhr.responseText);
						}
				}
		});
		$('#myModal').modal('show');

		}
		window.fbAsyncInit = function() {
			FB.init({
				// http://ec2-54-238-154-75.ap-northeast-1.compute.amazonaws.com/ 259326767583647
				// http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/ 259326767583647
			// appId      : '232266203646743'(명주),	259326767583647(판기)			// 시험용 앱
				appId      : '259326767583647',					// 실제 서비스 앱
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
				});
		};
		// Load the SDK asynchronously
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));

		function logout(){
			FB.logout(function(response){
				location.replace("../intro");
			});
			location.replace("../intro");
		}		

		function mk_comment(){
		$.ajax({
				url: "/mycloset/mk_comment",
				type: "POST",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
				dataType: "html",
				data:{
					"card_id":card_num,
					"comment":encodeURIComponent($("#comment_input").val()),
					"table":"table_card",
				},
				complete:function(xhr,textStatus){
						if(xhr.responseText == 1000)
						{
							alert('댓글 내용을 입력하세요');
						}
						else if(xhr.responseText == 2000){
							alert('다시 입력하세요');
						}
						else if(xhr.responseText == 9000){
							alert('로그인하셔야 합니다.');
						}
						else
						{
							$(".replysection").html(xhr.responseText);
						}
				}
			});
		$('#myModal').modal('show',true);

		}
	</script>
	
	<title>SHOWINDOW :: 패션의 중심</title>	
</head>
<body>
<nav class="navbar navbar-defauelement " role="navigation">
	<div class="container">
		 <div class="collapse navbar-collapse navbar-ex1-collapse">
		 	<form class="navbar-form navbar-left" role="search">
		      <button type="button" class="btn btn-defauelement" onclick="logout()">log out</button>
		    </form>
		 	
		 	<div id="logo">
			<a href="."><img src="/assets/showindow_gray.png"></a>
			</div>
		 	 <ul class="nav navbar-nav navbar-right">
		 	 	<li class="dropdown">
				    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			          <li><a href="/main">Go to main</a></li>
			          <li><a href="/mycloset">Go to my closet</a></li>
			        </ul>
			    </li>
			  </ul>
		</div>
	</div>
</nav>
	<div class="container">
		<section class="userBased">
			<?php
				$i=0;
				foreach($data['items'] as $element){					
			?>

				<div class="card" id="card<?php echo $i; ?>">
					<div class="image">
						<a href="#" data-toggle="modal" 
							onclick="mk_modal(	'<?php echo $element['item_info'][0]->tid;?>',
				 								'<?php echo $element['item_info'][0]->item_path.$element['item_info'][0]->item_name;?>',
				 								'<?php echo $data['gender'];?>',
				 								'<?php echo $element['card_id'];?>')">
				 			<img src="<?php echo $element['item_info'][0]->item_path.$element['item_info'][0]->item_name; ?>"/>
						 </a>
		 			</div>
					<div class="imagename"></div>
					<div class="star">
						<?php
						echo '
      					<div class="rating_item">
							<div id="rating#'.$i.'">예상평점:';
								for($j=0; $j<$element['rating']; $j++){
									// echo "<img src=\"".."\"/>";
									echo "<img src=\"/assets/star_score.gif\"/>";
								}
								echo '
							</div>
						</div>
						';


						?>
					</div>
					<?php
						$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'share');
						echo form_open_multipart('/main/scrab_form',$attributes);
					?>
						<input type="hidden" name="item_img" value="<?php echo $element['item_info'][0]->item_path.$element['item_info'][0]->item_name;?>"/>
						<input type="hidden" name="item_tid" value="<?php echo $element['item_info'][0]->tid;?>"/>
						<input type="hidden" name="gender" value="<?php echo $data['gender'];?>"/>
						<button type="submit" class="btn btn-defauelement"><span class="glyphicon glyphicon-heart-empty"></button>
					</form>
				</div>

				<?php
					$i++;
					}
				?>

					<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				      </div>
				      <div class="modal-body">
				      	<div class="modal_contents">
				      	</div>
				      	<div class="modalreply">
							<div class="input_reply">
									<div class="rp_id" for="input1">아이디</div>
									<input type="text" class="text_bar" id="comment_input" name="reply" value="<?php set_value('reply');?>" placeholder="댓글을 써주세요."/>
									<div class="rp_button">
									<button onclick="mk_comment()" class="btn btn-primary" id="write_btn">작성</button>
									</div>
							</div>
							<div class="replysection">
							</div>
						</div>
					  </div>
				      <div class="modal-footer">
				      </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
		</section>

</body>

</html>