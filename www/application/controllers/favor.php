<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Favor
	*	What to Do 	:	평점(Rating)을 관리하는 클래스
	*/

class Favor extends CI_Controller {	
	function __construct(){
		parent::__construct();
	}

	public function index(){		
		$this->load->view('tool/input_item_v');
		$this->insert_items();
	}

	public function register_favor(){
		$this->load->model('favor_m');
		$this->load->model('user_m');				// 평가 횟수 늘리기(update 말고, 새로 입력한 경우에만 !)

		$info['tid'] = $this->input->post('user_id');
		$info['item_rating'] = $this->input->post('item_rating');
		$info['item_id'] = $this->input->post('item_id');
		$info['gender'] = $this->input->post('gender');

		$return = $this->favor_m->setFavor($info);
		$this->favor_m->setHottest($info);
		
		if(!strcmp($return,"insert")){											// 새로 평가를 한 경우 !
			
			$this->user_m->userDidRating($info['tid']);			
		}

		// $this->output->set_content_type('application/json')
    		  // ->set_output(json_encode($return['type']));
		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		$user_session_id = $this->session->userdata['user_id'];
		$user_info = $this->user_m->getUserInfo($user_session_id);

		$data = array(
			'return' => $return,
			'num_rating' => $user_info[0]['num_rating']
		);
				
		echo json_encode($data);
	}	
}

?>