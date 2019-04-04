<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Item_m
	*	What to Do 	:	This class indicates the model of items. The main methods are to do transaction with database.(select/insert/update etc.)
	*					Other Methods are for providing estimating items(randomly)
*/

class Item_m extends CI_Model{
	function __construct(){
		parent::__construct();		
	}

	function setItem($item, $table){
		$insert_array = array(
			'item_name' => $item['items_name'],
			'item_path' => $item['items_path'],
			'reference_url' => $item['reference_url'],
			'season' => $item['season'],
			'pattern' => $item['pattern'],
			'type' => $item['type'],
			'point' => $item['point'],
			'created_date' => date("Y-m-d H:i:s"),
			'modified_date' => date("Y-m-d H:i:s"),
		);

		$result = $this->db->insert($table, $insert_array);
		return $result;

	}
	
	function getItem($item, $table){
		$sql = "SELECT * FROM ".$table." WHERE tid = ".$item;
		$result = $this->db->query($sql)->result();

		return $result;
	}

	function get_estimate_items($step, $gender){
		/* 	Step
			1st Step : top 	
						1	- jacket	:	man / women
						2	- shirts	:	man / women
						2.1 - blaus		:	 X  / women
			2nd Step : bottom
						3	- pants 	:	man / women
						4	- skirts	:	 X	/ women
		--------------------------------------------------
			Gender
					man 	: 0
					women 	: 1			
		*/
		require_once("application/common/item_constants.php");
		$limit = 15;						// 15개 아이템씩 randomly하게 추출

		// Checking Gender
		if(!strcmp($gender,"male"))	$table = "table_item_male";
		else 				$table = "table_item_female";	// if($gender == "female")
		// if(!strcmp($gender,"female"))	$table = "table_item_woman";
		// else 				$table = "table_item_man";	// if($gender == "female")

		// Checking the Steps
		if($step == 1){			// 1st
			$param['type'] = $type['상의/재킷,원피스,외투'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;
		}elseif($step == 2){	// 2nd
			$param1['type'] = $type['상의/블라우스'];
			$param2['type'] = $type['상의/셔츠'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param1['type']." OR type =".$param2['type']." ORDER BY RAND() LIMIT ".$limit;
		}elseif($step == 3){	// 3nd Fianl(for Men)
			$param['type'] = $type['하의/바지'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;			
		}else{					// 4rd Final(for Women)
			$param['type'] = $type['하의/치마'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;		
		}
		$query = $this->db->query($sql);
		
		$result = $query->result();
		return $result;
		
		// $result = $query->result_array();
		// $ret_value = array_rand($result, 30);		
		// return $ret_value;		
	}


	function getAllItems($table){
		$sql = "SELECT * FROM ".$table;
		$result = $this->db->query($sql)->result_array();

		return $result;
	}

	function get_estimate_more_item($serviceid, $gender, $types){
		/* 	Type
			top 	
				1	- jacket	:	man / women
				2	- shirts	:	man / women
				3 	- blaus		:	 X  / women
			bottom
				4	- pants 	:	man / women
				5	- skirts	:	 X	/ women
		--------------------------------------------------
			Gender
					man 	: 0
					women 	: 1			
		*/					
		require_once("application/common/item_constants.php");
		$limit = 20;						// n개 아이템씩 randomly하게 추출

		// Checking Gender
		if(!strcmp($gender,"male"))	$table = "table_item_male";
		else 				$table = "table_item_female";	// if($gender == "female")
		

		// Checking the Types
		if($types == 0){
			$sql = "SELECT * FROM ".$table." ORDER BY RAND() LIMIT ".$limit;
		}elseif($types == 1){
			$param['type'] = $type['상의/재킷,원피스,외투'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;
		}elseif($types == 2){			
			$param['type'] = $type['상의/셔츠'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;
		}elseif($types == 3){
			$param['type'] = $type['상의/블라우스'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;			
		}elseif($types == 4){
			$param['type'] = $type['하의/바지'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;			
		}else{
			$param['type'] = $type['하의/치마'];
			$sql = "SELECT * FROM ".$table." WHERE type = ".$param['type']." ORDER BY RAND() LIMIT ".$limit;		
		}
		$query = $this->db->query($sql);
		
		$result = $query->result();
		return $result;
	}

}
?>