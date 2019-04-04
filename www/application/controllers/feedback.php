<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once("register.php");

/**
 * 작성자 : 이명주
 * class name : Feedback
 * class info : Feedback 받은 것 관리 class
 * functions  : setFeedback() ::Feedback 받은 것 저장
 * date  	  : 2014/05/06
 */
class Feedback extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function setFeedback(){
		$user_id = $this->session->userdata['user_id'];

		$this->load->model('user_m');
		$user_id = $this->user_m->getServiceUserID($user_id);

		$info = array(
			'user_id' => $user_id,
			'subject' => $this->input->post('subject',TRUE),
			'detail' => $this->input->post('detail',TRUE),
			'email' => $this->input->post('email',TRUE),
			'created_date' => date("Y-m-d H:i:s"),
			'modified_date' => date("Y-m-d H:i:s")
			);
 		$this->load->model('feedback_m');
 		$this->feedback_m->setFeedback($info);
	}
}