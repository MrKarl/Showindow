<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	*	Developer	:	Park Pan Ki
	*	Class Name 	:	Register
	*	What to Do 	:	If the user do first login and have no rating data, register the rating data and inform.
	*/
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('admin_m');
		$this->load->helper('form');
		$this->load->helper('url');
		// $this->load->library('session');
	}	

	function index(){
		$this->main();
	}

	function _remap($method)
	{
		$this->load->view('header_view');
		if(method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}

		$this->load->view('footer_view');
	}

	function main(){
		$data['table'] = $this->admin_m->get_table_name();
		$this->load->view('admin/welcome_v',$data);
	}

	function url_explode($url, $key)
	{
		$cnt = count($url);
		for($i=0; $cnt>$i; $i++){
			if($url[$i] == $key){
				$k = $i+1;
				return $url[$k];
			}
		}
	}
	function is_upload($thead){
		for($i = 0 ; $i < $thead['col_num'] ;$i++){
			if($thead[$i] == 'item_name'){
				return TRUE;
			}
		}
		return FALSE;
	}


	function segment_explode($seg){
		//멸렇癒쇳  '/' 굅 uri瑜諛곗濡蹂
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/'){
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/'){
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}
	
	function delete(){
		$tid = $this->uri->segment(4);
		$table = $this->uri->segment(3);
		$this->load->helper('alert');
		$return = $this->admin_m->delete_card($table,$tid);

		if($return){
			alert('deleted','/admin/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(5));
		}else{
			alert('delete failed','/admin/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(5));
		}
	}	
	
	
	 function lists(){
		$this->load->library('pagination');
		
		$search_word = $page_url = $search_key = '';
		$uri_segment=5;

		$table = $this->uri->segment(3);
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if( in_array('q', $uri_array)){
			$search_word = urldecode($this->url_explode($uri_array, 'q'));
			$search_key=urldecode($this->url_explode($uri_array, 'k'));

			$page_url = '/q/'.$search_word;
			$uri_segment = 7;
		}


		$config['base_url'] = '/admin/rootlists/'.$table.'/'.$page_url.'/page/'; // paging address
		$config['total_rows'] = $this->admin_m->get_list($table, 'count','','',$search_word,$search_key);
		$config['per_page'] = 20;
		$config['uri_segment'] = $uri_segment;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['page'] = $page = $this->uri->segment($uri_segment, 1);

		if($page>1){
			$start = (($page/$config['per_page']))*$config['per_page'];
		}else{
			$start = ($page-1) * $config['per_page'];
		}

		$limit = $config['per_page'];

		$data['list'] = $this->admin_m->get_list($table, '', $start, $limit, $search_word, $search_key);
		$data['table_head'] = $this->admin_m->get_thead($table);

		$this->load->view('admin/admin_list_v',$data);
	}
	

	function write(){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$table = $this->uri->segment(3);
		//error_log($table);
		$thead = $this->admin_m->get_thead($table);


		$data['thead'] = $thead;

		if($_POST){
			if($this->is_upload($thead)){
				$config = array(
					'upload_path' => 'uploads/',
					'allowed_types' => 'gif|jpg|png',
					'encrypt_name' => TRUE,
					'max_size' => '1000'
				);		

				$this->load->library('upload',$config);

				if(!$this->upload->do_upload()){
					$data['error'] = $this->upload->display_errors();

					$this->load->view('/admin/upload_photo_v', $data);
				}else{
					$upload_data = $this->upload->data();
					for($i=3 ; $i<$thead['col_num']-2 ; $i++){
						if($thead[$i] != 'item_path'){
							$upload_data[$thead[$i]] = $this->input->post($thead[$i], true);
						}
					}					
					
					$result = $this->admin_m->insert_photo($table, $upload_data);

					redirect('/admin/lists/'.$table); 
					exit;

					//ㅻ 
					if($result){
						//sns library load
					}else{
						echo "<script> alert('.'); </script>";
						redirect('/admin/upload_photo');
					}
				}

			}
			else{
				$this->load->helper('alert');

				$uri_array = $this->segment_explode($this->uri->uri_string());

				if(in_array('page', $uri_array)){
					$pages = urldecode($this->url_explode($uri_array, 'page'));
				}
				else{
					$pages = 1;
				}

				$write_data = array();

				$write_data['table'] = $this->uri->segment(3);

				for($i=1 ; $i<($thead['col_num']-2) ; $i++){
					$write_data[$thead[$i]] = $this->input->post($thead[$i], TRUE);						
				}

				$result = $this->admin_m->insert_card($write_data);

				
				if($result){
					alert('inserted', '/admin/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					alert('rewrite','/admin/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
			}
		}else{
			if($this->is_upload($thead)){
					$this->load->view('/admin/upload_photo_v',$data);
			}
			else{
					$this->load->view('admin/admin_write_v',$data);
			}
		}		
		
	}
}