<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once("register.php");

/**
 * 작성자 : 이명주
 * class name : Intro
 * class info : Facebook 및 Email Login
 * functions  : get_login_info :: intro_v 로부터 유저 정보를 받아와 session에 데이터 넣는 함수 
 */
class Intro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('intro/intro_v');
		//$this->load->view('register/register1_v');
	}
	
	public function index2()
	{
		$this->session->sess_destroy();
		$this->load->view('intro/intro_v3');
		//$this->load->view('register/register1_v');
	}
	public function index3()
	{
		$this->session->sess_destroy();
		$this->load->view('intro/intro_v4');
		//$this->load->view('register/register1_v');
	}


	//session에 데이터 넣는 함수
	public function get_login_info(){
		$this->load->model('user_m');
		$user_birthday = $this->input->post('birthday',TRUE);
		$user_age=null;
		$current_year=2014;

		//생일 통해서 나이 구하기
		if($user_birthday){
			$token = strtok($user_birthday, "/");			
			while ($token != false)	{
			    $user_age = $token;
			    $token = strtok("/");
			}
			$user_age = $current_year-$user_age;
		}

		//유저 데이터 받아오기 (post)
		$user_data = array(
			'user_id' => $this->input->post('id',TRUE),
			'user_pw' => $this->input->post('password',TRUE),
			'user_id_type' => $this->input->post('id_type',TRUE),
			'user_type' => $this->input->post('user_type',TRUE),
			'user_name' => $this->input->post('name',TRUE),
			'user_nickname' => $this->input->post('nickname',TRUE),
			'user_link' => $this->input->post('link',TRUE),
			'user_gender' => $this->input->post('gender',TRUE),
			'user_email' => $this->input->post('email',TRUE),
			'user_birthday' => $this->input->post('birthday',TRUE),
			'user_age' => $user_age,
			'user_nation' => $this->input->post('nation',TRUE),
		);

		if($user_data['user_id'] == null){
			$this->index();
		}else{
			$is_exist = $this->user_m->is_exist($user_data);			// 가입했는지 안했는지 체크
			
			$this->session->set_userdata($user_data);						// 세션에 저장
				
			if($is_exist == 1){										// 가입 o
				if($this->user_m->getUserRatingNumber($user_data['user_id']) < 3){// 평가값이 3보다 작을때 register로 !
					redirect('/register', 'refresh');
				}else{
					echo "<style>body{background-color : #1c2126;} </style>".
					'<div id="loadingBox" style="top:50%; width:400px; margin:0 auto;">
					<img src="/assets/Loader1.gif"/></div><div style="top:50%; width:400px; margin:0 auto;">
					<font color="white">고객님께 어울리는 패션 아이템을 추천중입니다.</font></div>';				// 로더
					redirect('/main/delaying_index', 'refresh');
				}
			}else{														// 가입 x										
				//register controller 불러오기
				$this->user_m->register_info_insert($user_data);
				redirect('/register', 'refresh');
			}
		}
	}

	public function register(){
		$user_birthday = $this->input->post('birthday',TRUE);
		$user_age=null;
		$current_year=2014;
		//생을 통해서 나이 구하기
		if($user_birthday){
			$token = strtok($user_birthday, "/");
			
			while ($token != false)
			{
			    //echo "$token<br>"; 
			    $user_age=$token;
			    $token = strtok("/");
			}
			$user_age = $current_year-$user_age;

		}
		$user_data = array(
			'user_id' => $this->input->post('id',TRUE),
			'user_pw' => $this->input->post('password',TRUE),
			'user_id_type' => $this->input->post('id_type',TRUE),
			'user_type' => $this->input->post('user_type',TRUE),
			'user_name' => $this->input->post('name',TRUE),
			'user_nickname' => $this->input->post('nickname',TRUE),
			'user_link' => $this->input->post('link',TRUE),
			'user_gender' => $this->input->post('gender',TRUE),
			'user_email' => $this->input->post('email',TRUE),
			'user_birthday' => $this->input->post('birthday',TRUE),
			'user_age' => $user_age,
			'user_nation' => $this->input->post('nation',TRUE),
		);

		$this->load->model('user_m');
		$this->user_m->register_info_insert($user_data);
	}


	public function login(){

		$this->load->model('user_m');

		$user_data = array(
			'user_id' => $this->input->post('id',TRUE) ? $this->input->post('id',TRUE) : $this->session->userdata['user_id'] ,
			'user_pw' => $this->input->post('password',TRUE) ,
			
			//'user_gender' => $this->input->post('gender',TRUE) ,
		);

		$is_exist = $this->user_m->is_exist($user_data);			// 가입했는지 안했는지 체크	

		//is_exist : 0->가입x 			1->가입
		if($is_exist == 1){										// 가입 o
			$is_pw_ok = $this->user_m->is_pw_ok($user_data);
			if($is_pw_ok == 1){									// 가입 o, 비밀번호 o				
				$temp_data = $this->user_m->getUserInfo($user_data['user_id']);
				$user_data['user_gender'] = $temp_data[0]['gender'];
				$this->session->set_userdata($user_data);
				if($this->user_m->getUserRatingNumber($user_data['user_id']) < 15){// 평가값이 15보다 작을때 register로 !					
					echo "gotoregister";
					// redirect('/register', 'refresh');
				}else{
					echo "<style>body{background-color : #1c2126;} </style>".
					'<div id="loadingBox" style="top:50%; width:400px; margin:0 auto;">
					<img src="/assets/Loader1.gif"/></div><div style="top:50%; width:400px; margin:0 auto;">
					<font color="white">고객님께 어울리는 패션 아이템을 추천중입니다.</font></div>';				// 로더
					//redirect('/main/delaying_index', 'refresh');
				}
			}else{													// 가입 o, 비밀번호 x
				echo "incorrect";
			}
		}else{													// 가입 x			
			echo "unregistered";
		}
	}

	public function algo(){
		$this->load->model('item_m');
		$rating_items = $this->item_m->get_rating_item();

		return $rating_items;
	}
}

/* End of file Intro.php */
/* Location: ./application/controllers/intro/intro.php */