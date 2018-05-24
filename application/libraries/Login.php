<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Login{
	function __construct(){
		//parent::__construct();
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->model('Generic_model');
		
	}
	public function loginPage(){
		$this->CI->load->view('back_end/login_page');
	}
	public function isLoggedIn(){
		$sess_var = $this->CI->session->userdata('userId');
		if(isset($sess_var)){
			return true;
		}else{
			$this->loginPage();
		}
	}
	public function loginSubmit($table, $cols, $values){
		$whereclause = array();
		foreach ($cols as $key => $col) {
			$whereclause[$col] = $values[$key];
		}
		return $this->CI->Generic_model->general_fetch_array_return_row($table, $whereclause);
	}
}