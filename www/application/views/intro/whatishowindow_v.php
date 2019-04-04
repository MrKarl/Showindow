<!DOCTYPE html lang="ko">
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="/assets/js/html5.js"></script>
	<script src="/assets/js/respond.js"></script>
	<title>
			SHOWINDOW :: 당신의 스타일을 위하여
	</title>

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
	<!-- logout 부분 -->
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

		function logout(){
			var	id_type = <?php echo $id_type; ?>;

			FB.getLoginStatus(function(response) {
				console.log(response.status);
			  if (response.status === 'connected') {


			    // the user is logged in and has authenticated your
			    // app, and response.authResponse supplies
			    // the user's ID, a valid access token, a signed
			    // request, and the time the access token 
			    // and signed request each expire

			    if(id_type == 0){
					FB.logout(function(response){
						location.replace("/intro");
				});
			}
			  } else if (response.status === 'not_authorized') {
			    // the user is logged in to Facebook, 
			    // but has not authenticated your app
				location.replace("/intro");
			  } else {
			    // the user isn't logged in to Facebook.
			    location.replace("/intro");
			  }
			 });
			if(id_type == 1)
				location.replace("/intro");
			
		}
	</script>
</head> 

<body>
<div id="wrap">
	<div id="site-header-wrap">
		<header id="site-header">
			<div id="site-header-inner">                    
				<hgroup id="site-logo">
					<?php
						if($user_id != -1){
							echo '<h1><a href="/main/delaying_index"><img src="/assets/showindow_gray.png"></a></h1>';
						}
						else{
							echo '<h1><a href="#"><img src="/assets/showindow_gray.png"></a></h1>';	
						}
					?>
					<!-- <img src="images/logo.png" title="Responsive Menu" /> -->
				</hgroup>
	 
				<!-- mobile switch button -->
				<nav id="menu-switch-wrap">						
					<div id="menu-switch"></div>						
				</nav>
			</div><!-- #site-header-inner -->
	 
			<nav id="site-nav">
				<ul>
					<!-- 로그인 하고 Whatishowindow에 들어왔다면! -->
				<?php
					if($user_id != -1){
				?>
						<li>
							<?php
							/*	if(isLogin()==1){
									echo '<a class="design" href="/main/delayed_index"><span class="icon"></span>Home</a>';
								}else{
									echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
								}*/
							?>
							<a class="home" href="/main/delaying_index"><span class="icon"></span>Home</a>
						</li>
						<li>
							<a class="morefavor" href="/register/moreFavor"><span class="icon"></span>More Favor</a>						
						</li>
						<li>
							<a class="closet" href="/mycloset/index/<?php echo $user_id; ?>"><span class="icon"></span>My Closet</a>
						</li>
						<li>
							<a class="whatisthat" href="/main/whatservice#"><span class="icon"></span>SHOWINDOW는?</a>
						</li>
						<!-- <li>
					  <?php
						/*	if(isLogin()==1){
								echo '<a class="logout" href="/main/whatservice#"><span class="icon"></span>Log Out</a>';
							}else{
								echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
							}*/
						?>
						</li> -->
						<li>
							<a class="logout" href="#" onClick="logout()"><span class="icon"></span>Log Out</a>
						</li>
						<!-- 만약 로그인 없이 Whatishowindow에 들어왔다면! -->
				<?php
					}else{
				?>
						<li>
							<a class="home" href="/intro"><span class="icon"></span>Home</a>
						</li>
				<?php
					}
				?>						
				</ul>
			</nav><!-- #site-nav -->

		</header>
	</div>
	
	<div id="content" style="text-align:center;">
		<div id="gif_the_end">			
		</div>

		<hr/>
		
		<div id="tuto1">
			
			<br/><h4 style="text-align:left; color:black; font-weight:bold;">1. Showindow 는 무엇인가요?</h4>
			<div>
				<img src="/assets/introduce_register1.png"/>
			</div> 
			<p style="text-align:left; color:black; margin-left:10px;"> 
				<br/>&nbsp;&nbsp;여러분의 패션 아이템 평가정보와 다른 유저들과의 유사 관계를 통해서 최선의 패션 아이템을 추천해드리는 서비스입니다. !<p/>									
			</p>
		</div>

			
		<hr/ height="3px">
		<div id="tuto2">
			
			<br/><h4 style="text-align:left; color:black;">2. 무엇을 해야하나요?</h4>
			<div>
				<img src="/assets/introduce_register2.png"/>
			</div> 			
		</div>
		

		<hr/>
		<div id="tuto3">
			
			<br/><h4 style="text-align:left; color:black;">3. 평가가 모두 끝나면 !!</h4>
			<div>
				<img src="/assets/introduce_register3.png"/>
			</div> 
			<p style="text-align:left; color:black; margin-left:10px;"> 
				&nbsp;&nbsp;가입시에 평가한 패션 선호 정보를 바탕으로 고객님에게 가장 어울리는 패션 코디를 추천해드립니다.
				<br/><br/>&nbsp;&nbsp;더욱 많이 평가할 수록, 더 정확한 추천이 이뤄집니다!<p/>									
			</p>
		</div>

		<hr/>


		
		
	</div>


	<br/><br/><br/><br/>
	<footer id="licence-info" role="licence-info">
        <small><a href="http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com">SHOWINDOW 당신의패션을 완성하라 !</a></small>
    </footer>

</div>
</body>
</html>