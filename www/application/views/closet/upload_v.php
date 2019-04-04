<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="/favicon.ico">
	<!-- <link href="/assets/css/jquery.rating.css" rel="stylesheet" type="text/css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.css" media="screen"> -->
	<link rel="stylesheet" type="text/css" href="/statics/css/style.css">
	<link rel="stylesheet" type="text/css" href="/statics/css/main.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
	<!-- <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css"> -->

	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="/assets/css/bootstrap-modal.css" rel="stylesheet" />

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<!--<script src="/statics/js/bootstrap.min.js"></script>-->
	
	<script src="/assets/js/bootstrap-modalmanager.js"></script>
	<script src="/assets/js/bootstrap-modal.js"></script>

	<!--<script src="/assets/js/jquery.rating.js"></script>
	<script src="/assets/js/jquery.MetaData.js"></script>
	<script src="/assets/js/jquery.rating.pack.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>-->

	<script type="text/javascript" src="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap.js"></script>
    
	<script src="/assets/js/html5.js"></script>
	<script src="/assets/js/respond.js"></script>
	

	<script type="text/javascript">

		$(function(){
			$.fn.modalmanager.defaults.resize = true;

			$('[data-source]').each(function(){
			var $this = $(this),
			$source = $($this.data('source'));

			var text = [];
			$source.each(function(){
			var $s = $(this);
			if ($s.attr('type') == 'text/javascript'){
			text.push($s.html().replace(/(\n)*/, ''));
			} else {
			text.push($s.clone().wrap('<div>').parent().html());
			}
			});

			$this.text(text.join('\n\n').replace(/\t/g, '    '));
			});

			prettyPrint();
		});
	</script>


	<script id="dynamic" type="text/javascript">
		$('.dynamic .demo').click(function(){
			var tmpl = [
			// tabindex is required for focus
			'<div class="modal hide fade" tabindex="-1">',
			'<div class="modal-header">',
			'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
			'<h3>Modal header</h3>', 
			'</div>',
			'<div class="modal-body">',
			'<p>Test</p>',
			'</div>',
			'<div class="modal-footer">',
			'<a href="#" data-dismiss="modal" class="btn">Close</a>',
			'<a href="#" class="btn btn-primary">Save changes</a>',
			'</div>',
			'</div>'
			].join('');
			$(tmpl).modal();
		});
	</script>
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
<body style="background-color:#e6e6fa;">
	<div class="page-container">
		<div id="wrap">
			<div id="site-header-wrap">
				<header id="site-header">
					<div id="site-header-inner">                    
						<hgroup id="site-logo">
							<h1><a href="/main/delaying_index"><img src="/assets/showindow_gray.png"></a></h1>
							<!-- <img src="images/logo.png" title="Responsive Menu" /> -->
						</hgroup>
			 
						<!-- mobile switch button -->
						<nav id="menu-switch-wrap">						
							<div id="menu-switch"></div>						
						</nav>
					</div><!-- #site-header-inner -->
			 
					<nav id="site-nav">
						<ul>
							<li>
								<a class="home" href="/main/delaying_index"><span class="icon"></span>Home</a>
							</li>
							<li>
								<a class="morefavor" href="/register/moreFavor"><span class="icon"></span>More Favor</a>						
							</li>
							<li>
								<a class="closet" href="/mycloset/index/<?php echo $user_id; ?>"><span class="icon"></span>My Closet</a>
							</li>
							<li>
								<a class="whatisthat" href="/main/whatservice"><span class="icon"></span>SHOWINDOW는?</a>
							</li>
							<li>
								<?php
								/*	if(isLogin()==1){
										echo '<a class="logout" href="/main/whatservice#"><span class="icon"></span>Log Out</a>';
									}else{
										echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
									}*/
								?>
								<a class="logout" onClick="javascript:logout();" href="/intro"><span class="icon"></span>Log Out</a>
							</li>

						</ul>
					</nav><!-- #site-nav -->
				</header>
			</div>


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

			<div id="content">
				<article id="board_area">					
					<div>
						<img src="<?php echo $item_img;?>" id="card_img"/>
						<?php
							$attributes =array('role' => 'form', 'id' => 'upload_action');
							echo form_open_multipart('/mycloset/scrab',$attributes);
							?>
							<fieldset>
								<div style="margin-left:10px" class="row">
									<div style="background-color: #fff" class="form-group col-md-10 col-md-offset-2">
										<div style="margin-left:10px" class="row">
											<div class="col-md-7">
												<label class="control-label" for="input1"><?php echo $thead[5];?></label>
												<textarea rows="7" class="form-control" id="input1" name="<?php echo $thead[5];?>" value="<?php set_value($thead[5]);?>" placeholder="<?php echo $thead[5];?>을 써주세요."></textarea>								
											</div>
										</div>	
										<div style="margin-left:10px" class="row">
											<p class="help-block"><?php echo validation_errors()?></p>
										</div>				
										<input type="hidden" name="item_id" value="<?php echo $item_tid;?>"/>
										<input type="hidden" name="gender" value="<?php echo $gender;?>"/>
										<input type="hidden" name="page" value="<?php echo $page;?>" />
										<div style="margin-left:10px" class="row">
											<div class="col-md-3 ">
											</div>
											<div style="background-color: #fff" class="form-actions col-md-4">
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
			</div>
		</div>
	</div>


<script>
		jQuery(function($) {
			var open = false;
			 
			function resizeMenu() {
				if ($(this).width() < 480) {
					if (!open) {
						$("#site-nav").hide();
					}
					$("#menu-switch").show();                        
				} else if ($(this).width() >= 480) {
					if (!open) {
						$("#site-nav").show();
					}
					$("#menu-switch").hide();                        
				}
			}
			 
			function setupMenuButton() {
				$("#menu-switch").click(function(e) {
					e.preventDefault();
			 
					if (open) {
						$("#site-nav").fadeOut();
						$("#menu-switch").toggleClass("selected");
					}
					else {
						$("#site-nav").fadeIn();
						$("#menu-switch").toggleClass("selected");
					}
					open = !open;
				});
			}
			 
			 
			$(window).resize(resizeMenu);
			 
			resizeMenu();
			setupMenuButton();
			});
	</script>

	
</body>

</html>