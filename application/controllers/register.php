<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Register
	*	What to Do 	:	If the user do first login and have no rating data, register the rating data and inform.
	*/
class Register extends CI_Controller{

 	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('user_m');
		$this->load->model('item_m');
		// $this->load->library('session');
	}	

	function index($step=1){

		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}		
		$user_session_id = $this->session->userdata['user_id'];
		
		$user_info = $this->user_m->getUserInfo($user_session_id);		

		$user_id = $user_info[0]['tid'];
		if($user_info[0]['name'] != ""){
			$user_name = $user_info[0]['name'];
		}else if($user_info[0]['nickname'] != ""){
			$user_name = $user_info[0]['nickname'];
		}
		
		$gender = $this->session->userdata['user_gender'];
		$data['age'] = $user_info[0]['age'];
		$data['name'] = $user_name;
		$data['id_type'] = $user_info[0]['id_type'];
		$data['user_id'] = $user_id;
		$data['gender'] = $gender;
		
		// $data['items'] = $this->algo();
		$data['items'] = $this->get_estimate_items($step, $gender);
		$data['step'] = $step;

		$this->load->view('register/register_v', $data);
	}

	/* Deprecated ! */
	public function algo(){
		$rating_items = $this->item_m->get_rating_item();

		return $rating_items;
	}

	/* DB에서 성별과 선호도 추천 step에 따라서 랜덤하게 아이템들을 추출한다. */
	public function get_estimate_items($step, $gender){
		$estimate_items = $this->item_m->get_estimate_items($step, $gender);

		return $estimate_items;	
	}

	/* 더 평가하기 위해서, 옷의 카테고리 별로 랜덤하게 아이템을 받아온다. */
	public function get_estimate_more_item($serviceid, $gender, $types){
		$estimate_items = $this->item_m->get_estimate_more_item($serviceid, $gender, $types);

		return $estimate_items;	
	}

	/* 더 평가하기 */
	public function moreFavor($types=0){
		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		$user_session_id = $this->session->userdata['user_id'];
		$user_info = $this->user_m->getUserInfo($user_session_id);

		if($user_info[0]['name'] != ""){
			$user_name = $user_info[0]['name'];
		}else if($user_info[0]['nickname'] != ""){
			$user_name = $user_info[0]['nickname'];
		}
		
		$gender = $this->session->userdata['user_gender'];
		if($gender == 'male'){
			$item_table = "table_item_male";
		}else{
			$item_table = "table_item_female";
		}
		$data['user_id'] = $user_info[0]['tid'];
		$data['age'] = $user_info[0]['age'];
		$data['name'] = $user_name;
		$data['id_type'] = $user_info[0]['id_type'];
		$data['gender'] = $gender;
		$data['num_rating'] = $user_info[0]['num_rating'];
		$data['type'] = $types;

		$data['items'] = $this->get_estimate_more_item($data['user_id'], $gender, $types);

		$i=0;
		foreach($data['items'] as $item){
			if($this->checkBeRated($data['user_id'], $item->tid, $gender)){
				$data['items'][$i]->rating = 0;
			}else{
				$data['items'][$i]->rating = $this->checkBeRated($data['user_id'], $item->tid, $gender);
			}
			$i++;
		}

		$this->load->view('register/morefavor_v', $data);
	}

	public function checkBeRated($serviceid, $item_id, $gender){
		$this->load->model('favor_m');

		$result = $this->favor_m->checkBeRated($serviceid, $item_id, $gender);
		if(is_null($result)){
			return false;
		}else{
			return $result;
		}
	}

}

?>