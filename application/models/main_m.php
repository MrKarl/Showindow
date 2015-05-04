<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
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
				'gender' => $data['gender'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}
		$result = $this->db->insert($data['table'],$insert_data);


		return $result;
	}

	function get_card($table, $card_id){
		$sql="SELECT * FROM ".$table." WHERE tid = ".$card_id;
		$query = $this->db->query($sql);
		$result = $query->row();

		return $result;
	}

	function insert_photo($table, $arrays){
		$table = 'table_item_tshirt_man';

		if($arrays['reference_url'] == ''){

			$insert_array = array(
				'item_name' => $arrays['file_name'],
				'season' => $arrays['season'],
				'pattern' => $arrays['pattern'],
				'type' => $arrays['type'],
				'point' => $arrays['point'],
				'item_path' => $arrays['file_path'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
		}else{
			$insert_array = array(
				'season' => $arrays['season'],
				'pattern' => $arrays['pattern'],
				'type' => $arrays['type'],
				'point' => $arrays['point'],
				'reference_url' => $arrays['reference_url'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s")
			);
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