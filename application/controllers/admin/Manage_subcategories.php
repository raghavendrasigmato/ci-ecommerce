<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Manage_subcategories extends CI_Controller
{
	public function index(){
		if($this->login->isLoggedIn()){
				
			$data['subcategories'] = $this->Generic_model->general_fetch('subcategories');
		$data['header'] = 'Subcategories';
		$data['sub_header'] = 'Manage';
		$data['main_content'] ="back_end/manage_subcategories_page" ;
		$this->load->view('back_end/layout/main',$data);
	}
}




}