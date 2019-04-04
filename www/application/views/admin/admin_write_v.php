<script>
	$(document).ready(function(){
		$("#write_btn").click(function(){
			if ($("#input01").val() == ''){
				alert('업로드할 파일을 선택해주세요.');
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
			<?php
				$attributes =array('role' => 'form', 'id' => 'upload_action');
				echo form_open_multipart('/admin/write/table_favor',$attributes);
				?>
				<fieldset>
					<div class="row">
						<div class="form-group col-md-10 col-md-offset-2">
							<legend>게시물 쓰기</legend>
							<?php
								for($i=1 ; $i<$thead['col_num']-2 ;$i++){
									echo '<div class="row">
											<div class="col-md-7">
												<label class="control-label" for="input02">'.$thead[$i].'</label>
												<input type="text" class="form-control" id="input'.$i.'" name="'.$thead[$i].'" value="'.set_value($thead[$i]).'" placeholder="'.$thead[$i].'을 써주세요.">
											</div>
										</div>';
								}

							?>
							<div class="row">
								<p class="help-block"><?php echo validation_errors()?></p>
							</div>				
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="form-actions col-md-2">
									<button type="submit" class="btn btn-primary col-md-6" id="write_btn">작성</button>
									<button type="reset" class="btn col-md-6" onclick="history.back()">취소</button>
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
