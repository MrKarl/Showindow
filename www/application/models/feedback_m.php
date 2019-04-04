<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 작성자 : 이명주
 * class name : Feedback_m
 * class info : Feedback 받은 것 관리 모델
 * functions  : setFeedback($info) :: Feedback 받은 것 저장
 * date  	  : 2014/05/06
 */

class Feedback_m extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	function setFeedback($info){
		$table = "table_feedback";
		$this->db->insert($table, $info);
	}
}