<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckingError extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('card_m');
	}
	public function findErrorFavor(){
		$this->load->model('favor_m');

		$errorIDs = $this->favor_m->findErrorFavor();

		var_dump($errorIDs);
	}

}
?>