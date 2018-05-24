<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Orders extends CI_Controller{
public function index (){
		if($this->login->isLoggedIn()){
			// if($this->input->post('submitBtn')){
			// 	$this->form_validation->set_rules('order', 'order', 'required');
			// 	if ($this->form_validation->run() == FALSE) {
						
					$data['order'] = $this->Admin_model->list_orders('orders');
					$data['header']="Order";
					$data['sub_header']="Order_List";
					$data['main_content']="back_end/list_order_page";
					$this->load->view('back_end/layout/main',$data);
				}
			}

			//add order page
			public function add_order_view(){
				if($this->login->isLoggedIn()){
					$data['header']="Order";
					$data['sub_header']="Add order";
					$data['main_content']="back_end/add_order_page";
					$this->load->view('back_end/layout/main',$data);
				}
			}


			public function view_order_page(){
				$order_id = $this->uri->segment(4);
				$data['order_details'] = $this->Generic_model->general_fetch_by_id_return_row('orders','order_id',$order_id);
				$data['header'] = "List order";
				$data['sub_header'] = "view details";
				$data['main_content'] = "back_end/view_order_page";
				$this->load->view('back_end/layout/main',$data);				 
			}	

			
		}






 