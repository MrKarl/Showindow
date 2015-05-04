<?php
	// require_once($_SERVER['DOCUMENT_ROOT']."/application/common/item_constants.php");
require_once("application/common/item_constants.php");
?>
	<script>
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
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'upload_action');
echo form_open_multipart('/admin/write/'.$this->uri->segment(3), $attributes);
?>
		  <fieldset>
		    <legend>SNS 쓰기</legend>
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
		</form>
	</article>