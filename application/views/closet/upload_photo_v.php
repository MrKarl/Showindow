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
<?php
	// require_once($_SERVER['DOCUMENT_ROOT']."/application/common/item_constants.php");
require_once("application/common/item_constants.php");
?>
	<script>
		function setGender(){
			document.getElementById('male_btn').src = document.getElementById('male').checked==true ? 
															"http://54.238.143.240/assets/male_on.png"  :  "http://54.238.143.240/assets/male_off.png";
			document.getElementById('female_btn').src = document.getElementById('female').checked==true ?
			 												"http://54.238.143.240/assets/female_on.png"  :  "http://54.238.143.240/assets/female_off.png";
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

		


	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>
		<div class="container">
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'upload_action');
echo form_open_multipart('/mycloset/mk_orig_card/'.$this->uri->segment(3), $attributes);
?>
		  <fieldset>
		    <legend></legend>
		    <div class="control-group">
		      <label class="control-label" for="input01">사진 업로드</label>
		      <img id="view1" src="">
		      <canvas id="canvas"></canvas>
		      <div class="controls">
       	        <input type="file" class="input-xlarge" id="input01" name="userfile" value="<?php echo set_value('userfile'); ?>" onChange="readURL(this);">
		        <span class="help-block">파일을 선택해주세요..</span>
		      </div>
		     
		      	
		      <?php
		      		// for($i = 1 ; $i < $thead['col_num'] - 2 ; $i++){
		      		// 	echo '<label class="control-label" for="input01">'.$thead[$i].'</label>
						    //   <div class="controls">
						    //     <input type="text" class="input-xlarge" id="input'.$i.'" name="'.$thead[$i].'" rows="5">'.set_value($thead[$i]).'
						    //     <p class="help-block">'.$thead[$i].'을 써주세요.</p>
						    //   </div>';
		      		// }

		      	for($i = 3 ; $i < 4 ; $i++){
	      			echo '<label class="control-label" for="input01">'.$thead[$i].'</label>
					      <div class="controls">				      
						  <input type="text" class="input-xlarge" id="input'.$i.'" name="'.$thead[$i].'" rows="5"/>'.set_value($thead[$i]).'
					        <p class="help-block">'.$thead[$i].'을 써주세요.</p>
					      </div>';
					      
	      		}


		      	?>
	      		<?php
	      			for($i = 4 ; $i < $thead['col_num'] - 2 ; $i++){
	      				if($thead[$i] == 'count' || $thead[$i] == 'point')
					      	continue;
	      				echo '<div><label class="control-label" for="input01">'.$thead[$i].'</label>';
						echo '<select id="input'.$i.'" name="'.$thead[$i].'"/>';
	      				
	      				if($thead[$i] == "type"){
	      					$array_key = array_keys($type);
	      					$array_val = array_values($type);	      					
	      				}elseif($thead[$i] == "material"){
	      					$array_key = array_keys($material);
	      					$array_val = array_values($material);	      					
	      				}else if($thead[$i] == "pattern"){
	      					$array_key = array_keys($pattern);
	      					$array_val = array_values($pattern);
	      				}else if($thead[$i] == "color"){/////////////////////
	      					$array_key = array_keys($color);
	      					$array_val = array_values($color);
	      				}else if($thead[$i] == "color_tone"){/////////////////////
	      					$array_key = array_keys($color_tone);
	      					$array_val = array_values($color_tone);
	      				}else if($thead[$i] == "line"){
	      					$array_key = array_keys($line);
	      					$array_val = array_values($line);
	      				}else if($thead[$i] == "neck_line"){
	      					$array_key = array_keys($neck_line);
	      					$array_val = array_values($neck_line);
	      				}else if($thead[$i] == "arm_length"){
	      					$array_key = array_keys($arm_length);
	      					$array_val = array_values($arm_length);
	      				}else if($thead[$i] == "btn"){
	      					$array_key = array_keys($btn);
	      					$array_val = array_values($btn);
	      				}else if($thead[$i] == "length"){///////////////////
	      					$array_key = array_keys($length);
	      					$array_val = array_values($length);
	      				}else if($thead[$i] == "pocket"){
	      					$array_key = array_keys($pocket);
	      					$array_val = array_values($pocket);
	      				}else if($thead[$i] == "wrinkle_shape"){
	      					$array_key = array_keys($wrinkle_shape);
	      					$array_val = array_values($wrinkle_shape);
	      				}else if($thead[$i] == "sleeve_shape"){
	      					$array_key = array_keys($sleeve_shape);
	      					$array_val = array_values($sleeve_shape);
	      				}
	      				
	      				echo count($array_key);
	      				for($cnt=0; $cnt < count($array_key); $cnt++){
	      						echo '<option value="'.$array_val[$cnt].'">';
	      						echo $array_key[$cnt];
	      						echo '</option>';
	      				}
	      				
	      				echo '</select></div>';
	      				
		      		}
				?>
				 <span>
					<label>Gender : </label>
					<input type="radio" style="display:none" name="gender" id="male" value="male"/>
					<input type="radio" style="display:none" name="gender" id="female"  value="female"/>
					<img src="http://54.238.143.240/assets/male_on.png" id="male_btn" 
					onClick="document.getElementById('male').checked=true; document.getElementById('female').checked=false; javascript:setGender();"/>
					<img src="http://54.238.143.240/assets/female_off.png" id="female_btn" 
					onClick="document.getElementById('female').checked=true; document.getElementById('male').checked=false; javascript:setGender();"/>
				</span>
			  <div class="controls">
		        <p class="help-block">
<?php
if(@$error) {
	echo $error."<BR>";
}
?>
				<?php echo validation_errors(); ?></p>
		      </div>

		      <div class="form-actions">
		        <button type="button" class="btn btn-primary" id="write_btn">작성</button>
		        <button class="btn" onclick="document.location.reload()">취소</button>
		      </div>
		    </div>
		  </fieldset>
		</div>
		</form>
	</article>

	
</body>

</html>