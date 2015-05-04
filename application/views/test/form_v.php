<div class="row-fluid">
<article class="col-md-11 col-md-offset-1">
	<header>
		<h1></h1>
	</header>
	<?php //echo validation_errors(); 
		if(form_error('username')){
			$error_username = form_error('username');
		}
		else
		{
			$error_username = form_error('username_check');
		}
	?>

	<form method="post" class="form-horizontal" role="form">
		<fieldset>
			<legend>폼 검증</legend>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="input01">아이디</label>
				<div class="col-lg-4">
					<input type="text" name="username" class="form-control" id="input01" placeholder="아이디를 입력하세요." value="<?php echo set_value('username'); ?>">
					<p class="help-block"><?php if($error_username == TRUE){ echo $error_username;} ?></p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="input02">비밀번호</label>
				<div class="col-lg-4">
					<input type="text" name="password" class="form-control" id="input02" placeholder="비밀번호를 입력하세요." value="<?php echo set_value('password'); ?>">
					<p class="help-block"><?php if(form_error('password') != FALSE) {echo form_error('password');} ?></p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="input03">비밀번호 확인</label>	
				<div class="col-lg-4">
					<input type="text" name="passconf" class="form-control" id="input03" placeholder="비밀번호를 한번 더 입력하세요"value="<?php echo set_value('passconf'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="input04">이메일</label>
				<div class="col-lg-4">
					<input type="text" name="email" class="form-control" id="input04" placeholder="이메일을 입력하세요." value="<?php echo set_value('email'); ?>">
				</div>
			</div>
		</fieldset>
		<div class="col-md-2 col-md-offset-5">	<input type="submit" value="전송" class="btn btn-primary" /></div>
	</form>
</article>
</div>