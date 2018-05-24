<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {
	public function index(){
		if($this->login->isLoggedIn()){
			$data['header']="Stocks";
			$data['sub_header']="Manage stock";
			$data['main_content']="back_end/stocks_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
}