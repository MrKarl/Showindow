<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	*	Developer	:	Myung Ju Lee
	*	Class Name 	:	User_m
	*	What to Do 	:	유저의 정보를 관리하는 모델
	*					is_exist() :: 이미가입한 유저인지 체크 이미 있으면 TRUE를, 없으면 FALSE를 return
	*					register_info_insert() :: 첫 로그인 시 받은 유저 정보 저장(insert)
	*					
	*					
	*/
class User_m extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//이미가입한 유저인지 체크 이미 있으면 TRUE를, 없으면 FALSE를 return
	function is_exist($user_data){
		$user_id = mysql_real_escape_string($user_data['user_id']);
		/*
		$table = "table_user";
		$sql = "SELECT user_id FROM ".$table." WHERE user_id='$user_id'";
		$query = $this->db->query($sql);
		$result = $query->result();
		*/
		
		$this->db->select('user_id');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('table_user');
		$result = $query->result_array();
		if(!count($result)){			
			return 0;		// 유저 존재 x
		}else{
			return 1;		// 유저 존재 !
		}
	}
	function is_pw_ok($user_data){
		$user_id = mysql_real_escape_string($user_data['user_id']);
		$user_pw = mysql_real_escape_string($user_data['user_pw']);

		$this->db->select('user_id');
		$this->db->where('password', $user_pw);
		$this->db->where('user_id', $user_id);
		$query =$this->db->get('table_user');
		$result = $query->result_array();

		// $result = $result[0]['user_id'];

		if(!count($result)){
			return 0;		// 비밀번호 불일치
		}else{
			return 1;		// 비밀번호 일치
		}
	}

	//첫 로그인 시 받은 유저 정보 저장(insert)
	function register_info_insert($user_data){
		// $user_data['user_id'] = mysql_real_escape_string($user_data['user_id']);
		// $user_data['email'] = mysql_real_escape_string($user_data['user_id']);
		$table = "table_user";
		$insert_array = array(
			'user_id' => mysql_real_escape_string($user_data['user_id']),
			'password' => mysql_real_escape_string($user_data['user_pw']),
			'id_type' => $user_data['user_id_type'],
			'user_type' => $user_data['user_type'],
			'name' => mysql_real_escape_string($user_data['user_name']),
			'nickname' => mysql_real_escape_string($user_data['user_nickname']),
			'link' => mysql_real_escape_string($user_data['user_link']),
			'gender' => mysql_real_escape_string($user_data['user_gender']),
			'email' => mysql_real_escape_string($user_data['user_email']),
			'age' => $user_data['user_age'],
			'num_rating' => 0,
			'created_date' => date("Y-m-d H:i:s"),
			'modified_date' => date("Y-m-d H:i:s"),
		);

		$result = $this->db->insert($table, $insert_array);
		return $result;
	}

	function getServiceUserID($sessionID){
		$table = "table_user";
		$sessionID = mysql_real_escape_string($sessionID);
		

		$this->db->select('tid');
		$this->db->where('user_id', $sessionID);
		$query =$this->db->get('table_user');
		$result = $query->result_array();
		$result = $result[0]['tid'];
		
		return $result;
	}


	function userDidRating($tid){
		$table = "table_user";
		
		$this->db->set('num_rating', '`num_rating`+ 1', FALSE);
		$this->db->where('tid', $tid);
		$this->db->update($table);
	}

	function getUserRatingNumber($sessionID){
		$table = "table_user";
		$sessionID = mysql_real_escape_string($sessionID);

		$this->db->select('num_rating');
		$this->db->where('user_id', $sessionID);
		$query =$this->db->get('table_user');
		$result = $query->result_array();
		$result = $result[0]['num_rating'];

		return $result;
	}

	function getUserInfo($sessionID){

		$sessionID = mysql_real_escape_string($sessionID);
		$this->db->select('*');
		$this->db->where('user_id', $sessionID);
		$query =$this->db->get('table_user');
	
		$result = $query->result_array();

		return $result;
	}

	function getUserInfoUsingTID($user_tid){

		$this->db->select('*');
		$this->db->where('tid', $user_tid);
		$query =$this->db->get('table_user');
	
		$result = $query->result_array();

		return $result;

	}
}