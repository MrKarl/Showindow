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
			          <li><a href="#">Go to main</a></li>
			          <li><a href="#">Go to my closet</a></li>
			        </ul>
			    </li>
			  </ul>
		</div>
	</div>
</nav>
<script>
	$(document).ready(function(){
		$("#write_btn").click(function(){
			if ($("#input1").val() == ''){
				alert('글을 작성해 주세요.');
				$("input01").focus();
				return false;
			}
			else{
				$("#upload_action").submit();
			}
		});
	});
</script>
	<article id="board_area" >
		<div class="container">
			<header>
				<h1></h1>

			</header>
			<!-- 
				<form class="form" method="post" action="" id="write_action">
				-->
			<img src="<?php echo $item_img;?>" id="card_img"/>
			<?php
				$attributes =array('role' => 'form', 'id' => 'upload_action');
				echo form_open_multipart('/main/scrab',$attributes);
				?>
				<fieldset>
					<div class="row">
						<div class="form-group col-md-10 col-md-offset-2">
							<div class="row">
								<div class="col-md-7">
									<label class="control-label" for="input1"><?php echo $thead[2];?></label>
									<!-- 
									thead[0] = tid
									thead[1] = user_id
									thead[2] = gender
									thead[3] = item_id
									thead[4] = item_description
									thead[5] = contents
									thead[6] = comment_id
									thead[7] = isOriginal
									thead[8] = point -->
									<textarea rows="7" class="form-control" id="input1" name="<?php echo $thead[5];?>" value="<?php set_value($thead[5]);?>" placeholder="<?php echo $thead[5];?>을 써주세요."></textarea>
								</div>
							</div>	
							<div class="row">
								<p class="help-block"><?php echo validation_errors()?></p>
							</div>				
							<input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
							<input type="hidden" name="item_id" value="<?php echo $item_tid;?>"/>
							<input type="hidden" name="gender" value="<?php echo $gender;?>"/>
							<div class="row">
								<div class="col-md-3 ">
								</div>
								<div class="form-actions col-md-4">
									<button type="submit" class="btn btn-primary col-md-5 col-md-offset-1" id="write_btn">작성</button>
									<button type="reset" class="btn col-md-5 col-md-offset-1" onclick="history.back()">취소</button>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
			<?php
				if(@$error){
					echo $error."<br>";
				}
			?>
		</div>
	</article>

</body>

</html>