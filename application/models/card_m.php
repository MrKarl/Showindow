<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Card_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

/*	function delete_card($table, $tid){
		$delete_array = array(
			'tid' => $tid
			);
		$result = $this->db->delete($table, $delete_array);
		return $result;
	}*/


	function insert_card($data){
		if($data['table'] == 'table_card'){
			$insert_data = array(
				'contents' => $data['contents'],
				'comment_id' => $data['comment_id'],
				'item_id' => $data['item_id'],
				'point' => $data['point'],
				'gender' => $data['gender'],
				'user_id' => $data['user_id'],
				'isOriginal'=>$data['isOriginal'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);

		}else if($data['table'] == 'table_favor'){
			$insert_data = array(
				'user_id' => $data['user_id'],
				'item_id' => $data['item_id'],
				'item_rating' => $data['item_rating'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}else if($data['table'] == 'table_item_set_man'){
			$insert_data = array(
				'set_name' => $data['set_name'],
				'item_ids' => $data['item_ids'],
				'reference_url' => $data['reference_url'],
				'season' => $data['season'],
				'point' => $data['point'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}
		$result = $this->db->insert($data['table'], $insert_data);
		
		return $result;
	}

	function get_card($table, $card_id){
		$sql="SELECT * FROM ".$table." WHERE tid = ".$card_id;
		$query = $this->db->query($sql);
		$result = $query->row();

		return $result;
	}

	function get_original_card($item_id ,$gender){
		$table = "table_card";
		$sql="SELECT * FROM ".$table." WHERE item_id = ".$item_id." AND isOriginal = 1 AND gender = '".$gender."'";
		$query = $this->db->query($sql);
		$result = $query->result();

		return $result;
	}

	function get_item_info($item_id, $gender, $card_id){
		if($gender == 'male'){
			$table='table_item_male';
		}else{
			$table='table_item_female';
		}
		$sql="SELECT * FROM ".$table." WHERE tid = ".$item_id;
		$query=$this->db->query($sql);
		$result=$query->result();
		if($result != null){
			$data = array(
				'item_name'=>$result[0]->item_name,
				'item_path'=>$result[0]->item_path,
				'tid'=>$result[0]->tid,
				'gender'=>$gender,
				'card_id'=>$card_id
			);
		}else{
			$data = null;
		}

		return $data;
	}

	function get_my_card_list($table, $user_tid){
		$sql="SELECT * FROM ".$table." WHERE user_id = ".$user_tid." ORDER BY 'tid' ASC";
		$query = $this->db->query($sql);
		// $result = $query->result();
		$result = $query->result();

		return $result;
	}


	function get_comments($card_id){
		$query = "SELECT * FROM table_comments WHERE card_id = '".$card_id."' ORDER BY tid DESC";
		return $this->db->query($query)->result();

	}

function insert_photo($table, $arrays){
		
	if($arrays['reference_url'] == ''){

			$insert_array = array(
				'item_name' => $arrays['file_name'],
				// 'item_path' => $arrays['file_path'],
				'item_path' => "/uploads/",
				'reference_url' => $arrays['reference_url'],
				'type' => $arrays['type'],
				'material' => $arrays['material'],
				'pattern' => $arrays['pattern'],
				'color' => $arrays['color'],
				'color_tone' => $arrays['color_tone'],
				'line' => $arrays['line'],
				'neck_line' => $arrays['neck_line'],
				'arm_length' => $arrays['arm_length'],
				'btn' => $arrays['btn'],
				'length' => $arrays['length'],
				'pocket' => $arrays['pocket'],
				'point' => 0,
				'count' => 0,
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}else{
			$insert_array = array(
				'item_name' => $arrays['file_name'],
				'item_path' => $arrays['file_path'],
				'reference_url' => $arrays['reference_url'],
				'type' => $arrays['type'],
				'material' => $arrays['material'],
				'pattern' => $arrays['pattern'],
				'color' => $arrays['color'],
				'color_tone' => $arrays['color_tone'],
				'line' => $arrays['line'],
				'neck_line' => $arrays['neck_line'],
				'arm_length' => $arrays['arm_length'],
				'btn' => $arrays['btn'],
				'length' => $arrays['length'],
				'pocket' => $arrays['pocket'],
				'point' => 0,
				'count' => 0,
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}

		if($table == 'table_item_female'){
				$insert_array['wrinkle_shape'] = $arrays['wrinkle_shape'];
				$insert_array['sleeve_shape'] = $arrays['sleeve_shape'];
		}

		$this->db->insert($table, $insert_array);
		$query = $this->db->query("SELECT tid FROM ".$table." WHERE item_name = '".$arrays['file_name']."'");

		$result = $query->result_array();
		$result=$result[0]['tid'];
		//寃곌낵 諛
		return $result;
}
	function get_thead($table){


	 	$query = $this->db->query("DESC ".$table);

	 	$count = $query->num_rows();
	 	
	 	$result = $query->result_array();


	 	for($i=0 ; $i<$count ; $i++){
	 		$col_list[$i] = $result[$i]['Field'];
	 	}

	 	$col_list['col_num'] = $count;
	 	
		return $col_list;
	}


	function get_table_name(){
		$query = $this->db->query("SHOW TABLES");

		$count = $query->num_rows();

		$result = $query->result_array();

		for($i = 0; $i < $count ; $i++){
			$table_name[$i] = $result[$i]['Tables_in_db_showindow'];
		}

		$table_name['tnum'] = $count;
		return $table_name;
	}

	function insert_comments($data){
		$data['table'] = 'table_comments';
		$insert_data = array(
			'comment'=>$data['comment'],
			'card_id'=>$data['card_id'],
			'user_id'=>$data['user_id'],
			'created_date'=>date("Y-m-d H:i:s"),
			'modified_date'=>date("Y-m-d H:i:s"),
		);
		$result = $this->db->insert($data['table'],$insert_data);


		return $result;
	}
	function del_comments($tid){
		$this->db->where('tid',$tid);
		$this->db->delete('table_comments');
	}

	function delete_card($card_id){
		$this->db->where('tid',$card_id);
		$this->db->delete('table_card');
	}

 	// Deprecated	FOR TEST
	function card_generater($gender, $item_id){
		$insert_data = array(
			'user_id' => 1,
			'contents' =>  mysql_real_escape_string("이 옷 정말 좋네요 ! !!"),
			'comment_id' => 0,
			'item_id' => $item_id,
			'isOriginal' => 1,
			'point' => 0,
			'gender' => $gender,
			'created_date' => date("Y-m-d H:i:s"),
			'modified_date' => date("Y-m-d H:i:s")
		);

		$result = $this->db->insert("table_card", $insert_data);

		return $result;
	}
}