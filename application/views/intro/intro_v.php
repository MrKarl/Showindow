<!DOCTYPE html>
<!-- 
	Login 페이지 뷰
	작성자 : 이명주
	View name : intro_v
	View info : 회원가입 및 로그인 페이지
-->
<html>
<!--                 <HEAD>                 -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="/statics/css/style.css">

		<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">

		<link rel="stylesheet" type="text/css" href="/statics/css/intro.css">
		<link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">
		
		<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet" />
		<link href="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
		<!-- <link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet" /> -->
		<link href="/assets/css/bootstrap-modal.css" rel="stylesheet" />


		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

		<script src="/assets/js/bootstrap-modalmanager.js"></script>
		<script src="/assets/js/bootstrap-modal.js"></script>
	    
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



		<title>
			SHOWINDOW :: 당신의 스타일을 위하여
		</title>
		<div id="fb-root"></div>
		<script>

		var isEmailValidate = "false";

		window.fbAsyncInit = function() {

			$('#emailRegister').modal({
			  show: false
			});

			$('#emailRegister').modal('hide');

			FB.init({
				// http://ec2-54-238-154-75.ap-northeast-1.compute.amazonaws.com/ 259326767583647
				// http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/ 259326767583647
			// appId      : '232266203646743'(명주),	259326767583647(판기)			// 시험용 앱
				appId      : '259326767583647',					// 실제 서비스 앱
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
				});
				// Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
				// for any authentication related change, such as login, logout or session refresh. This means that
				// whenever someone who was previously logged out tries to log in again, the correct case below 
				// will be handled. 
				
				FB.Event.subscribe('auth.authResponseChange', function(response) {
					
				// Here we specify what we do with the response anytime this event occurs. 
				if (response.status === 'connected') {
				  // The response object is returned with a status field that lets the app know the current
				  // login status of the person. In this case, we're handling the situation where they 
				  // have logged in to the app.

				  testAPI();
				} else if (response.status === 'not_authorized') {
				  // In this case, the person is logged into Facebook, but not into the app, so we call
				  // FB.login() to prompt them to do so. 
				  // In real-life usage, you wouldn't want to immediately prompt someone to login 
				  // like this, for two reasons:
				  // (1) JavaScript created popup windows are blocked by most browsers unless they 
				  // result from direct interaction from people using the app (such as a mouse click)
				  // (2) it is a bad experience to be continually prompted to login upon page load.
				  FB.login();
				} else {
				  // In this case, the person is not logged into Facebook, so we call the login() 
				  // function to prompt them to do so. Note that at this stage there is no indication
				  // of whether they are logged into the app. If they aren't then they'll see the Login
				  // dialog right after they log in to Facebook. 
				  // The same caveats as above apply to the FB.login() call here.
				  FB.login();
				}

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

		// Here we run a very simple test of the Graph API after login is successful. 
		// This testAPI() function is only called in those cases. 
		//페북 이메일과 비밀번호 작성 후 로그인 버튼 클릭 실행하는 function
		//수행 순서는 Facebook reference들 밖의 코드들이 제일 먼저->FB.getLoginStatus->FB.api
		//이렇기 때문에 FB.api 안에다 form_send 함수를 넣었다.
		function login(){
			 FB.login(function(response) {
			 },{scope:'basic_info,email,user_birthday,user_likes,user_location'});
		}

		function testAPI() {
			var id;
			var id_type;
			var user_type;
			var name;
			var gender;
			var link;
			var email;
			var birthday;
			var nation;
			var link;
			var user_info;
			var info_title;
			//유저 정보 가져오기
 			 
			FB.api('/me', function(response) {
				id_type=0;
				user_type=0; //user_type 받는게 필요할듯? 아니면 이거는 따로??
				name=response.name;
				gender=response.gender;
				link=response.link;
				email=response.email;
				birthday=response.birthday;
				nation=response.locale;
				link=response.link;
				password="";
			    user_info = new Array(id,password,id_type,user_type,name,gender,link,email,birthday,location,nation,link);
			    info_title = new Array('id','password','id_type','user_type','name','gender','link','email','birthday','location','nation','link');
 			    //유저정보 전송 함수
			    form_send(user_info,info_title);
			});

			//유저 아이디 가져오기
			FB.getLoginStatus(function(response) {
			  if (response.status === 'connected') {
			    // the user is logged in and has authenticated your
			    // app, and response.authResponse supplies
			    // the user's ID, a valid access token, a signed
			    // request, and the time the access token 
			    // and signed request each expire
			    id = response.authResponse.userID;
			    var accessToken = response.authResponse.accessToken;
			    var expiresIn = response.authResponse.expiresIn;
			    var signedRequest = response.authResponse.signedRequest

			    //alert("accessToken="+accessToken);
			    //alert("expiresIn="+expiresIn);
			    //alert("signedRequest="+signedRequest);
			  } else if (response.status === 'not_authorized') {
			    // the user is logged in to Facebook, 
			    // but has not authenticated your app
			  } else {
			    // the user isn't logged in to Facebook.
			  }
			 });
		}

		//유저정보 포스트로 전송
		function form_send(user_info,info_title){
			var form = document.createElement("form");
			form.setAttribute("method","post");
			form.setAttribute("action","intro/get_login_info");

				for(i=0;i<info_title.length;i++){
					var info = document.createElement("input");
					info.setAttribute("type","hidden");
					info.setAttribute("name",info_title[i]);
					info.setAttribute("value",user_info[i]);

					form.appendChild(info);
				}
				
			document.body.appendChild(form);
			form.submit();
		}
		//feedback 받은 것 DB 저장 function
		function feedback_send(){
			var subject = document.getElementById("subject").value;
			var detail = document.getElementById("detail").value;
			var email = document.getElementById("email_qna").value;
			//alert(subject+" "+detail+" "+email);
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


		function email_login(){
			var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
			var email_id = document.getElementById("email_login").value;
			var password = document.getElementById("password_login").value;

			if(!email_regex.test(email_id)){
				alert("Email이 유효하지 않습니다.");
				return false;
			}else{
				//continue;//return true;
			}

			$.ajax({
				type: "POST",
				// url: "/intro/get_login_info",
				url: "/intro/login",
				data: {
					id : email_id,
					password : password,
					email : email_id,
					id_type : 1,	// 페이스북유저0 / 이메일 유저1
					user_type : 0,	// 일반유저0 / 쇼핑몰 유저1					
				},
				dataType : "text",
				cache : false,
				success: function(data){
					if(data == "incorrect"){
						// 비밀번호 틀림
						document.getElementById("password_login").value = "";
						document.getElementById("password_login").style.borderColor = "#E34234";
						alert("비밀번호가 틀렸습니다.");
						// document.getElementById("password_login").placeholder = "비밀번호가 틀렸습니다.";
					}else if(data == "unregistered"){
						// 가입이 안되어있음
						resetModal();
						alert("가입되지 않은 이메일입니다.");
						// document.getElementById("email_login").placeholder = "가입되지 않은 이메일입니다.";
					}else if(data == "gotoregister"){
						// 비밀번호 맞음, 레지스터 화면
						$('#emailLogin').modal('hide');
						location.href='http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/register';
					}else{
						// 비밀번호 맞음, 메인화면
						$('#emailLogin').modal('hide');
						// location.href='http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/register';
						location.href='http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/main/delaying_index';
						// location.href='http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com/main';
					}
				}
			});
		}

		function email_validate(){
			var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
			var email_id = document.getElementById("email_register").value;

			if(!email_regex.test(email_id)){
				alert("Email이 유효하지 않습니다.");
				return false;
			}else{
				//continue;//return true;
			}

			$.ajax({
				type: "POST",
				url: "/email_check/make_confirm_string",
				data: {
					email_id : email_id,
				},
				dataType : "text",
				cache : false,
				success: function(data){
					if(data == "ERROR"){
						alert("이미 존재하는 이메일입니다.");	
					}else{
						alert("["+email_id+"] 를 확인하세요.");	
						document.getElementById("email_confirm").disabled = false;
						document.getElementById("password1").disabled = false;
						document.getElementById("password2").disabled = false;
					}
				}
			});
		}

		function email_confirm(){
			var email_id = document.getElementById("email_register").value;
			var string = document.getElementById("email_confirm").value;
			
			$.ajax({
				type: "POST",
				url: "/email_check/email_confirm",
				data: {
					email_id : email_id,
					string : string,
				},
				dataType : "text",
				cache : false,
				success: function(data){
					if(data=="true"){
						// alert("t"+data);
						alert("인증이 성공하였습니다. 패스워드를 입력하세요.");
						isEmailValidate = "true";
					}else{
						// alert("f"+data);
						alert("이메일 인증이 실패하였습니다.");
						isEmailValidate = "false";
					}
					
				}
			});
		}

		function email_register(){
			var email_id = document.getElementById("email_register").value;
			var password1 = document.getElementById("password1").value;
			var password2 = document.getElementById("password2").value;
			var nickname = document.getElementById("nickname").value;
			var gender ;
			if(document.getElementById("male").checked == true){
				gender = "male";
			}else{
				gender = "female";
			}

			if(password1.length < 7){
				alert("Password is too short");
				document.getElementById("password1").style.borderColor = "#E34234";
		        document.getElementById("password2").style.borderColor = "#E34234";
		        document.getElementById("password1").focus();
			}else{
				if (password1 != password2) {
			        alert("Passwords Do not match");
			        document.getElementById("password1").style.borderColor = "#E34234";
			        document.getElementById("password2").style.borderColor = "#E34234";
			        document.getElementById("password1").focus();
			    }else if(nickname.length < 1){
			    	alert("닉네임을 입력해주세요.");
			    	document.getElementById("nickname").style.borderColor = "#E34234";
			    	document.getElementById("nickname").focus();
			    }else {
			 		if(isEmailValidate == "true"){
						$.ajax({
							type: "POST",
							// url: "/intro/get_login_info",
							url: "/intro/register",
							data: {
								id : email_id,
								password : password1,
								email : email_id,
								id_type : 1,	// 페이스북유저0 / 이메일 유저1
								user_type : 0,	// 일반유저0 / 쇼핑몰 유저1
								gender : gender,
								nickname : nickname,
							},
							dataType : "text",
							cache : false,
							success: function(data){//DB에 들어가서 해당 이메일 아이디가 중복되면, Denied
								
								// if(data="sucess")
								alert("가입이 성공하였습니다.");
								$('#emailRegister').modal('hide');
								// else
							}
						});
					}else{						
						alert("이메일 인증이 실패하였습니다.");
					}
			    }
			}			
		}

		function resetModal(){
			document.getElementById("email_login").value = "";
			document.getElementById("password_login").value = "";

			document.getElementById("email_register").value = "";
			document.getElementById("email_confirm").value = "";
			document.getElementById("password1").value = "";
			document.getElementById("password2").value = "";

			document.getElementById("email_confirm").disabled = true;
			document.getElementById("password1").disabled = true;
			document.getElementById("password2").disabled = true;
			isEmailValidate = "false";
		}

		function setGender(){
			document.getElementById('male_btn').src = document.getElementById('male').checked==true ? 
															"http://54.238.143.240/assets/male_on.png"  :  "http://54.238.143.240/assets/male_off.png";
			document.getElementById('female_btn').src = document.getElementById('female').checked==true ?
			 												"http://54.238.143.240/assets/female_on.png"  :  "http://54.238.143.240/assets/female_off.png";
		}

		</script>
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
	
	</head>

	<body>
	<div class="page-container">
		<div id="wrap">
			<div id="site-header-wrap">
				<header id="site-header">
					<div id="site-header-inner">                    
						<hgroup id="site-logo">
							<h1><a href="/intro"><img src="/assets/showindow_gray.png"></a></h1>
							<!-- <img src="images/logo.png" title="Responsive Menu" /> -->
						</hgroup>
			 
						<!-- mobile switch button -->
						<nav id="menu-switch-wrap">						
							<div id="menu-switch"></div>						
						</nav>
					</div><!-- #site-header-inner -->
			 
					<nav id="site-nav">
						<ul>
 					<!--	<li>
								<?php
								/*	if(isLogin()==1){
										echo '<a class="design" href="/main/delayed_index"><span class="icon"></span>Home</a>';
									}else{
										echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
									}*/
								?>
								<a class="home" href="/intro"><span class="icon"></span>Home</a>
							</li>
							<li>
								<a class="morefavor" href="/moreFavor#"><span class="icon"></span>More Favor</a>						
							</li>
							<li>
								<a class="closet" href="/mycloset/"><span class="icon"></span>My Closet</a>
							</li> -->
							<li>
								<a class="whatisthat" href="/main/whatservice#"><span class="icon"></span>SHOWINDOW는?</a>
							</li>
							<!-- <li>
								<a class="logout" href="/main/whatservice#"><span class="icon"></span>Log Out</a>
							</li>	 -->

						</ul>
					</nav><!-- #site-nav -->

				</header>
			</div>
		


			<div id="content" style="text-align:center;">
	 		<!-- <div id="carousel_div" style="width:100%; margin: 0 auto;">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
					      <div class="item active">
					         <img src="/assets/ca1.png" alt="First slide">
					      </div>
					      <div class="item">
					         <img src="/assets/ca2.png" alt="First slide">
					      </div>
					      <div class="item">
					         <img src="/assets/ca3.png" alt="First slide">
					      </div>
				   </div>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>  -->


			<div id="description">
				<div id="intro_top">
					<div id="intro_body_comment">
						<!-- <h1 id="introduce"><span id="pupple">SHOWINDOW</span>에서 여러분의 스타일을 완성하세요 !!</h1> -->
					</div>

					<div id="gif_the_end">			
					</div>
					<hr/><br/>
					<!-- 로그인, 회원가입 버튼들 -->
					<div id="intro_buttons">
						<div class="login_button">
							<!--로그인 버튼, 거기서 가져오는 permission들-->
							<!--<div class="fb-login-button" scope=
							"basic_info,email,user_birthday,user_likes,user_location" 
							show-faces="false" width="200" max-rows="1"></div>-->
						</div>
						<div class="register_buttons">
							<span class="register_button">
								<button class="fb_button btn btn-large btn-primary" type="button" onclick="login()">
									
									<img src="/assets/facebook.png"/> Facebook 로그인
								</button>
							</span>
							<!-- <span class="register_button">
								<button class="em_button btn btn-large btn-primary" type="button">
									<img src="/assets/email.png"/> E-mail &nbsp;&nbsp;로그인</button>
							</span> -->

							<!-- Button trigger modal -->
							<span class="register_button">
								<!-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#emailLogin" onClick="javascript:resetModal();"> -->
								<button class="btn btn btn-large btn-primary" style="width:211px" data-toggle="modal" href="#emailLogin" onClick="javascript:resetModal();">
								  	<img src="/assets/email.png"/> E-mail &nbsp;&nbsp;로그인</button>
								</button>
							</span>
						</div>
					</div>
				</div>
				

				<hr/><br/><br/>

				<div id="intro_body">
					

					<br/><br/><br/>
					<div id="question">
						<img src="/assets/whatservice.png">
					</div>
					
					<div class="devider">
					</div>
					
					<div id="screenshots">
						<span id="screenshot1"><img src="/assets/screenshot1.png"/></span>
						<span id="screenshot2"><img src="/assets/screenshot2.png"/></span>
						<br/><br/><br/><br/><br/><br/>					
					</div>										
				</div>
			</div>

		</div>
		

		
		<footer id="licence-info" role="licence-info">
	        <small><a href="http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com">SHOWINDOW 당신의패션을 완성하라 !</a></small>
	    </footer>



		
		<div id="modals">

			<!-- Email 로그인 Modal -->
			<div id="emailLogin" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel2">Email 로그인</h4>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span6">
							<span>
								<label width="50px">E-mail : </label>
								<input type="text" placeholder="ex) showindow@handong.edu" id="email_login" data-tabindex="1"/>
							</span> 
							<span>
								<label width="50px">Password : </label>
								<input type="password" id="password_login" data-tabindex="2"/>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="javascript:email_login()">로그인하기</button>
					<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#emailRegister" onClick="javascript:resetModal();">
						<img src="/assets/email.png"/> E-mail 가입하기
					</button>       
				</div>
			</div>

			<!-- Email 가입 Modal -->
			<div id="emailRegister" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel3">Email 가입</h4>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span6">
							<span>
								<label width="50px">E-mail : </label>
								<input type="text" name="email" id="email_register" data-tabindex="1"/>
								<button type="button" class="btn btn-primary" onClick="javascript:email_validate();">인증문자 전송</button>
							</span> 
							<span>
								<label width="50px">이메일 인증문자 입력 : </label>
								<input type="text" name="email_confirm" id="email_confirm" data-tabindex="2"/>
								<button type="button" class="btn btn-primary" onClick="javascript:email_confirm();">인증번호 확인</button>
							</span>
							<span>
								<label width="50px">Password : </label>
								<input type="password" placeholder="8자 이상 적어주세요" name="password1" id="password1" data-tabindex="3"/>
							</span>
							<span>
								<label>Password Confirm : </label>
								<input type="password" placeholder="비밀번호확인" id="password2" data-tabindex="4"/>
							</span>
							<span>
								<label>Nick Name : </label>
								<input type="text" placeholder="닉네임을 입력해주세요." id="nickname" data-tabindex="5"/>
							</span>  
							<span>
								<label>Gender : </label>
								<input type="radio" style="display:none" name="gender" id="male" data-tabindex="6"/>
								<input type="radio" style="display:none" name="gender" id="female" data-tabindex="7"/>
								<img src="assets/male_on.png" id="male_btn" 
								onClick="document.getElementById('male').checked=true; document.getElementById('female').checked=false; javascript:setGender();"/>
								<img src="assets/female_off.png" id="female_btn" 
								onClick="document.getElementById('female').checked=true; document.getElementById('male').checked=false; javascript:setGender();"/>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="javascript:email_register()">가입하기</button>
				</div>
			</div>



		</div>
	</div>
	</body>
</html>
