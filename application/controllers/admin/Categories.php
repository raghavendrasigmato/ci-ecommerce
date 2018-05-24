<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	public function index(){
		if($this->login->isLoggedIn()){
			if($this->input->post('submitBtn')){
				$this->form_validation->set_rules('categories', 'categories', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data['categories'] = $this->Generic_model->general_fetch_array_return_result('categories', array('active_status'=>'1'));

					$data['header']="Categories";
					$data['sub_header']="";
					$data['main_content']="back_end/categories_page";
					$this->load->view('back_end/layout/main',$data);
				}else{
					$response = $this->Generic_model->general_insert('categories', array('categories_name'=>$this->input->post('categories')));
					if($response){
						$this->session->set_flashdata('success', 'Category added successfully.');
					}else{
						$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
					}
					redirect(base_url('ak-admin/categories'));
				}

			}else{
				$data['categories'] = $this->Generic_model->general_fetch_array_return_result('categories', array('active_status'=>'1'));

				$data['header']="Categories";
				$data['sub_header']="Manage categories";
				$data['main_content']="back_end/categories_page";
				$this->load->view('back_end/layout/main',$data);
			}
		}
	}
//inactive categories code..
public function inactive(){
		if($this->login->isLoggedIn()){
			/*update subcategory*/
			$details = array(
				'active_status' => '0'
			);
			$this->Generic_model->general_update('subcategories', 'categories_id', $this->uri->segment(4), $details);

			$details = array(
				'active_status' => '0'
			);
			$response = $this->Generic_model->general_update('categories', 'categories_id', $this->uri->segment(4), $details);
			if($response){
				$this->session->set_flashdata('success', 'Category deleted successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect(base_url('ak-admin/categories'));
		}
	}

	public function update(){
		if($this->login->isLoggedIn()){
			$details = array(
				'categories_name' => $this->input->post('categories')
			);
			$response = $this->Generic_model->general_update('categories', 'categories_id', $this->uri->segment(4), $details);
			if($response){
				$this->session->set_flashdata('success', 'Category updated successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect(base_url('ak-admin/categories'));
		}
	}
}