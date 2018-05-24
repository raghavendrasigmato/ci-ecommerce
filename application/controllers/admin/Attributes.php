
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {
	public function index(){
		if($this->login->isLoggedIn()){
			$data['attributes'] = $this->Generic_model->general_fetch('attributes');

			$data['header']="Attributes";
			$data['sub_header']="";
			$data['main_content']="back_end/attributes_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
	public function addAttr(){
		if($this->login->isLoggedIn()){
			$details = array(
				'attribute_name' => $this->input->post('attr')
			);
			$response = $this->Generic_model->general_insert('attributes', $details);
			if($response){
				$this->session->set_flashdata('success', 'Attribute added successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect('ak-admin/attributes');
		}
	}
	public function addValues(){
		if($this->login->isLoggedIn()){
			$response = $this->Generic_model->general_insert('map_attributes_values', array('attribute_id'=>$this->input->post('attrId'),'value' => $this->input->post('value')));
			if($response){
				$this->session->set_flashdata('success', 'Attribute value added successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect('ak-admin/attributes');
		}
	}
	public function removeValue(){
		if($this->login->isLoggedIn()){
			$response = $this->Generic_model->general_delete_by_row_id('map_attributes_values', 'map_id', $this->uri->segment(4));
			if($response){
				$this->session->set_flashdata('success', 'Attribute value deleted successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect('ak-admin/attributes');
		}
	}
	public function removeAttr(){
		if($this->login->isLoggedIn()){
			/*remove the map*/
			$this->Generic_model->general_delete_by_row_id('map_attributes_values', 'attribute_id', $this->uri->segment(4));

			/*remove the attribute*/
			$response = $this->Generic_model->general_delete_by_row_id('attributes', 'attribute_id', $this->uri->segment(4));
			if($response){
				$this->session->set_flashdata('success', 'Attribute deleted successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect('ak-admin/attributes');
		}
	}
	public function updateAttr(){
		if($this->login->isLoggedIn()){
			$details = array(
				'attribute_name' => $this->input->post('attr')
			);
			$response = $this->Generic_model->general_update('attributes', 'attribute_id', $this->input->post('attrId'), $details);
			if($response){
				$this->session->set_flashdata('success', 'Attribute updated successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect('ak-admin/attributes');
		}
	}

}