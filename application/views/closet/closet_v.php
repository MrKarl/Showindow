<?php
require_once("application/common/item_constants.php");
?>
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
		card_num=0;
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
			var id_type = <?php echo $id_type; ?>;

			FB.getLoginStatus(function(response) {
				// console.log(response.status);
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
						if(xhr.responseText == 1000){
							alert('댓글 내용을 입력하세요');
						}
						else if(xhr.responseText == 2000){
							alert('다시 입력하세요');
						}
						else if(xhr.responseText == 9000){
							alert('로그인하셔야 합니다.');
						}
						else{
							var height = $(window).scrollTop();// $(document).height();
							$(".modal_contents").html(xhr.responseText);							
							$("#cardDeleteBtn").val(card_id);		
							$("#myModal").css("top",height);							
						}
				}
			});
			card_num = card_id;
			$.ajax({
				url: "/mycloset/get_comment",
				type: "POST",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
				dataType: "html",
				data:{
					"card_id":card_id,
				},
				complete:function(xhr,textStatus){
						if(xhr.responseText == 1000){
							alert('댓글 내용을 입력하세요');
						}
						else if(xhr.responseText == 2000){
							alert('다시 입력하세요');
						}
						else if(xhr.responseText == 9000){
							alert('로그인하셔야 합니다.');
						}
						else{
							$(".replysection").html(xhr.responseText);
						}
				}
			});
			$('#myModal').modal('show');

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
							if(xhr.responseText == 1000){
								alert('댓글 내용을 입력하세요');
							}
							else if(xhr.responseText == 2000){
								alert('다시 입력하세요');
							}
							else if(xhr.responseText == 9000){
								alert('로그인하셔야 합니다.');
							}
							else{
								$(".replysection").html(xhr.responseText);
							}
					}
				});
			 document.getElementById("comment_input").value="";
			$('#myModal').modal('show',true);

		}

		function setGender(){
			document.getElementById('male_btn').src = document.getElementById('male').checked==true ? 
															"http://54.238.143.240/assets/male_on.png"  :  "http://54.238.143.240/assets/male_off.png";
			document.getElementById('female_btn').src = document.getElementById('female').checked==true ?
			 												"http://54.238.143.240/assets/female_on.png"  :  "http://54.238.143.240/assets/female_off.png";

			if(document.getElementById('male').checked==true){
				document.getElementById('type_female').style.display= "none";
				document.getElementById('type_male').style.display = "inline";
			}else{
				document.getElementById('type_male').style.display= "none";
				document.getElementById('type_female').style.display = "inline";
			}
		}

		function setCloset(index){
			for(i=0;i<11;i++){
				if(i==index){
					document.getElementById('closet_btn'+i).style.borderWidth="thick thick thick thick";
					document.getElementById('closet_btn'+i).style.borderColor="blue";
					document.getElementById('closet_btn'+i).style.borderStyle="double";
				}else{
					document.getElementById('closet_btn'+i).style.borderStyle="none";
				}
			}


			if(index > 4){
				index = index - 5;
			}
			document.getElementById('closet'+index).checked=true; 
			// mk_attributes(index);
		}
		//radio button 누를때 모달 변경
		function mk_attributes(index){
			$.ajax({
		   	    type: "POST",
		        url: "/mycloset/mk_write_card", 
		        contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
		        data: {
		        	"index":index,
		    	},
		        dataType : "html",  
		        cache : false,
		        complete: function(xhr){
		        	// console.log(xhr.responseText);
		        	$('.closet_attribute').html(xhr.responseText);
		        }
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

	 	function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#view1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

		$(document).ready(function(){
			$("#write_btn").click(function(){
				if($("#input01").val() == ''){
					alert('업로드할 파일을 선택해주세요.');
					$("#input01").focus();
					return false;
				} else {
					$("#upload_action").submit();
				}
			});
		});
		function view(va) { 
			document.getElementById("view1").src = va; 
		} 

		function deleteCard(){
			var card_id = document.getElementById('cardDeleteBtn').value;//this.value();
			var result = confirm("Want to delete?");
			if (!result) {
				alert("취소됨");
    			return;
    		}
			$.ajax({
				type: "POST",
				url: "/card/deleteCard",				
				data:{
					"card_id" : card_id,					
				},
				dataType: "text",
				cache : false,
				sucess: function(data){
						
				}
			});
		}

		function delComment(tid,card_id,uid){
			
			$.ajax({
				type: "POST",
				url: "/card/deleteComment",				
				data:{
					"comment_id" : tid,	
					"card_id" : card_id,				
					"user_id" : uid,
				},
				dataType: "text",
				cache : false,
				complete: function(data){
					if(data.responseText ==1000){
						alert("댓글 삭제는 글쓴이만 가능합니다.");
					}
					else{
						$(".replysection").html(data.responseText);
					}
				}
			});

		}

			function modifyComment(tid,card_id,uid){
			
			$.ajax({
				type: "POST",
				url: "/card/modifyComment",				
				data:{
					"comment_id" : tid,	
					"card_id" : card_id,				
					"user_id" : uid,
				},
				dataType: "text",
				cache : false,
				complete: function(data){
					if(data.responseText ==1000){
						alert("댓글 수정은 글쓴이만 가능합니다.");
					}
					else{
						$(".replysection").html(data.responseText);
					}
				}
			});

		}
	</script>
	

	<script src="/assets/js/masonry.min.js"></script>
	<script src="/assets/js/imagesLoaded.js"></script>
	<script>
		function pinter_layout(){
		   $(function(){
		    	var $container = $('section.userBased');
		    	 $container.imagesLoaded(function() {
		            //(imagesLoaded)이미지가 다 로딩되기 전에 함수가 수행되는 것을 방지하기 위한
		            //jquery 함수이다.
		            $container.masonry({
		                itemSelector: 'div.card'
		            //masonry로, 위의 $container 하위 selector(main_cards_wrapper)를 item으로 지정,
		            //각 item을 float:left;만 해주면 pinterest폼 layout으로 만들어준다.    
		            });
		        });
		    });
		}

		var isLoaded = 1;

		function infiniteScroll(){
			var last_id = $("div.image:last").attr("id");
			$('section.userBased').masonry();
			//$('section.userBased').append('<img src="/assets/Loader2.gif">').masonry('reloadItems');  
			$('section.userBased').imagesLoaded(function() {
				if(!($('#myModal').hasClass('in') || $('#sidebar_modal').hasClass('in') || $('#mkCardModal').hasClass('in'))){
					if(last_id % 9 == 8 && last_id != 0){
						$.ajax({
						    url : "/mycloset/index/<?php echo $user_id; ?>",
						    //ajax로 불러올 페이지의 url (위의 꺼는 controller("ajax_board"의 "more_list"함수))
						    dataType : "html",
						    type : "post",  
						    // post 또는 get
						    data : { "last_id":last_id},
						    // 호출할 url 에 있는 페이지로 넘길 파라메터
						    //이 parameter를 받으려면 맨 위에 쓴 url에서 
						    //$last_id = $this->input->post("last_id",TRUE);
						    //이런식으로 받아서 써야된다. 그냥 써지는게 아님...ㅋ
						    success : function(result){
						       //아래 reloadItems 쓰려면 masonry를 이니셜라이즈 해야한단다..
						       if($('section.userBased').append(result).masonry('reloadItems')){  
						       //이건 result 추가하고 저 main_cards_container 내부에. 
						       //그담에 추가된 아이템 적용해서 다시 masonry 적용하는거.
							       pinter_layout();
							       isLoaded = 1;
						   		}
						    }
						});
					}
				}
			});
		}
		
		
		$(window).scroll(function(){
	        if  ($(window).scrollTop() == $(document).height() - $(window).height()){ 
	        	//(window).scrollTop은 웹 페이지의 제일 위에서부터 현재 위치한 화면까지의 거리(픽셀)
	        	//(document).height는 웹 페이지 전체의 크기(스크롤 범위 다 합친거).
	        	//(window).height는 현재 위치한 화면의 크기 
	        	if(isLoaded == 1){
		        	infiniteScroll();
		        	isLoaded = 0;
		        }
	        } 
		});
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
									<div class="feedback_title">문제점? 개선할 점?</div>
								</h4>
							</div>
							<div class="modal-body">
								<p/><input type="text" id="feedback_subject" placeholder="문제점이나 개선할 점을 적어주세요" style="width:100%;"/><p/>
								<textarea rows="4" id="feedback_detail" placeholder="자세한 내용을 적어주세요" style="width:100%;"></textarea><p/>
								<input type="email" id="feedback_email" placeholder="이메일을 적어주세요" style="width:100%;"/><p/>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
								<button type="button" class="btn btn-primary" onclick="feedback_send()">알려주기</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!--/.modal-dialog -->
				</div><!-- /.modal -->
			
				<div id="top_mar" style="display:none;"></div>	
			



				<!-- <div class="coverstory container row-fluid"> -->
				<div class="coverstory row-fluid">
					<div class="profilelabel span12">
							<span class="idname span9"><a href="/mycloset/index/<?php echo $user_id?>"><?php echo $name;?></a>님의 옷장입니다.</span>

							<span class="profile span3">
								<?php 
									if($id_type == 0){				// FACEBOOK USER 이면,
										echo '<img src="https://graph.facebook.com/'.$session_id.'/picture"/>';
									}else{
										if($gender == "male"){
											echo '<img src="http://54.238.143.240/assets/penguin_male.png"/>';
										}else{
											echo '<img src="http://54.238.143.240/assets/penguin_female.png"/>';
										}
										
									}
								?>					
							</span>			
					</div>
				</div>

				<div class="cards">
					<div>
						<button data-target="#mkCardModal" data-toggle="modal" class="btn btn-primary mk_content_write_btn">글쓰기</button>
					</div>

					<section class="userBased">
<?php
						$i=0;
						foreach($list as $lt){
								
?>
						<div class="card" id="card<?php echo $i; ?>">
							<div class="image" id="<?php echo $i; ?>"><a href="#" data-toggle="modal" onclick="mk_modal('<?php echo $lt["tid"];?>','<?php echo $lt["item_path"].$lt["item_name"];?>','<?php echo $lt["gender"];?>','<?php echo $lt["card_id"];?>')"><img src="<?php echo $lt['item_path'].$lt['item_name'];?>"/></a></div>
							<div class="imagename"></a></div>
							<div class="star"></div>
							<div class="card_texts">
								<font style="font-family:sanserif; font-size:12px; color :#b5b5b5">
<?php
									
									if(strlen($lt['contents']) > 55){
										echo substr($lt['contents'],0,53)."......";
									}else{
										echo $lt['contents']."<br/>";
									}
?>				
								</font>
							</div>
<?php
							$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'closet_share');
							echo form_open_multipart('/mycloset/scrab_form',$attributes);
?>
								<input type="hidden" name="item_img" value="<?php echo $lt['item_path'].$lt['item_name'];?>"/>
								<input type="hidden" name="page" value="mycloset"/>
								<input type="hidden" name="item_tid" value="<?php echo $lt['tid'];?>"/>
								<input type="hidden" name="gender" value="<?php echo $lt['gender'];?>"/>
								<!-- <button type="submit" style="border:0; background-color:#fff;"><img src="/assets/images/glyphicons_019_heart_empty.png"/></button> -->

							</form>
						</div>

<?php
					$i++; 
					if($i >= 9){
						break;
					}
				}
?>
					</section>
				</div>
			</div><!-- div content -->
			
			<div id="modals">
				<!-- 아이템 모달 -->
				<div id="myModal" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">								
						<span align="right">
							<a id="cardDeleteBtn"onclick="javascript:deleteCard()" href="#">삭제</a>&nbsp;|&nbsp;
							<a onclick="javascript:modifyCard()" href="#">수정</a>
						</span>
						<div class="modal_contents"></div>
						<div class="modalreply">
							<div class="input_reply">
								<div class="rp_id" for="input1"><?php echo $my_name;?></div>
								<input type="text" class="text_bar" id="comment_input" name="reply" value="<?php set_value('reply');?>" placeholder="댓글을 써주세요."/>
								<div class="rp_button">
									<font  style="cursor:pointer;"onclick="mk_comment()"  id="reply_write_btn">작성</font>
								</div>
							</div>
							<div class="replysection"></div>
						</div>
					</div>					
					<div class="modal-footer"></div>
				</div>

				<!--사진 업로드용-->
				<div id="mkCardModal" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div id="item_info">
<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'upload_action', 'method' => 'POST');
							echo form_open_multipart('/mycloset/mk_orig_card/'.$tbname, $attributes);
?>							
								<div>
									<div id="gender_select">						
										<span>
											<label>Gender : </label>
											<input type="radio" style="display:none" name="gender" id="male" checked="checked" value="male"/>
											<input type="radio" style="display:none" name="gender" id="female" value="female"/>
											<img src="http://54.238.143.240/assets/male_on.png" id="male_btn" 
											onClick="document.getElementById('male').checked=true; document.getElementById('female').checked=false; javascript:setGender();"/>
											<img src="http://54.238.143.240/assets/female_off.png" id="female_btn" 
											onClick="document.getElementById('female').checked=true; document.getElementById('male').checked=false; javascript:setGender();"/>
										</span>
									</div>
									<br/><br/>
									<div id="type">
										<div id="hidden_type">
<?php
											$array_key = array_keys($type);
							      			$array_val = array_values($type);	  
							      			
							      			for($cnt=0; $cnt < count($array_key); $cnt++){
					      						echo '<input style="display:none" type="radio" name="type" id="closet'.$cnt.'" value="'.$array_val[$cnt].'" />';
							      			} 
?>
										</div>
										<div id="type_select">
											<label>의류 타입 : </label>
											<div id="type_male">
												<table  style="text-align:center;">
													<tr>
														<td>
															<img src="http://54.238.143.240/assets/jacket(male).png" id="closet_btn0" class="closet_img" alt="재킷/코트"
															title="재킷/코트" onClick="setCloset(0)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/shirts(both).png" id="closet_btn1" class="closet_img" alt="셔츠"
															title="셔츠" onClick="setCloset(1)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/pants(both).png" id="closet_btn2" class="closet_img" alt="바지"
															title="바지" onClick="setCloset(2)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/set(male).png" id="closet_btn3" class="closet_img" alt="세트"
															title="세트" onClick="setCloset(3)"/>
														</td>
													</tr>
													<tr>
														<td><font style="font-size:9px">재킷/코트</font></td>
														<td><font style="font-size:9px">셔츠</font></td>
														<td><font style="font-size:9px">바지</font></td>
														<td><font style="font-size:9px">세트</font></td>
													</tr>
												</table>
											</div>	
											<div id="type_female" style="display:none">
												<table style="text-align:center;">
													<tr>
														<td>
									      					<img src="http://54.238.143.240/assets/jacket(female).png" id="closet_btn4" class="closet_img" alt="재킷/코트"
															title="재킷/코트" onClick="setCloset(4)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/onepiece(female).png" id="closet_btn5" class="closet_img" alt="원피스/드레스"
															title="원피스/드레스" onClick="setCloset(5)"/>
															</td>
														<td>
															<img src="http://54.238.143.240/assets/blaus(female).png" id="closet_btn6" class="closet_img" alt="블라우스"
															title="블라우스" onClick="setCloset(6)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/shirts(female).png" id="closet_btn7" class="closet_img" alt="셔츠"
															title="셔츠" onClick="setCloset(7)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/pants(both).png" id="closet_btn8" class="closet_img" alt="바지"
															title="바지" onClick="setCloset(8)"/>
														</td>
														<td>
															<img src="http://54.238.143.240/assets/skirts(female).png" id="closet_btn9" class="closet_img" alt="치마"
															title="치마" onClick="setCloset(9)"/>													
														</td>
														<td>
															<img src="http://54.238.143.240/assets/set(female).png" id="closet_btn10" class="closet_img" alt="세트"
															title="세트" onClick="setCloset(10)"/>
														</td>
													</tr>
													<tr>
														<td><font style="font-size:7px">재킷/코트</font></td>
														<td><font style="font-size:9px">원피스</font></td>
														<td><font style="font-size:9px">블라우스</font></td>
														<td><font style="font-size:9px">셔츠</font></td>
														<td><font style="font-size:9px">바지</font></td>
														<td><font style="font-size:9px">치마</font></td>
														<td><font style="font-size:9px">세트</font></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<br/><br/>

									<label for="input01">사진 업로드</label>
									<img id="view1" src=""/>
									<div>
										<input type="file" class="input-xlarge" id="input01" name="userfile" value="<?php echo set_value('userfile'); ?>" onChange="readURL(this);">
										<span style="font-size:10px color:gray;" class="help-block">의류 사진을 선택해주세요~</span>
									</div>
									<br/><br/>				     				      	
<?php
									for($i = 3 ; $i < 4 ; $i++){
										echo '<labelfor="input01">'.$thead[$i].'</label>
										<div>				      
											<input type="text" id="input'.$i.'" name="'.$thead[$i].'" rows="5"/>'.set_value($thead[$i]).'
										</div>';
										// echo '<labelfor="input01">'.$thead[$i].'</label>
										// <div>				      
										// <input type="text" id="input'.$i.'" name="'.$thead[$i].'" rows="5"/>'.set_value($thead[$i]).'
										// <p class="help-block">'.$thead[$i].'을 써주세요.</p>
										// </div>';
									}
?>
								<div class="closet_attribute">
									</div>
									
									<div class="controls">
										<p class="help-block">
<?php
									if(@$error) {
										echo $error."<BR>";
									}
									echo validation_errors(); 
?>
										</p>
									</div>

									<br/><br/>
									<div>
										<label> what do you think about this?</label>
										<textarea style="width:80%; height:;" name="contents" value="contents" placeholder="what about this?"></textarea>
									</div>	
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
										<button class="btn" data-dismiss="modal">취소</button>
									</div>
								</div><!-- control-group -->							
							</form>
						</div>
					</div>
			      	<div class="modal-footer"></div>
				</div>

			</div><!-- <div id="modals"> -->

		</div>
	</div>		


	<div id="test"></div>
</body>

</html>