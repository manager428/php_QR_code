<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 function __construct() {
		parent::__construct();
		// if($this->session->userdata('logged_in') !== TRUE){
		// 	redirect('home', 'refresh');
		// }
		// $this->load->model('mlanguagesite');
		// $this->load->model('mglobal');

 }

	public function index()
	{
		

		

		if(($this->session->userdata('lan_id')) == null) {
			$sesdata = array(
				'lan_id' => 1,
				'lan_flag' => 'fr',
				'lan_name' => 'Français'
			);
			
			$this->session->set_userdata($sesdata);
		}

		$raw = array();
		$data['content'] = $this->load->view("client/pages/home", $raw , true);
		$this->load->view('client/layout/main', $data);
	}

	public function datalist()
	{
		$raw = array();
		$datalist = $this->mlanguagesite->get_list();
		echo json_encode(['data' => $datalist]);
	}

	public function add()
	{

		$raw = array();
		$raw["languages"] = $this->mlanguagesite->get_language_list(); 
		$data['content'] = $this->load->view("admin/pages/language/site/add", $raw , true);
		$this->load->view('admin/layout/main_layout', $data);
	}

	public function edit()
	{
		$raw = array();
		$text_id = $this->uri->segment(3);
		$info = $this->mlanguagesite->get_item($text_id);
		$raw["languages"] = $this->mlanguagesite->get_language_list(); 
		$raw['info'] = $info;
		$data['content'] = $this->load->view("admin/pages/language/site/edit", $raw , true);
		$this->load->view('admin/layout/main_layout', $data);
	}

	public function delete()
	{
		$raw = array();
		$id = $this->input->post("data_id");
		$result = $this->mlanguagesite->delete($id);
		if($result){
			echo json_encode( array("status" => 1) );
		}else{
			echo json_encode( array("status" => 0) );
		}
	}

	function data_exists($table, $condition)
	{
		$result = $this->mglobal->data_exists($table, $condition);
		return $result;
	}
}
