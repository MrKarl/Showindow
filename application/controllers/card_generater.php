<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card_Generater extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('card_m');
		$this->load->model('item_m');
	}

	public function index(){
		echo "hello";
	}


	public function insert($gender){
		if($gender == 'male'){
			$table = "table_item_male";
		}else{
			$table = "table_item_female";
		}


		$items = $this->item_m->getAllItems($table);

		// $numOfitems = $items['tid'];


		foreach($items as $element){			
			$result = $this->card_m->card_generater($gender, $element['tid']);
		}
		// echo "hi";
		// $gender = "male";
		// for($i=1; $i<97 ; $i++){
		// 	$result = $this->card_m->card_generater($gender, $i);
		// 	echo $i."=".$result."<br/>";
		// }

	}
}
?>
