<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	TakeRecommendedItems
	*	What to Do 	:	If the user do first login and have no rating data, register the rating data and inform.
	*/
class TakeRecommendedItems extends CI_Controller{
	function __construct(){
		parent::__construct();		
	}	

	function index($userid, $numRecommendItem=10){	
		
		$cmd = "cd /home/capstone/recommender/userbased/UserBasedRecommender/target && java -jar UserBasedRecommender-0.0.1-SNAPSHOT.jar ".$userid." ".$numRecommendItem;
		// $cmd = "cd /home/capstone/recommender/userbased/UserBasedRecommender/target && java -jar UserBasedRecommender-0.0.1-SNAPSHOT.jar 68 10";// ".$numRecommendItem;
		$output = shell_exec($cmd);
		
	
		$deleteChar = array("RecommendedItem","[","]","] ","],","\"");
		$data = str_replace($deleteChar,"",$output);
		$info = explode(", ",$data);

		$information = array();
		for($i=0; $i<floor(count($info)/2); $i++){
			$information[$i]['item'] = str_replace("item:", "", $info[2*$i]);
			$information[$i]['rating'] = str_replace("value:", "", $info[2*$i+1]);
		}
		
		$param['data'] = $information;
		$this->load->view('testpage_v',$param);		
	}

	function fileIO($userid, $numRecommendItem=10){	
		

		// $cmd0 = "mysql -u root -p";
		// shell_exec($cmd0);
		// $cmd1 = "zoqtmxhs";
		// shell_exec($cmd1);
		// $cmd2 = "SELECT user_id, item_id, item_rating
		// 		FROM db_showindow.table_favor
		// 		INTO OUTFILE '/tmp/favor.csv'
		// 		FIELDS TERMINATED BY ','
		// 		LINES TERMINATED BY '\n'";
		// shell_exec($cmd2);

		// $cmd0 = "mysql -u userbased -p zoqtmxhs mysql </home/capstone/recommender/userbased/RecommenderWithFileIO/getFavorTable.sql";
		 // $cmd0 = "cd /home/capstone/recommender/userbased/RecommenderWithFileIO && ./recommendationFileIO.sh";
		 // $output = shell_exec($cmd0);

		$cmd1 = "cd /home/capstone/recommender/userbased/RecommenderWithFileIO && java -jar RecommenderWithFileIO.jar ".$userid." ".$numRecommendItem;
		// $cmd2 = "rm /tmp/favor.csv";
		 $output = shell_exec($cmd1);
		// shell_exec($cmd2);

		// $output = "USERID:1\n
		// %%%%%%%%%%\n
		// item:500138,rating:5.0\n
		// item:500206,rating:5.0\n
		// item:500166,rating:5.0\n
		// item:500093,rating:5.0\n
		// item:500178,rating:4.1517725\n
		// item:500135,rating:4.0758862\n
		// item:500196,rating:1.8482276\n
		// item:500087,rating:1.8482276\n
		// %%%%%%%%%%\n
		// item:500179,rating:5.0\n
		// item:500013,rating:5.0\n
		// item:500106,rating:5.0\n
		// item:500185,rating:5.0\n
		// item:500029,rating:5.0\n
		// item:500030,rating:5.0\n
		// item:500032,rating:5.0\n
		// item:500041,rating:5.0\n
		// item:500173,rating:5.0\n
		// item:500115,rating:5.0\n
		// item:500113,rating:5.0\n
		// item:500059,rating:5.0\n
		// item:500063,rating:5.0\n
		// item:500158,rating:5.0\n
		// item:500114,rating:5.0\n
		// item:500171,rating:5.0\n
		// item:500144,rating:5.0\n
		// item:500101,rating:5.0\n
		// item:500091,rating:5.0\n
		// item:500095,rating:4.0\n
		// item:500174,rating:4.0\n
		// item:500152,rating:4.0\n
		// item:500052,rating:4.0\n
		// item:500187,rating:4.0\n
		// item:500046,rating:4.0\n
		// item:500044,rating:4.0\n
		// item:500080,rating:4.0\n
		// item:500128,rating:4.0\n
		// item:500129,rating:4.0\n
		// item:500130,rating:4.0\n
		// item:500132,rating:4.0\n
		// item:500028,rating:4.0\n
		// item:500009,rating:4.0\n
		// item:500136,rating:4.0\n
		// item:500207,rating:4.0\n
		// item:500141,rating:4.0\n
		// item:500142,rating:4.0\n
		// item:500122,rating:4.0\n
		// item:500194,rating:4.0\n
		// item:500208,rating:4.0\n
		// item:500134,rating:3.0\n
		// item:500151,rating:3.0\n
		// item:500145,rating:3.0\n
		// item:500133,rating:3.0\n
		// item:500167,rating:3.0\n
		// item:500074,rating:3.0\n
		// item:500140,rating:3.0\n
		// item:500025,rating:3.0\n
		// item:500072,rating:3.0\n
		// item:500182,rating:3.0\n
		// item:500183,rating:2.0\n
		// item:500153,rating:2.0\n
		// item:500193,rating:2.0\n
		// item:500191,rating:2.0\n
		// item:500192,rating:2.0\n
		// item:500156,rating:2.0\n
		// item:500127,rating:1.0\n
		// item:500085,rating:1.0\n
		// item:500190,rating:1.0\n
		// item:500084,rating:1.0\n
		// %%%%%%%%%%\n
		// 91\n";
		

		$information[$i]['item'] = str_replace("item:", "", $info[2*$i]);
			$information[$i]['rating'] = str_replace("value:", "", $info[2*$i+1]);

		// $output = str_replace("\n", "", $output);
		// $output = str_replace("\r", "", $output);
		// $output = str_replace("\t", "", $output);
		$temp = explode("\n%%%%%%%%%%\n", $output);

		//temp[0] ==> userid
		//temp[1] ==> recommended items/rating
		//temp[2] ==> user's choice
		//temp[3] ==> close neighborhood
		

		$information['userid'] = $temp[0];
		
		$recommended_items = explode("\n",  $temp[1]);
		for($i=0; $i<floor(count($recommended_items)); $i++){
			$tmp = explode(",", $recommended_items[$i]);
			$information['recommended_items'][$i]['item'] = $tmp[0];
			$information['recommended_items'][$i]['rating'] = $tmp[1];
			error_log($information['recommended_items'][$i]['item']);
			error_log($information['recommended_items'][$i]['rating']);
		}

				
		$user_choice = explode("\n",  $temp[2]);
		for($i=0; $i<floor(count($user_choice)); $i++){
			$tmp = explode(",", $user_choice[$i]);
			$information['user_choice'][$i]['item'] = $tmp[0];
			$information['user_choice'][$i]['rating'] = $tmp[1];
			// error_log($i." - ".$information['user_choice'][$i]['item']);
			// error_log($i." - ".$information['user_choice'][$i]['rating']);
		}


		$close_neighbor = explode("\n", $temp[3]);
		// $information['close_neighbor'] = explode("\n", $temp[3]);		
		for($i=0; $i<floor(count($close_neighbor))-1; $i++){

			$information['close_neighbor'][$i] = $close_neighbor[$i];

			// error_log($information['close_neighbor'][$i]);
		} 

		$param['data'] = $information;
		$this->load->view('testpage_v',$param);		
	}

}

?>