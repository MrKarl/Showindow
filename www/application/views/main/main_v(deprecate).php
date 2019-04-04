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
					url: "/main/mk_modal",
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
								$(".modal-body").html(xhr.responseText);
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

		function fbLogout(){
			FB.logout(function(response){
				location.replace("./intro");
			});
		}

		//feedback 받기 function
		function feedback_send(){
			var subject = document.getElementById("feedback_subject").value;
			var detail = document.getElementById("feedback_detail").value;
			var email = document.getElementById("feedback_email").value;

			$.ajax({
		   	    type: "POST",
		        url: "/feedback/setFeedback", 
		        data: {
		        	subject : subject,
		        	detail : detail,
		        	email : email,
		    	},
		        dataType : "text",  
		        cache : false,
		        success: function(){
		        	//console.log(subject+",,"+detail+",,"+email);
		        	$('#sidebar_modal').modal('hide');
		        }
	    	});
		}

	</script>
	<title>SHOWINDOW :: 패션의 중심</title>	
</head>
<body>
<nav class="navbar navbar-default " role="navigation">
	<div class="container">
		 <div class="collapse navbar-collapse navbar-ex1-collapse">
		 	<form class="navbar-form navbar-left" role="search">
		      <button type="button" class="btn btn-default" onclick="fbLogout()">log out</button>
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

	<!-- feedback sidebar 부분 -->
			<button id="sidebar" data-toggle="modal" data-target="#sidebar_modal" 
			style="position:fixed; left:0px; top:45%; float:left;">
				<img src="/assets/QnA.png" style="width:20px; height:40px;">
			</button>
			
			<div class="modal fade" tabindex="-1" id="sidebar_modal" role="dialog" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">
				        	<div class="feedback_title">
				        		문제점? 개선할 점?
				        	</div>
				        </h4>
			      </div>
			      		<div class="modal-body">
			      				</p>
						    <input type="text" id="feedback_subject" placeholder="문제점이나 개선할 점을 적어주세요" style="width:100%;"/>
								</p>
							<textarea rows="4" id="feedback_detail" placeholder="자세한 내용을 적어주세요" style="width:100%;"></textarea>
								</p>
						    <input type="email" id="feedback_email" placeholder="이메일을 적어주세요" style="width:100%;"/>
						    	</p>
			      		</div>
			      		<div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
       						<button type="button" class="btn btn-primary" onclick="feedback_send()">알려주기</button>
			      		</div>
			      	
			    </div><!-- /.modal-content -->
			  </div><!--/.modal-dialog -->
			</div><!-- /.modal -->


<!--
	<div id="wrap">
		<div id='header'>
			<div class="btn-group" id="menuList">
			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="/mycloset">Go to My closet</a></li>
			      <li><a href="/main">Go to Main Page</a></li>
			    </ul>
			 </div>
			<div id="logo">
				<!-- img src="/assets/showindowWithICON.png"> -->
		<!--		<a href="."><img src="/assets/showindow_gray.png"></a>
			</div>
			<div class="btn-group" id="userData">
				<button type="button" class="btn btn-default" onclick="fbLogout()">log out</button>
			</div>
		</div> -->
	<!--	
		<div id="logout" style="position:absolute;float:right;left:90%;top:20px;">
			<?php
				//echo form_open('/logout');
				//echo form_submit('submit','로그아웃');
				$string = "</div></div>";
				//echo form_close($string);
			?>
		</div>	
		-->
		
		
<!--		
		<div id="top_mar" style="display:none;"></div>	
		

	</div>
-->
	<div class="container ">
		<section class="userBased">
			<?php
				$i=0;
				foreach($list as $lt){
					$i++;
			?>

				<div class="card" id="card<?php echo $i; ?>">
					<?php
						echo '<div class="image"><img src="'.$lt['image_path'].$lt['item_name'].'"/></div>';
						?>
					<div class="imagename">
						<a href="#" data-toggle="modal" 
							onclick="mk_modal('<?php echo $lt["tid"];?>','<?php echo $lt["image_path"].$lt["item_name"];?>',
											'<?php echo $lt["gender"];?>','<?php echo $lt["card_id"];?>')">
											<?php echo $lt['item'];?>
						</a>
					</div>
					<div class="star">
						<?php
						echo '
      					<div class="rating_item">
							<div id="rating#'.$i.'">
								<input name="'.md5($lt['tid'])."_".$i.'" type="radio" class="auto-submit-star" value="'.$lt['tid'].'-1"/>
								<input name="'.md5($lt['tid'])."_".$i.'" type="radio" class="auto-submit-star" value="'.$lt['tid'].'-2"/>
								<input name="'.md5($lt['tid'])."_".$i.'" type="radio" class="auto-submit-star" value="'.$lt['tid'].'-3"/>
								<input name="'.md5($lt['tid'])."_".$i.'" type="radio" class="auto-submit-star" value="'.$lt['tid'].'-4"/>
								<input name="'.md5($lt['tid'])."_".$i.'" type="radio" class="auto-submit-star" value="'.$lt['tid'].'-5"/>
							</div>
						</div>
						';
						?>
					</div>
					<?php
						$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'share');
						echo form_open_multipart('/main/scrab_form',$attributes);
					?>
						<input type="hidden" name="item_img" value="<?php echo $lt['image_path'].$lt['item_name'];?>"/>
						<input type="hidden" name="item_tid" value="<?php echo $lt['tid'];?>"/>
						<input type="hidden" name="gender" value="<?php echo $lt['gender'];?>"/>
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-heart-empty"></button>
					</form>
				</div>

				<?php
					}
				?>

				<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				        <h4 class="modal-title">card name</h4>
				      </div>
				      <div class="modal-body">
						</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
				        <button type="button" class="btn btn-primary">확인</button>
				      </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
		</section>
		<!-- <section class="itemBased">
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#test" data-toggle="modal" > card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
		</section>
		<section class="friendRecmd">
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#test" data-toggle="modal" > card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
		</section>
		<section class="hotItem">
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
			<div class="card">
				<div class="image">for photo
					<div class="imagename" ><a href="#" data-toggle="modal" data-target="#test"> card name (for link to card)</a></div>
				</div>
				<div class="star">for star</div>
				<div class="share">share</div>
			</div>
		</section>
	</div> -->
	
	
</body>

</html>