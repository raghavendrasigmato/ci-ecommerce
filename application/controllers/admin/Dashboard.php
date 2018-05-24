
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
		if($this->login->isLoggedIn()){
			$data['header']="Dashboard";
			$data['sub_header']="";
			$data['main_content']="back_end/dashboard_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
}