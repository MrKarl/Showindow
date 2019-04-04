<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table, $type='', $offset='',$limit='', $search_word='', $search_key='')
	{
		$sword = '';

		if($search_word != ''){
			if($table == 'table_card'){
				$sword = 'WHERE contents like "%'.$search_word.'%" or tid like "%'.$search_word.'%" ';
			}else if($table == 'table_item_tshirt_man'){
				$sword = 'WHERE tid like "%'.$search_word.'%" ';
			}
		}	

		$limit_query = '';

		if($limit != '' OR $offset != '')
		{
			$limit_query = ' LIMIT '.$offset.', '.$limit;
		}

		$sql = "SELECT * FROM ".$table.' '.$sword."ORDER BY tid DESC".$limit_query;
		$query = $this->db->query($sql);

		if( $type == 'count'){
			$result = $query->num_rows();
		}else
		{
			$result = $query->result_array();
		}

		return $result;
	}

	function delete_card($table, $tid){
		$delete_array = array(
			'tid' => $tid
			);

		$result = $this->db->delete($table, $delete_array);

		return $result;
	}

	function insert_card($data){
		if($data['table'] == 'table_card'){
			$insert_data = array(

				'contents' => $data['contents'],
				'comment_id' => $data['comment_id'],
				'item_id' => $data['item_id'],
				'point' => $data['point'],
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
		$result = $this->db->insert($data['table'],$insert_data);


		return $result;
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

		$result = $this->db->insert_id();
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
}