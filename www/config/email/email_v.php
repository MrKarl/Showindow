<!DOCTYPE html lang="ko">
<?php
	$encypt_string = array_key_exists('encypt_string', $_REQUEST) ? ($_REQUEST['encypt_string'] != '' ? $_REQUEST['encypt_string'] : null) : null;
?>
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>SHOWINDOW 이메일 회원가입</title>

	<style> 	
	#text{
		font-family:sans-serif; 
		font-weight: normal; 
		font-size: 18px; 
		line-height: 28px; 
		color: #767676; 
		margin-bottom: 25px; 
		letter-spacing: -1px;
	}
	
	.label{
		font-family: sans-serif; 
		font-weight: normal; 
		font-size: 16px;
		color: #e39717;
		line-height: 20px; 
		margin-top: 5px; 
		margin-bottom: 5px; 
	}
	
	.data{
		font-family: sans-serif; 
		font-weight: bold; 
		font-size: 18px;
		color: #595959;
		line-height: 20px; 
		margin-top: 5px;
		margin-bottom: 5px;
		text-align: right;
	}
	
	.comment{
		font-family: sans-serif; 
		font-weight: normal; 
		text-align: center;
		font-size: 14px; 
		line-height: 20px; 
		color: #767676; 
		margin-bottom: 15px; 
	}
	
	.footer{
		font-family: sans-serif;
		font-size:11px;
		line-height:7px;
		color:#767676;
		margin-bottom:10px;
		letter-spacing: -1px;
	}
	
	</style> 
</head> 


<body bgcolor="#e6e6e6" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" 
style="-webkit-font-smoothing: antialiased;width:100% !important; background:#e4e4e4;-webkit-text-size-adjust:none;">
<div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#e6e6e6"> 
<tr><td width="100%">  

	<table width="584" cellpadding="0" cellspacing="0" border="0" bordercolor="#dfd0ac"
	style="border-collapse:collapse" align="center" class="table">
	<tr><td width="584" class="cell">


		<!-- 테이블 최상단에 공간을 주기 위한 테이블 삽입 -->
		<table width="584" cellpadding="0" cellspacing="0" class="table" bgcolor="#e6e6e6"> 
		<tr><td width="504" class="logocell" style="padding: 15px 40px;" align="center"></td></tr></table>

		
		<!-- 헤더 셀 -->

		<table width="584" cellpadding="0" cellspacing="0" class="table" bgcolor="#ffd800"> 
		<tr><td width="504" class="logocell" style="padding: 15px 40px;" align="center"> 
			<a href="http://storybox-app.com">
				<!-- <img src="http://54.238.143.240/assets/showindow_gray.png" gallaryimg=no width="70"
				height="70" alt="StoryBox website" border="0" style="-ms-interpolation-mode:bicubic;"> -->
			</a><br/><br/> 
			<p class="title" align="center" style="font-size: 30px; font-family: sans-serif; font-weight: bold; letter-spacing: -2px;
			 line-height: 34px; color: #ffffff; margin-top: 0; margin-right: 0; margin-bottom: 0;
			 margin-left: 0; padding: 0; text-shadow: 0px -1px 1px #e8b909;" >SHOWINDOW 이메일 확인 문자입니다.
			</p> 				
		</td></tr> 
		</table> 

		
		<!-- 본문 셀 -->

		<table width="584" cellpadding="0" cellspacing="0" border="0" class="table">
		<tr><td width="580" class="innercell" style="background-color: #ffffff;">
				
			<table width="584" cellpadding="0" cellspacing="0" border="0" class="innertable">
			
			<tr><td width="500" class="content" style="background-color: #ffffff; padding: 38px 40px 0 40px;">
				
				
				<!-- 주문 이미지 썸네일 -->
				<div align="center">						
				<img src="http://54.238.143.240/assets/showindow_gray.png" width="210">
				</div>
				
				<!-- 안내문 -->
				<p id="text">안녕하세요 ! 쇼윈도우입니다 !<br /> 다음 생성된 문구를 인증문자 입력란에 붙여넣기 해주세요 !</p>
				
				<!-- 주문정보 부분 -->
				<table border="0" cellspacing="0" cellpadding="0" style="margin: 0; padding: 0; width: 100%;"> 

					<!-- 이메일 -->	
					<tr>
						<td style="vertical-align: middle;"> 
						<p class="label">임시 생성 문자열 : </p><br>
						</td>
				 
						<td style="vertical-align: middle;"> 
						<p class="data"><?php echo $encypt_string ?></p><br>
						</td>
					</tr>
							
				</table>
				
														
				<p class="comment">여러분의 스타일을
					<a href="http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com" style="color: #69aa35; text-decoration: none;">
						<span style="color: #e39717;">쇼윈도우 홈페이지</span>
					</a>에서 추천받으세요 !
				</p> 					 						
 
 
				<!-- 하단 앱 소개 부분 -->
 				<table width="500" border="0" cellspacing="0" cellpadding="0" style="margin: 0; padding: 0; border-top: 1px solid #ccc;">                    	
	 				<tr>
		 			<!-- <td valign="bottom" style="padding-right: 10px; padding-top: 10px; margin: 0; vertical-align: top;">  -->

		 			<td valign="middle" style="padding: 0; margin: 0; vertical-align: middle;">
				 	<p style="color: #595959; font-family: arial, helvetica, sans serif; font-size: 12px; margin: 0; padding: 20px 0 0 0;">
				 		<span style="font-weight: bold">SHOWINDOW</span>
				 		<br>쇼윈도우는 개인 맞춤형 패션 추천 서비스입니다.
				 		<a href="http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com" style="color: #69aa35; text-decoration: none;">
				 			<span style="color: #e39717;">&nbsp;&nbsp;홈페이지 바로가기&nbsp;&rarr;</span></a>
				 	</p> 
				 	</td>

				 	<td> 
			 		<!-- <img src="http://54.248.99.33/storyBoxManager/order/mailing/symbol2.png" width="40" height="40" alt="StoryBox" style="-ms-interpolation-mode:bicubic;" /> -->
			 		</td>

			 		
				 	</tr>
				
				 	<!-- 테이블 최하단에 공간을 주기 위한 테이블 삽입 -->
				 	<table width="500" cellpadding="0" cellspacing="0" class="table" bgcolor="#ffffff"> 
					<tr><td width="500" class="logocell" style="padding: 10px 0px;" align="center"></td></tr>
					</table>
				 </table> 

			</td></tr> 
			</table> 
				
		</td></tr> 
		

	</table>      
 
	<table align="center" width="500" cellpadding="20" cellspacing="0" border="0" class="table"> 					
		<tr align="center">
			<td>
			
			<p class="footer">
				지원문의는 다음 관리자 메일로 보내주세요!
				<a href="mailto:winnerofsky@gmail.com" style="color:#595959" target="_blank">
					<span style="color:#595959">고객 지원 센터</span>
				</a>
				|
				<a href="http://ec2-54-238-143-240.ap-northeast-1.compute.amazonaws.com" style="text-decoration:none" target="_blank">
					<span style="color:#595959;text-decoration:underline">개인정보보호정책</span>
				</a>
			</p> 
			
			<p class="footer">2014 한동대학교 캡스톤팀 PLUG
			</p> 
			</td>
		</tr> 
	</table> 

 
</td></tr> 

</table>


</div></body></html>