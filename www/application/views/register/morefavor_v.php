<?php
	$num_items = count($items);	
	// var_dump($gender);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width">

	<link rel="shortcut icon" href="/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/statics/css/style.css">
	<link rel="stylesheet" type="text/css" href="/statics/css/register.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
	
	


	<link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">

	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="/assets/css/bootstrap-modal.css" rel="stylesheet" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	
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

	<!-- -->
	<link href="/assets/css/jquery.rating.css" rel="stylesheet" type="text/css">	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="/statics/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.rating.js"></script>
	<script src="/assets/js/jquery.MetaData.js"></script>
	<script src="/assets/js/jquery.rating.pack.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script>
		$(function(){ // wait for document to load

			$('#num_rating').html(<?php echo $num_rating;?>);

			var numOfRating = 0;
			var user_id = <?php echo $user_id.";"; ?>
			var items =  new Array();
	
			$('.auto-submit-star').rating({
			 	callback: function(value, link){
				 	var item_id = value.split('-')[0];
				 	var item_rating = value.split('-')[1];
				 	var gender = <?php echo "\"".$gender."\""; ?>;

				 	
				 	if(-1 == items.indexOf(item_id)){
			 			items.push(item_id);
				 	}			 	
				 	numOfRating = items.length;

				 	if(numOfRating == <?php echo $num_items; ?>){
				 		
				 	}



				 	// AJAX 이용해서, 평가 데이터를 바로 database에 등록함
					$.ajax({
				   	    type: "POST",
				        url: "/favor/register_favor", 
				        data: {
				        	user_id : user_id,
				        	item_rating : item_rating,
				        	item_id : item_id,
				        	gender : gender
				    	},
				        dataType : "text",  
				        cache : false,
				        success: function(data){
				        	var ret = JSON.parse(data);
				        	$('#num_rating').html(ret['num_rating']);
			            }
			    	});
				
			}});
			 	
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

			/*function logout(){
				var id_type = <?php echo $data['id_type']; ?>;
				if(id_type == 0){
					FB.logout(function(response){
						location.replace("/intro");
					});
				}else{
					location.replace("/intro");
				}
			}		*/

		function logout(){
			var id_type =<?php echo $id_type; ?>;

			FB.getLoginStatus(function(response) {
				console.log(response.status);
			  if (response.status === 'connected') {

			    // the user is logged in and has authenticated your
			    // app, and response.authResponse supplies
			    // the user's ID, a valid access token, a signed
			    // request, and the time the access token 
			    // and signed request each expire

			    if(id_type == 0){
			    	console.log(response.status+"~~~~~~~~~~~~~~~~~~~~~~~~~~");
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
			if(id_type == 1){
				location.replace("/intro");
			}
			
		}
	</script>

	<style>
		ul{

			list-style-type:none;
			margin:0;
			padding:0;
		}
		.type li{
			display:inline;
		}
		.type li a{
			
			/* Opera */
			box-shadow:10px 10px 10px silver;
			/* Firefox */
			-moz-box-shadow:10px 10px 10px silver;
			/* Safiri, Chrome */
			-webkit-box-shadow:10px 10px 10px silver;
			/* IE */
			filter:progid:DXImageTransform.Microsoft.Shadow(color=silver,direction=135, strength=20);

			width:150px;
		}
		a:hover{
			text-decoration: none;	
		}
	</style>



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
	

			<div id="content">
				<span>
<?php
					echo $name." 고객님, <span id='num_rating'></span>개 평가하셨습니다.";
?>
				</span>
				<hr/>

				<ul class="type">
					<li>
						<a href="/register/moreFavor/0"><span>Randomly</span></a>
					</li>
					<li>
						<a href="/register/moreFavor/1"><span>상의 자켓</span></a>
					</li>
					<li>
						<a href="/register/moreFavor/2"><span>상의 셔츠</span></a>
					</li>
<?php			if($gender == 'female'){?>
					<li>
						<a href="/register/moreFavor/3"><span>상의 블라우스</span></a>
					</li>
<?php			}?>
					<li>
						<a href="/register/moreFavor/4"><span>하의 바지</span></a>
					</li>
<?php			if($gender == 'female'){?>
					<li>
						<a href="/register/moreFavor/5"><span>하의 치마</span></a>
					</li>
<?php			}?>
				</ul>

				<span>
					<a href="/register/moreFavor/<?php echo $type;?>">
						<img src="/assets/refresh.png"/ style="width:50px; height:50px; float:right;"/>
					</a>
				</span>

				<hr/>


				<div class="items_list">
<?php
				$i = 0;		
				foreach ($items as $item){
					echo '
					<div class="item_panel">					
						<div class="item">							
							<div id="item#'.$i.'">
								<img src="'.$item->item_path.$item->item_name.'">
							</div>
						</div>
						<div class="rating_item">
							<div class="rating_contents">
								<div id="rating#'.$i.'">
									<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-1"/>
									<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-2"/>
									<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-3"/>
									<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-4"/>
									<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-5"/>
								</div>
							</div>
						</div>
					
					</div>';
					$i++;
					if($i>29){
						break;
					}
				}
?>		
				</div>			
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