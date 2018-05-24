<?php 
defined('BASEPATH') OR exit('no direct script alloe');


class Weight extends CI_Controller
{
	public function index(){
		if($this->login->isLoggedIn()){
			if($this->input->post('submitBtn')){

				$data['header']="Weight";
				$data['sub_header']="Product Weights";
				$data['main_content']="back_end/weight_page";
				$this->load->view('back_end/layout/main',$data);
				// }else{
				// 	$response = $this->Generic_model->general_insert('categories', array('categories_name'=>$this->input->post('categories')));
				// 	if($response){
				// 		$this->session->set_flashdata('success', 'Category added successfully.');
				// 	}else{
				// 		$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
				// 	}
				// 	redirect(base_url('ak-admin/weight'));
				// }
			}


		}
	}
}