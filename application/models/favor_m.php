<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Favor_m
	*	What to Do 	:	사용자의 취향 정보를 "Rating"받아서 저장하는 모델
	*					user_id 에 유저 아이디 저장 / 
	*					item_list format은 JSON으로, 
	*					item_list1 = ['item_id' : item_id, 'item_raing' : item_rating, 'created_date' : created_date, 'modified_date' : modified_date]
	*/
class Favor_m extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function setFavor($info){
		$table = "table_favor";
		
		$num = $this->db->where('user_id',$info['tid'])
				        ->where('item_id',$info['item_id'])->count_all_results($table);
		if($num > 0){														// UPDATE
			$insert_array = array(
				'user_id' => $info['tid'],
				'item_id' => $info['item_id'],
				'gender' => $info['gender'],
				'item_rating' => $info['item_rating'],
				'modified_date' => date("Y-m-d H:i:s"),
			);

	
			$this->db->set('item_rating', $info['item_rating'], FALSE);

			$this->db->where('user_id', $info['tid']);
			$this->db->where('item_id', $info['item_id']);
			$this->db->update($table,$insert_array);


	
			$result = "update";


		}else{																// INSERT
			$insert_array = array(
				'user_id' => $info['tid'],
				'item_id' => $info['item_id'],
				'gender' => $info['gender'],
				'item_rating' => $info['item_rating'],
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date' => date("Y-m-d H:i:s"),
				);

			$outcome = $this->db->insert($table, $insert_array);
			$result = "insert";
		}
		return $result;
	}


	function rating_info(){
		$table = "table_info_tshirt_man";

		$sql = "SELECT * FROM ".$table;
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;

	}
	function setHottest($info){
		if(!strcmp("male",$info['gender']))
			$table = "table_item_male";
		else
			$table = "table_item_female";

		$sql = "SELECT point, count FROM ".$table." WHERE tid = ".$info['item_id'].";";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$point = $result['point'] + $info['item_rating'];
		$count = $result['count'] + 1;
		$item_id = $info['item_id'];
		$insert_array = array(
			'point' => $point,
			'count' => $count,
			'modified_date' => date("Y-m-d H:i:s"),
		);
		$sql = "UPDATE ".$table." SET point=".$insert_array['point'].",count=".$insert_array['count'].
		",modified_date='".$insert_array['modified_date']."' WHERE tid=".$item_id.";";

		$query = $this->db->query($sql);
	}



	function checkBeRated($serviceid, $item_id, $gender){
		if(!strcmp("male", $gender))
			$table = "table_item_male";
		else
			$table = "table_item_female";

		$sql = "SELECT * FROM table_favor WHERE item_id = ".$item_id." AND user_id = ".$serviceid;
		$query = $this->db->query($sql);
		$result = $query->result();
		
		// error_log("cnt=".count($result)." item=".$item_id);
		
		if(count($result) > 0){
			$rating = $result[0]->item_rating;
			return $rating;
		}else{
			// error_log("item_rating".$result[0]->item_rating);
			// var_dump($item_id);error_log("item_id".$item_id);
			return false;
		}
	}


	// Deprecated
	// function findErrorFavor(){
	// 	$query = "SELECT * FROM table_favor GROUP BY  user_id, item_id";

	// 	$result = $this->db->query($query)->result();
	// }
}
?>