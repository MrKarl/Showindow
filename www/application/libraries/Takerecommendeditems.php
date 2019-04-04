<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	TakeRecommendedItems
	*	What to Do 	:	To execute the Mahout Recommend Program using system colsole.
	*					Each function indicates how to recommend such as userbased or itembased or hottest item(using PHP).
	*/

class Takerecommendeditems {
	
    public function user_based_recommend($userid, $numRecommendItem=10){
	// function index($userid){
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

		return $information;
	}



	public function user_based_fileIO($userid, $numRecommendItem=10){	


		$cmd0 = "cd /home/capstone/recommender/userbased/RecommenderWithFileIO && ./recommendationFileIO.sh";
		shell_exec($cmd0);

		$cmd1 = "cd /home/capstone/recommender/userbased/RecommenderWithFileIO && java -jar RecommenderWithFileIO.jar ".$userid." ".$numRecommendItem;
		$output = shell_exec($cmd1);
		
		$cmd2 = "rm /tmp/favor.csv";
		shell_exec($cmd2);


		$temp = explode("\n%%%%%%%%%%\n", $output);

		//temp[0] ==> userid
		//temp[1] ==> recommended items/rating
		//temp[2] ==> user's choice
		//temp[3] ==> close neighborhood

		
		
		$information['recommended_items']=NULL;
		$information['user_choice_items']=NULL;
		$information['close_neighbor']=NULL;

		$information['userid'] = $temp[0];
		
		$recommended_items = explode("\n",  $temp[1]);
		for($i=0; $i<floor(count($recommended_items)); $i++){
			$tmp = explode(",", $recommended_items[$i]);
			$information['recommended_items'][$i]['item'] = $tmp[0];
			$information['recommended_items'][$i]['rating'] = $tmp[1];
			// error_log($information['recommended_items'][$i]['item']);
			// error_log($information['recommended_items'][$i]['rating']);
		}

				
		$user_choice = explode("\n",  $temp[2]);
		for($i=0; $i<floor(count($user_choice)); $i++){
			$tmp = explode(",", $user_choice[$i]);
			$information['user_choice_items'][$i]['item'] = $tmp[0];
			$information['user_choice_items'][$i]['rating'] = $tmp[1];
			// error_log($i." - ".$information['user_choice'][$i]['item']);
			// error_log($i." - ".$information['user_choice'][$i]['rating']);
		}


		$close_neighbor = explode("\n", $temp[3]);
		// $information['close_neighbor'] = explode("\n", $temp[3]);		
		for($i=0; $i<floor(count($close_neighbor))-1; $i++){
			$information['close_neighbor'][$i] = $close_neighbor[$i];
		} 

		return $information;	
	}

}

	/* End of file Someclass.php */

?>