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
	


	<script type="text/javascript">

		function setProgress(progress){           
		    var progress_width = Math.floor(progress * $("#progress_bar").width() / 100);

		//     $("#progress").width(progress_width).html(progress + "% ");
		//     $("#progress").width(progress_width);
		    $("#progress").progressbar({ value: progress});
			// $("#progress").progressbar({ value: 37});		
		}

		function setProgressrate(numOfRating){           
		    $("#progress_ratio").html(numOfRating+"/<?php echo $num_items;?>");
		}

		function showProgressrate(numOfRating){           
			$('#progress_ratio').html(numOfRating+"/<?php echo $num_items; ?>");
		}
	</script>
	<script>
		$(function(){ // wait for document to load
			if(<?php echo $step;?> == 1){
				$('#introducemodal1').modal("show");
			}
			var numOfRating = 0;
			var user_id = <?php echo $user_id.";"; ?>
			var items =  new Array();
			
			// $('#header').css("position","fixed"); 
	  //       $('#header').css("top","0");
	        // $('#progress_section').css("position","fixed");
	        $('#progress_section').css("top","60px");  	
			

			showProgressrate(numOfRating);
			setProgress(numOfRating/<?php echo $num_items; ?>*100);

			$('.auto-submit-star').rating({
			 	callback: function(value, link){
				 	var item_id = value.split('-')[0];
				 	var item_rating = value.split('-')[1];
				 	var step = <?php echo $step; ?>;
				 	var gender = <?php echo "\"".$gender."\""; ?>;

				 	
				 	if(-1 == items.indexOf(item_id)){
			 			items.push(item_id);
				 	}			 	
				 	numOfRating = items.length;

				 	if(numOfRating == <?php echo $num_items; ?>){

				 		if(step == 1){
				 			$('#skip').html('<a href="/register/index/2"><img src="http://54.238.143.240/assets/next_btn.png"/></a>');
				 		}else if(step==2){
							$('#skip').html('<a href="/register/index/3"><img src="http://54.238.143.240/assets/next_btn.png"/></a>');			 			
				 		}else if(gender=="male" && step == 3){
							$('#skip').html('<a href="/main"><img src="http://54.238.143.240/assets/next_btn.png"/></a>');
						}else if(gender=="female" && step == 3){
							$('#skip').html('<a href="/register/index/4"><img src="http://54.238.143.240/assets/next_btn.png"/></a>');
						}else if(gender=="female" && step == 4){
							// $('#skip').html('<a href="/main"><img src="/assets/next_button.jpg"/></a>');
							// $('#skip').html('<a href="/intro/get_login_info"><img src="/assets/next_button.jpg"/></a>');
							$('#skip').html('<a href="/main/delaying_index"><img src="http://54.238.143.240/assets/next_btn.png"/></a>');
							// $('#skip').html('<a href="/main"><img src="/assets/next_btn.png"/></a>');
				 		}
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
				        	/*FOR TEST
				            	// console.log("data = "+data);
				            	// console.log(typeof data);
				        	    if(data=='insert'){	//data='insert'
				        	    	// numOfRating++;	        	    	
				        	    	//console.log("insert // "+ numOfRating);	
				        	    }else{				//data='update'
				        	    	if(-1 == items.indexOf(item_id)){		// already rated		        	    		
				        	    		//console.log("update // "+ items.indexOf(item_id)+"// DB에서만의 업데이트 "+ numOfRating);
				        	    	}else{								//
				        	    		//console.log("update // "+ items.indexOf(item_id)+"// View에서도 업데이트"+ numOfRating);
				        	    	}
				        	    }
							*/
				        	    // numOfRating = items.length;
				        	    $('#progress_ratio').html(numOfRating+"/<?php echo $num_items; ?>");
				        	    //console.log("전체 저장 items // "+ items + " = " + numOfRating);

				        	    setProgress(numOfRating/<?php echo $num_items; ?>*100);
			            }
			    	});
				
			}});
			 	
		});	

	</script>

	<script type="text/javascript">
		function next_introduce(introduce_step){
			if(introduce_step == 1){
				$('#introducemodal1').modal('hide');
				$('#introducemodal2').modal('show');
			}else if(introduce_step == 2){
				$('#introducemodal2').modal('hide');
				$('#introducemodal3').modal('show');
			}else{
				$('#introducemodal3').modal('hide');
			}
		}
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



	<title>SHOWINDOW :: 패션의 중심</title>	
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
							<li>
								<?php
								/*	if(isLogin()==1){
										echo '<a class="design" href="/main/delayed_index"><span class="icon"></span>Home</a>';
									}else{
										echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
									}*/
								?>
								<a class="home" href="/intro"><span class="icon"></span>Home</a>
							</li>
							<!-- <li>
								<a class="morefavor" href="/moreFavor#"><span class="icon"></span>More Favor</a>						
							</li> -->
							<!-- <li>
								<a class="closet" href="/mycloset/"><span class="icon"></span>My Closet</a>
							</li> -->
							<li>
								<a class="whatisthat" href="/main/whatservice#"><span class="icon"></span>SHOWINDOW는?</a>
							</li>
							<li>
								<?php
								/*	if(isLogin()==1){
										echo '<a class="logout" href="/main/whatservice#"><span class="icon"></span>Log Out</a>';
									}else{
										echo '<a class="design" href="/intro"><span class="icon"></span>Home</a>';
									}*/
								?>
								<!-- <a class="logout"  onClick="fbLogout()" href="/main/whatservice#"><span class="icon"></span>Log Out</a> -->
								<a class="logout" onClick="fbLogout();" href="/intro"><span class="icon"></span>Log Out</a>
							</li>	

						</ul>
					</nav><!-- #site-nav -->

				</header>
			</div>
		
<!-- 			
			상단 메뉴바로 insert.
			This is deprecated.
			<div id="logout" style="position:absolute;float:right;left:90%;top:20px;">
				<button type="button" onClick="fbLogout()">
					로그아웃
				</button>
			</div>
-->

			<div id="progress_section">
				<span id="progress_name">
				</span>

				<div id="progress_bar">
					<div id="progress"></div>
				</div>

				<span id="progress_ratio">					
				</span>

				<div id="skip">
					<!-- <img src="/assets/next.png"> -->
				</div>
				
				<div id="descript">
				</div>
			</div>
		
			<div id="top_mar" style="display:none;"></div>
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
							<div id="rating#'.$i.'">
								<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-1"/>
								<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-2"/>
								<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-3"/>
								<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-4"/>
								<input name="'.md5($item->tid)."_".$i.'" type="radio" class="auto-submit-star" value="'.$item->tid.'-5"/>
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

			<?php 
			if($step == 1){
				/*echo '
					<div class="modal" id="introduceModal1">
						<div class="modal-dialog">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					          <h4 class="modal-title">SHOWINDOW 는 ?</h4>
					        </div>
					        <div class="modal-body">
					          <img src="/assets/introduce_register.png"/>
					        </div>
					        <div class="modal-footer">
					          <a id="nextbtn1">추천하러 가기</a>
					        </div>
					      </div>
					    </div>
					</div>';*/

					echo '<div id="modals">
							<!-- INTRODUCE MODAL 1 -->
							<div id="introducemodal1" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel2">Tutorial 1</h4>
									<br/>Showindow 는 무엇인가요?
								</div>
								<div class="modal-body">
									<div class="row-fluid">
										<div class="span9">
											<div>
												<img src="/assets/introduce_register1.png"/>
											</div> 
											<div>
												여러분의 패션 아이템 평가정보와 다른 유저들과의 유사 관계를 통해서 최선의 패션 아이템을 추천해드리는 서비스입니다. !<p/>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-default" onClick="javascript:next_introduce(1);">
										<img src="/assets/next_btn.png"/>NEXT
									</button>       
								</div>										
							</div>

							

							<!-- INTRODUCE MODAL 2 -->
							<div id="introducemodal2" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel2">Tutorial 2</h4>
									<br/>무엇을 해야하나요?
								</div>
								<div class="modal-body">
									<div class="row-fluid">
										<div class="span9">
											<div>
												<img src="/assets/introduce_register2.png"/>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-default" onClick="javascript:next_introduce(2);">
										<img src="/assets/next_btn.png"/>NEXT
									</button>       
								</div>
							</div>

							<!-- INTRODUCE MODAL 3 -->
							<div id="introducemodal3" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel2">Tutorial 3</h4>
									<br/>평가가 모두 끝나면 !!
								</div>
								<div class="modal-body">
									<div class="row-fluid">
										<div class="span9">
											<div>
												<img src="/assets/introduce_register3.png"/>
											</div> 
											<div>
												&nbsp;&nbsp;가입시에 평가한 패션 선호 정보를 바탕으로 고객님에게 가장 어울리는 패션 코디를 추천해드립니다.
												<br/><br/>&nbsp;&nbsp;더욱 많이 평가할 수록, 더 정확한 추천이 이뤄집니다!<p/>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><img src="/assets/next_btn.png"/>DONE</button>
								</div>
							</div>
						</div>';
					}?>
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