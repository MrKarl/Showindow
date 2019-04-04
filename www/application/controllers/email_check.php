<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Register
	*	What to Do 	:	If the user do first login and have no rating data, register the rating data and inform.
	*/
class Email_Check extends CI_Controller{

 	function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}	

	function index(){
		
	}

	function isUserExist($user_data){
		$this->load->model('user_m');
		$return = $this->user_m->is_exist($user_data);
		return $return;
	}

	public function make_confirm_string(){

		$email_address = $this->input->post('email_id', TRUE);
		$user_data['user_id'] = $email_address;
		
		$isExist = $this->isUserExist($user_data);
		if($isExist == TRUE){
			echo "ERROR";
			return;		// 유저 존재
		}else{
						// 유저 존재 x
		}

		$encypt_string = md5($email_address."_showindow");

		//error_log("encypt_string = ".$encypt_string);
		$this->sending_email_string($email_address, $encypt_string);

	}

	public function sending_email_string($email_address, $encypt_string){
		$toEmail = $email_address;

		$fromEmail = 'hdcapstone@gmail.com';
		$html = $this->fetch_page("54.238.143.240/config/email/email_v.php?", "encypt_string=".$encypt_string, "", "");
		$fromCharset = 'UTF-8';
		$fromName = "쇼윈도우 고객센터";
		$from = "\"=?".$fromCharset."?B?".base64_encode($fromName)."?=\" <".$fromEmail.">" ; // 인코딩된 보내는이

		$emailSubject = "[쇼윈도우] 회원가입을 위한 임시 문자열이 생성되었습니다.";				
		$encoded_subject = "=?".$fromCharset."?B?".base64_encode($emailSubject)."?=\n"; // 인코딩된 제목
    	$separator = md5(time());

    	$eol = PHP_EOL;	// carriage return type (we use a PHP end of line constant)

		$headers  = "From: ".$from.$eol;
		$headers .= "MIME-Version: 1.0".$eol; 

	    $headers .= "Content-Type: text/html; charset=euc-kr; boundary=\"".$separator."\"".$eol.$eol;

		$html = iconv("UTF-8","EUC-KR",$html);
		
		if (mail($toEmail, $emailSubject ,$html, $headers)) {
	   		echo "<BR>Mail send ... OK";
		} else {
	   		echo "<BR>Mail send ... ERROR";
		}

	}

	function email_confirm(){
		$key = "showindow는 한동대학교 캡스톤팀 프로젝트입니다.";

		$email_address = $this->input->post('email_id', TRUE);

		$email_address = $this->input->post('email_id', TRUE);
		$user_data['user_id'] = $email_address;
		
		$isExist = $this->isUserExist($user_data);
		if($isExist == TRUE){
			echo "false";
			return;		// 유저 존재
		}else{
						// 유저 존재 x
		}


		$string = $this->input->post('string', TRUE);

		$right_string = md5($email_address."_showindow");
		if(!strcmp($right_string, $string)){
			echo "true";
		}else{
			// echo "rightstring = ".$right_string."<br/>  string = ".$string."----<br/>failed.";
			echo "false";
		}
	}

	function fetch_page($url, $param, $cookies, $referer_url, $contentType = null){
        if(strlen(trim($referer_url)) == 0) $referer_url= $url; 
            $curlsession = curl_init();
            curl_setopt ($curlsession, CURLOPT_URL, "$url");
            curl_setopt ($curlsession, CURLOPT_POST, 1);
            curl_setopt ($curlsession, CURLOPT_POSTFIELDS, "$param");
            curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60);
        if($cookies && $cookies!=""){
            curl_setopt ($curlsession, CURLOPT_COOKIE, "$cookies");
        }
        if($contentType != null){
            curl_setopt ($curlsession, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
        }
        curl_setopt ($curlsession, CURLOPT_HEADER, 0);
        curl_setopt ($curlsession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt ($curlsession, CURLOPT_REFERER, "$referer_url");
        ob_start();
        $res = curl_exec ($curlsession);
        $buffer = ob_get_contents();
        ob_end_clean();
        if (!$buffer) {
            $returnVal = "Curl Fetch Error : ".curl_error($curlsession);
        }
        else{
            $returnVal = $buffer;
        } 
        curl_close($curlsession); 
        return $returnVal;
    }

}

?>