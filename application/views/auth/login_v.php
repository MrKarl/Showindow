<article id="board_area">
	<header>
		<h1></h1>
	</header>
	<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'auth_login');
		echo form_open('/auth/login', $attributes);
	?>
		<fieldset>
			<legend>로그인</legend>
				<div class="form-group">
					<label class="col-lg-1 control-label" for="input01">아이디</label>
					<div class="col-lg-3">
						<input type="text" name="username" class="form-control" id="input01" placeholder="아이디를 입력하세요." value="<?php echo set_value('username'); ?>">
						<p class="help-block"><?php if(form_error('username') == TRUE){ echo form_error('username');} ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-1 control-label" for="input02">비밀번호</label>
					<div class="col-lg-3">
						<input type="text" name="password" class="form-control" id="input02" placeholder="비밀번호를 입력하세요." value="<?php echo set_value('password'); ?>">
						<p class="help-block"><?php if(form_error('password') != FALSE) {echo form_error('password');} ?></p>
					</div>
				</div>
				<div class="form-actions col-lg-2 col-md-offset-2">
					<button type="submit" class="btn btn-primary col-md-4 col-md-offset-4">확인</button>
					<button class="btn col-md-4" type="reset" onclick=>취소</button>
				</div>
		</fieldset>
	</form>
</article>