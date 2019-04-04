<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('card_m');
		$this->load->model('user_m');
	}
	public function index(){
		//nothing
	}

	public function deleteCard(){
		$card_id = $this->input->post('card_id', true);
		$this->card_m->delete_card($card_id);
	}

	public function deleteComment(){
		$my_session_id = $this->session->userdata['user_id'];
		$my_info = $this->user_m->getUserInfo($my_session_id);	
		$tid=$my_info[0]['tid'];
		$comment_id = $this->input->post('comment_id', true);
		$user_id = $this->input->post('user_id', true);
		if($tid==$user_id){
			$this->card_m->del_comments($comment_id);	
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
					<p class="reply_contents">'.$lt->comment.'</p>
					<button type="button" class="close" onclick="delComment('.$lt->tid.','.$card_id.')">x</button>
				</div>';
			}
		}else{
			echo '1000';
		}
	}

}
?>