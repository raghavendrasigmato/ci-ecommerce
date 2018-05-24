<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginCtr extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->form_validation->set_rules('userId', 'User ID', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('back_end/login_page');
		} else {
			$userId = $this->input->post('userId');
			$pwd = $this->input->post('pwd');
			$cols = array('login_id', 'pwd');
			$values = array($userId, $pwd);
			$table = 'admin';
			$row = $this->login->loginSubmit($table, $cols, $values);
			if(!empty($row)){
				//set session
				$sess_details = array(
					'userId' => $row->login_id
				);
				$this->session->set_userdata($sess_details);
				redirect(base_url('ak-admin'));
			}
			else{
				die('Invalid');
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('ak-admin'));
	}
}