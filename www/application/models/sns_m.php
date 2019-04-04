<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sns_m extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function gett_sns($arrays)
	{
		$query = $this->db->get_where('sns_files', array('id' => $id));
		return $query->row_array();
	}

	function get_sns_list($table, $type='', $offset='', $limit='', $search_word = '')
	{
		$sword =  '';

		if($search_word != ''){
			//寃닿  寃쎌泥━
			$sword = ' AND (subject LIKE "%'.$search_word.'%" or contents like "%'.$search_word.'%" or original_name like "%'.$search_word.'%")';
		}

		$limit_query = '';

		if($limit != '' OR $offset !=''){
			$limit_query = ' LIMIT '.$offset.', '.$limit;
		}

		$sql = "SELECT * FROM ".$table." WHERE pid='0' ".$sword." ORDER BY id DESC".$limit_query;
		$query = $this->db->query($sql);
		if($type == 'count'){
			$result = $query->num_rows();

		}else{
			$result = $query->result();
		}
		

		return $result;
	}
	
	function get_view($id)
	{
		//議고利
		$sql0 = "UPDATE sns_files SET hits=hits+1 WHERE id='".$id."'";
		$this->db->query($sql0);



		$sql = "SELECT * FROM sns_files WHERE id='".$id."'";
		$query=$this->db->query($sql);

		//寃臾댁 諛
		$result = $query->row();

		return $result;
	}

	function insert_sns($arrays)
 	{
 		$detail = array(
 			'file_size' => (int)$arrays['file_size'],
 			'image_width' => $arrays['image_width'],
 			'image_height' => $arrays['image_height'],
 			'file_ext' => $arrays['file_ext']
 		);

		$insert_array = array(
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents'],
			'file_path' => $arrays['file_path'],
			'file_name' => $arrays['file_name'],
			'original_name' => $arrays['orig_name'],
			'detail_info' => serialize($detail),
			'reg_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('sns_files', $insert_array);

		$result = $this->db->insert_id();
		//寃곌낵 諛
		return $result;
 	}

 	function update_sns($arrays)
 	{
 		if(@$arrays['file_name'])
 		{
 			$detail = array(
 				'file_size' => (int)$arrays['file_size'],
 				'image_width' => $arrays['image_width'],
 				'image_height' => $arrays['image_height'],
 				'file_ext' => $arrays['file_ext']
 			);

 			$modify_array = array(
 				'subject' => $arrays['subject'],
 				'contents' => $arrays['contents'],
 				'file_path' => $arrays['file_path'],
 				'file_name' => $arrays['file_name'],
 				'original_name' => $arrays['original_name'],
 				'detail_info' => serialize($detail),
 				'reg_date' => date("Y-m-d H:i:s"),

 			);
 		}
 		else{

			$modify_array = array(
					'subject' => $arrays['subject'],
					'contents' => $arrays['contents']
			);
		}
		$where = array(
				'id' => $arrays['id']
		);

		$result = $this->db->update('sns_files', $modify_array, $where);

		//寃곌낵 諛
		return $result;
 	}

 	function delete_content($no)
 	{
 		$delete_array = array(
 				'id' => $no
 			);
 		$result = $this->db->delete('sns_files', $delete_array);

 		return $result;
 	}

 	function writer_check($board_id)
 	{
 		//$table = $this->uri->segment(3);
 		//$board_id = $this->uri->segment(5);

 		$sql = "SELECT user_id FROM sns_files WHERE id = '".$board_id."'";
 		$query = $this->db->query($sql);

 		return $query->row();
 	}

 	function insert_comment($arrays)
 	{
 		$insert_array = array(
 			'pid' => $arrays[' pid'],
			'user_id' => $arrays['user_id'],
			'user_name' => $arrays['user_id'],
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents'],
			'reg_date' => date("Y-m-d H:i:s")
 		);

 		$this->db->insert('sns_files', $insert_array);
 		$board_id = $this->db->insert_id();

 		return $board_id;
 	}

 	function get_comment($id)
 	{
 		$sql = "SELECT * FROM sns_files WHERE pid='".$id."' ORDER BY id DESC";
 		$query = $this->db->query($sql);

 		$result = $query->result();

 		return $result;
 	}
}
	