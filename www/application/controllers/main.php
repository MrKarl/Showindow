<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('alert');
		// $this->load->database();
		
		$this->load->library("takerecommendeditems");

		$this->load->model('card_m');
		$this->load->model('item_m');
		$this->load->model('user_m');
	}

	public function delaying_index(){
		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		$user_session_id = $this->session->userdata['user_id'];
		$user_info = $this->user_m->getUserInfo($user_session_id);

		$user_num_rating = $user_info[0]['num_rating'];

		// echo "<style>body{background-color : #1c2126;} </style>".
		// 			'<div id="loadingBox" style="top:50%; width:400px; margin:0 auto;">
		// 			<img src="/assets/Loader1.gif"/></div><div style="top:50%; width:400px; margin:0 auto;">
		// 			<font color="white">고객님께 어울리는 패션 아이템을 추천중입니다.</font></div>';				// 로더
		
		echo "	<link rel='stylesheet' type='text/css' href='/assets/css/style.css'>
				<link rel='stylesheet' type='text/css' href='/assets/css/reset.css'>
				<style>
					body{
						background-color : #1c2126;
					}
					#loadingBox{
						background-color : #1c2126;
						line-height:30px;
					} 
				</style>".'
						<div id="loadingBox" style="top:50%; width:400px; margin:0 auto;">
							<img src="/assets/Loader1.gif"/>
							<font color="white">고객님의 '.$user_num_rating.'개의 평가를 바탕으로 고객님께 어울리는 패션 아이템을 추천중입니다.</font>
						</div>';				// 로더


		redirect('/main/index', 'refresh');



	}
	public function index(){
		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		$user_session_id = $this->session->userdata['user_id'];
		
		$user_info = $this->user_m->getUserInfo($user_session_id);

		$user_id = $user_info[0]['tid'];
		$recommendedData = $this->takerecommendeditems->user_based_fileIO($user_id);
		
		if($user_info[0]['name'] != ""){
			$user_name = $user_info[0]['name'];
		}else if($user_info[0]['nickname'] != ""){
			$user_name = $user_info[0]['nickname'];
		}

		$recommendedData['user_id'] = $user_id;
		$recommendedData['age'] = $user_info[0]['age'];
		$recommendedData['name'] = $user_name;
		$recommendedData['id_type'] = $user_info[0]['id_type'];
		
		$gender = $this->session->userdata['user_gender'];
		if($gender == 'male'){
			$item_table = "table_item_male";
		}else{
			$item_table = "table_item_female";
		}
		$recommendedData['gender'] = $gender;

		$recommendedData['num_rating'] = $user_info[0]['num_rating'];
				
		$i = 0;
		foreach($recommendedData['recommended_items'] as $element){	
			$card_id = $this->card_m->get_original_card($element['item'], $gender);
			$card_id = $card_id[0]->tid;
			$item_info = $this->item_m->getItem($element['item'], $item_table);
			$recommendedData['recommended_items'][$i]['item_info'] = $item_info;
			$recommendedData['recommended_items'][$i]['card_id'] = $card_id;
			$i++;
		}
		
		$i = 0;
		foreach($recommendedData['user_choice_items'] as $element){	
			$card_id = $this->card_m->get_original_card($element['item'], $gender);
			$card_id = $card_id[0]->tid;
			$item_info = $this->item_m->getItem($element['item'], $item_table);
			$recommendedData['user_choice_items'][$i]['item_info'] = $item_info;
			$recommendedData['user_choice_items'][$i]['card_id'] = $card_id;
			$i++;
		}

		$i = 0;
		if(!is_null($recommendedData['close_neighbor'])){
			foreach($recommendedData['close_neighbor'] as $element){				
				$neighborInfo = $this->user_m->getUserInfoUsingTID($element);

				
				if(count($neighborInfo)>0){

					if($neighborInfo[0]['name'] != ""){
						$neighborName = $neighborInfo[0]['name'];
					// }else if($user_info[0]['nickname'] != ""){
					// 	$neighborName = $neighborInfo[0]['nickname'];
					}else{
						$neighborName = $neighborInfo[0]['nickname'];
					}

					$recommendedData['neighbor'][$i]['neighbor_serviceid'] = $element;
					$recommendedData['neighbor'][$i]['neighbor_accountid'] = $neighborInfo[0]['user_id'];
					$recommendedData['neighbor'][$i]['neighbor_name'] = $neighborName;
					$recommendedData['neighbor'][$i]['id_type'] = $neighborInfo[0]['id_type'];
					$recommendedData['neighbor'][$i]['gender'] = $neighborInfo[0]['gender'];
					$i++;
				}
			}
		}else{
			$recommendedData['neighbor'][0]['neighbor_serviceid'] = "";
			$recommendedData['neighbor'][0]['neighbor_accountid'] = "";
			$recommendedData['neighbor'][0]['neighbor_name'] = "";
			$recommendedData['neighbor'][0]['id_type'] = "";
		}
		


		$param['data'] = $recommendedData;		
		$this->load->view('main/main_v', $param);
	}


	public function mk_modal(){
			$item_id = $this->input->post("item_id", TRUE);
			$image_path = $this->input->post("image_path", TRUE);
			$gender = $this->input->post("gender",TRUE);
			$card_id = $this->input->post("card_id",TRUE);
			$table = $this->input->post("table", TRUE);
			
			$data = array();

			if($item_id){

				$result= $this->card_m->get_card($table, $card_id);
				// echo '<div class="modalimage"><img src="'.$image_path.'" /></div>
				// 	  <div class="modalcontent">'.$result->contents.'</div>
				// 	  <div class="modalstar">for star</div>';
				echo '	<div class="modalimage">
							<img src="'.$image_path.'" />
						</div>
					  	<div class="modalcontent">
					  		<div class="modalstar"></div>
					  		<div class="modaltext">'.$result->contents.'</div>
						</div>';
				echo '<div class="modal_info_scrab">
						<span style="font-size:10px; color :#b5b5b5">'.$result->created_date.'에 작성됨&nbsp;&nbsp;&nbsp;스크랩';
					$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'modalshare');
					echo form_open_multipart('/mycloset/scrab_form',$attributes);
						echo '<input type="hidden" name="item_img" value="'.$image_path.'"/>
							  <input type="hidden" name="item_tid" value="'.$item_id.'"/>
							  <input type="hidden" name="page" value="main" />
							  <input type="hidden" name="gender" value="'.$gender.'"/>
							  <button type="submit" style="border:0; background-color:transparent;"><img src="/assets/images/glyphicons_019_heart_empty.png"/></button>
						  	</form>';
			  	echo '	</span>
			  		</div>';
			}
	}

	public function mk_comment(){
		$card_id=$this->input->post("card_id",TRUE);
		$comment=$this->input->post("comment",TRUE);
		$data['card_id']=$card_id;
		$data['comment']=$comment;
		$user_id = $this->session->userdata['user_id'];
		$user_id = $this->user_m->getServiceUserID($user_id);
		$data['user_id']=$user_id;
		$this->card_m->insert_comments($data);

		$list = $this->card_m->get_comments($card_id);
		
		foreach($list as $lt){
			
			$user_info = $this->user_m->getUserInfoUsingTID($lt->user_id);
			$name = "";
			if($user_info[0]['name'] != ""){
				$name = $user_info[0]['name'];
			}else if($user_info[0]['nickname'] != ""){
				$name = $user_info[0]['nickname'];
			}

			echo '
				<div class="rply_bar">
					<div class="rp_id control-label"><a class="id_link" id="id" href="/mycloset/index/'.$lt->user_id.'">'.$name.'</a></div>
					<p class="reply_contents">'.$lt->comment.'</p>
					<button type="button" class="close" onclick="delComment('.$lt->tid.','.$card_id.')">x</button>
				</div>';
		}
	}		
	public function get_comment(){
		$card_id = $this->input->post("card_id",TRUE);
		$list = $this->card_m->get_comments($card_id);

		foreach($list as $lt){
		
			$user_info = $this->user_m->getUserInfoUsingTID($lt->user_id);
			$name = "";
			if($user_info[0]['name'] != ""){
				$name = $user_info[0]['name'];
			}else if($user_info[0]['nickname'] != ""){
				$name = $user_info[0]['nickname'];
			}
			echo '
			<div class="rply_bar">
				<div class="rp_id control-label"><a class="id_link" id="id" href="/mycloset/index/'.$lt->user_id.'">'.$name.'</a></div>
				<span class="reply_contents">'.$lt->comment.'</span>
				<span style="float:right; font-size:10px; color :#b5b5b5">'.$lt->created_date.'에 작성됨
					<button type="button" style="top:-22px; position:relative;" class="close" onclick="delComment('.$lt->tid.','.$card_id.')">x</button>					
				</span>
			</div>';
		}
	}

	function whatservice(){
		if($this->session->userdata('user_id') != ""){
			$user_sess_id = $this->session->userdata('user_id');
			$user_data = $this->user_m->getUserInfo($user_sess_id);
			$data['user_id'] = $this->user_m->getServiceUserID($user_data[0]['user_id']);
			$data['id_type'] = $user_data[0]['id_type'];
			$this->load->view('intro/whatishowindow_v', $data);
		}else{
			$data['user_id'] = -1;
			$data['id_type'] = -1;
			$this->load->view('intro/whatishowindow_v', $data);
		}

	}
}
?>