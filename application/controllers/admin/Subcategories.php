<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

class Subcategories extends CI_Controller{	
	public function index(){
		if($this->login->isLoggedIn()){
			//dispaly form DB
			$data['categories'] = $this->Generic_model->general_fetch_array_return_result('categories', array('active_status'=>'1'));
			$data['subcats'] = $this->Admin_model->fetchSubcategories();
			//First display
			$data['header'] = "Subcategories";
			$data['sub_header']= "Manage";
			$data['main_content']= "back_end/subcategories_page";
			$this->load->view('back_end/layout/main',$data);
		}				
	}
	public function add_subcategories(){
		$details = array(
			'categories_id'=>$this->input->post('categories_id'),
			'subcategories_name'=>$this->input->post('subcategories')
		);
		$response = $this->Generic_model->general_insert('subcategories',$details);
		if($response){
			$this->session->set_flashdata('success', 'Subcategory added successfully.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect(base_url('ak-admin/sub-categories'));		
	}


//update categories code..
	public function update(){
		if($this->login->isLoggedIn()){
			$details = array(
				'categories_id' => $this->input->post('cat_id'),
				'subcategories_name' => $this->input->post('subcategories')
			);
			$response = $this->Generic_model->general_update('subcategories', 'subcategories_id', $this->uri->segment(4), $details);
			if($response){
				$this->session->set_flashdata('success', 'Sub-category updated successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect(base_url('ak-admin/sub-categories'));
		}
	}
	public function inactive(){
		if($this->login->isLoggedIn()){
			$details = array(
				'active_status' => '0'
			);
			$response = $this->Generic_model->general_update('subcategories', 'subcategories_id', $this->uri->segment(4), $details);
			if($response){
				$this->session->set_flashdata('success', 'Sub-category deleted successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect(base_url('ak-admin/sub-categories'));
		}
	}
}