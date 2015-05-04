<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mycloset extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('alert');
		$this->load->database();

		$this->load->model('card_m');
		$this->load->model('item_m');
		$this->load->model('user_m');
	}
	public function index($userid=NULL){
		if(is_null($userid)){
			// $this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		if(is_null($this->session->userdata['user_id'])){			
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}


		$my_session_id = $this->session->userdata['user_id'];
		
		$my_info = $this->user_m->getUserInfo($my_session_id);		

		$user_info = $this->user_m->getUserInfoUsingTID($userid);
		
		
		
		$list = $this->card_m->get_my_card_list('table_card', $userid);
		
		$i=0;
		$card_list = array();
		foreach($list as $lt){
			$card_list[$i] = $this->card_m->get_item_info($lt->item_id, $lt->gender, $lt->tid);
			$card_list[$i]['contents'] = $lt->contents;
			$i++;			
		}

		$data['list'] = $card_list;
		$data['user_id'] = $userid;
		if($user_info[0]['name'] != ""){
			$data['name']= $user_info[0]['name'];
		}else if($user_info[0]['nickname'] != ""){
			$data['name'] = $user_info[0]['nickname'];
		}
		$data['id_type'] = $user_info[0]['id_type'];
		$data['age'] = $user_info[0]['age'];
		$data['gender'] = $user_info[0]['gender'];		
	

		$data['session_id'] = $user_info[0]['user_id'];

		if($my_info[0]['name'] != ""){
			$data['my_name']= $my_info[0]['name'];
		}else if($my_info[0]['nickname'] != ""){
			$data['my_name'] = $my_info[0]['nickname'];
		}

		$tbname = "";
		if($user_info[0]['gender'] == "male"){
			$tbname = "table_item_male";
		}else if($user_info[0]['gender'] == "female"){
			$tbname = "table_item_female";
		}	
		$thead = $this->card_m->get_thead($tbname);
		$data['thead'] = $thead;
		
		$data['tbname'] = $tbname;

		$start_point = $this->input->post('last_id',TRUE);
		if($start_point == 0){
			$this->load->view('closet/closet_v',$data);
		}else{
			$data['start_point'] = $start_point;
			$this->load->view('closet/infinite_v',$data);
		}
	}


		

	function scrab(){
		if(is_null($this->session->userdata['user_id'])){
			$this->session->sess_destroy();
			redirect('/intro', 'refresh');
		}
		$user_session_id = $this->session->userdata['user_id'];
		$user_info = $this->user_m->getUserInfo($user_session_id);
		$user_id = $user_info[0]['tid'];
		$gender = $user_info[0]['gender'];

		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$table = 'table_card';

		$thead = $this->card_m->get_thead($table);

		$data['thead'] = $thead;
		$data['page'] = $this->input->post('page',TRUE);
		if($_POST){
			$write_data = array();

			$write_data['table'] = $table;

			for($i=1 ; $i<($thead['col_num']-2) ; $i++){
				$write_data[$thead[$i]] = $this->input->post($thead[$i], TRUE);						
			}
			$page=$data['page'];
			$write_data['user_id'] = $user_id;
			$write_data['isOriginal'] = 2;
			$write_data['comment_id'] = 0;
			$write_data['point'] = 0;
			// error_log("user_id=".$user_id);
			// error_log("gender=".$gender);
			// error_log("item_id=".$list[0]['item_id']);
			/*error_log("************");
			error_log("table=".$write_data['table']);
			error_log("contents=".$write_data['contents']);
			error_log("user_id=".$write_data['user_id']);
			error_log("comment_id=".$write_data['comment_id']);
			error_log("************");*/


			$result = $this->card_m->insert_card($write_data);


			if($result){
				if($page == 'main'){
					alert('스크랩이 성공하였습니다.','/main/index/');
				}
				else{
					alert('스크랩이 성공하였습니다.','/mycloset/index/'.$user_id);
				}
				exit;
			}else{
				if($page == 'main'){
					alert('스크랩이 실패하였습니다. 다시 시도해주세요.','/main/index/');
				}
				else{
					alert('스크랩이 실패하였습니다. 다시 시도해주세요.','/mycloset/index/'.$user_id);
				}
				
				exit;
			}
		}else{
				$this->load->view('closet/upload_v',$data);			
		}

	}

	function scrab_form(){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$table = 'table_card';

		$thead = $this->card_m->get_thead($table);

		$data['thead'] = $thead;
		$data['user_id'] = $this->session->userdata['user_id'];
		$data['user_id'] = $this->user_m->getServiceUserID($data['user_id']);
		$data['page'] = $this->input->post('page',TRUE);
		$data['item_img'] = $this->input->post('item_img', TRUE);	
		$data['item_tid'] = $this->input->post('item_tid', TRUE);	
		$data['gender'] = $this->input->post('gender', TRUE);	
		$this->load->view('closet/upload_v',$data);			
		
		
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
						<span style="font-size:10px; font :#b5b5b5">'.$result->created_date.'에 작성됨&nbsp;&nbsp;&nbsp;스크랩';
					$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'modalshare');
					echo form_open_multipart('/mycloset/scrab_form',$attributes);
						echo '<input type="hidden" name="item_img" value="'.$image_path.'"/>
							  <input type="hidden" name="item_tid" value="'.$item_id.'"/>
							  <input type="hidden" name="page" value="mycloset" />
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
			// <div class="rp_id control-label"><a class="id_link" id="id" href="/mycloset/index/{$user_info[0]['user_id']}">'.$name.'</a></div>
			echo '
				<div class="rply_bar">
					<div class="rp_id control-label"><a class="id_link" id="id" href="/mycloset/index/'.$lt->user_id.'">'.$name.'</a></div>
					<p class="reply_contents">'.$lt->comment.'</p>
					<button type="button" class="close" onclick="delComment('.$lt->tid.','.$card_id.','.$lt->user_id.')">x</button>
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
				<span style="float:right; font-size:10px; font :#b5b5b5">'.$lt->created_date.'에 작성됨
					<button type="button" style="top:-22px; position:relative;" class="close" onclick="delComment('.$lt->tid.','.$card_id.')">x</button>					
				</span>
			</div>';
		}
	}
	
	function is_upload($thead){
		for($i = 0 ; $i < $thead['col_num'] ;$i++){
			if($thead[$i] == 'item_name'){
				return TRUE;
			}
		}
		return FALSE;
	}

	public function mk_orig_card(){

		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$table = $this->uri->segment(3);
		$my_session_id = $this->session->userdata['user_id'];
		
		$my_info = $this->user_m->getUserInfo($my_session_id);	
		$user_id = $my_info[0]['tid'];
	//	error_log($table);
		$gender=$this->input->post("gender", true);
		
		if($gender=='male'){
		 	$table="table_item_male";
		}
		else if($gender == 'female'){
			$table="table_item_female";
		}
		$thead = $this->card_m->get_thead($table);


		$data['thead'] = $thead;

		
		if($_POST){
			if($this->is_upload($thead)){
			
				$config = array(
					'upload_path' => 'uploads/',
					'allowed_types' => 'gif|jpg|png|PNG|JPG|GIF|JPEG|bmp|BMP|JPE|jpe',
					'encrypt_name' => TRUE,
					'max_size' => '5000'
				);

				$this->load->library('upload',$config);
				if(!$this->upload->do_upload()){
					$data['error'] = $this->upload->display_errors();
					error_log("mycloset mk_orig_card() file upload error/userid=".$user_id);
					$this->load->helper('alert');

					alert('File Format 이 잘못되었습니다. 다른 파일을 올려주세요 !', '/mycloset/index/'.$my_info[0]['tid']);
					// $this->index($user_id);
				}else{
					$upload_data = $this->upload->data();
					for($i=3 ; $i<$thead['col_num']-2 ; $i++){
						if($thead[$i] != 'item_path'){
							$upload_data[$thead[$i]] = $this->input->post($thead[$i], true);
						}
					}					
					$result = $this->card_m->insert_photo($table, $upload_data);
					$insert_data = array(
						'isOriginal'=>1,
						'contents' => $this->input->post('contents',true),
						'comment_id' => 0,
						'item_id' => $result,
						'gender' =>$gender,
						'user_id' =>$my_info[0]['tid'],
						'point' => 0,
						'created_date' => date("Y-m-d H:i:s"),
						'modified_date' => date("Y-m-d H:i:s")
					);
					$insert_data['table'] = 'table_card';

					$result = $this->card_m->insert_card($insert_data);

					redirect('/mycloset/index/'.$my_info[0]['tid']); 
				
					if($result){
						//sns library load
					}else{
						echo "<script> alert('.'); </script>";
						redirect('/mycloset/mk_orig_card');
					}
				}

			}
			else{
				$this->load->helper('alert');

				$uri_array = $this->segment_explode($this->uri->uri_string());

				if(in_array('page', $uri_array)){
					$pages = urldecode($this->url_explode($uri_array, 'page'));
				}
				else{
					$pages = 1;
				}

				$write_data = array();

				$write_data['table'] = $this->uri->segment(3);

				for($i=1 ; $i<($thead['col_num']-2) ; $i++){
					$write_data[$thead[$i]] = $this->input->post($thead[$i], TRUE);						
				}

				$result = $this->card_m->insert_card($write_data);

				
				if($result){
					alert('inserted', '/mycloset/index/'.$my_info[0]['tid']);
					exit;
				}
				else
				{
					alert('rewrite','/mycloset/index/'.$my_info[0]['tid']);
					exit;
				}
			}
		}else{
			if($this->is_upload($thead)){
					$this->load->view('/closet/upload_photo_v',$data);
			}
			else{
					$this->load->view('closet/admin_write_v',$data);
			}
		}
	}



	public function mk_write_card(){
		require_once("application/common/item_constants2.php");
		$tbname = "";
		$index = $this->input->post("index",true);
		$tbname = "table_item_male";
		$thead = $this->card_m->get_thead($tbname);


		for($i = 4 ; $i < $thead['col_num'] - 2 ; $i++){
			if($index < 3 || $index == 5){
				if($thead[$i] == "type" || $thead[$i] == 'count' || $thead[$i] == 'point'|| $thead[$i] == "length")
		      	continue;
			}else{
				if($thead[$i] == "neck_line" || $thead[$i] == "arm_length" ||$thead[$i] == "type" || $thead[$i] == 'count' || $thead[$i] == 'point')
		      	continue;
			}
				echo '<div><label class="control-label" for="input01">'.$thead[$i].'</label>';
			echo '<select id="input'.$i.'" name="'.$thead[$i].'">';
				
				if($thead[$i] == "material"){
					$array_key = array_keys($material);
					$array_val = array_values($material);	      					
				}else if($thead[$i] == "pattern"){
					$array_key = array_keys($pattern);
					$array_val = array_values($pattern);
				}else if($thead[$i] == "color"){/////////////////////
					$array_key = array_keys($color);
					$array_val = array_values($color);
				}else if($thead[$i] == "color_tone"){/////////////////////
					$array_key = array_keys($color_tone);
					$array_val = array_values($color_tone);
				}else if($thead[$i] == "line"){
					$array_key = array_keys($line);
					$array_val = array_values($line);
				}else if($thead[$i] == "neck_line"){
					$array_key = array_keys($neck_line);
					$array_val = array_values($neck_line);
				}else if($thead[$i] == "arm_length"){
					$array_key = array_keys($arm_length);
					$array_val = array_values($arm_length);
				}else if($thead[$i] == "btn"){
					$array_key = array_keys($btn);
					$array_val = array_values($btn);
				}else if($thead[$i] == "length"){///////////////////
					$array_key = array_keys($length);
					$array_val = array_values($length);
				}else if($thead[$i] == "pocket"){
					$array_key = array_keys($pocket);
					$array_val = array_values($pocket);
				}else if($thead[$i] == "wrinkle_shape"){
					$array_key = array_keys($wrinkle_shape);
					$array_val = array_values($wrinkle_shape);
				}else if($thead[$i] == "sleeve_shape"){
					$array_key = array_keys($sleeve_shape);
					$array_val = array_values($sleeve_shape);
				}
				
				echo count($array_key);
				for($cnt=0; $cnt < count($array_key); $cnt++){
						echo '<option value="'.$array_val[$cnt].'">';
						echo $array_key[$cnt];
						echo '</option>';
				}				      				
				echo '</select></div>';				      				
			}
	}
}
?>