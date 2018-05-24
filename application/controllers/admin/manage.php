	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Manage extends CI_Controller{
	public function index(){
			if($this->login->isLoggedIn()){				
						$data['product'] = $this->Generic_model->general_fetch_array_return_result('product', array('active_status'=>'1'));
						$data['header']="Product";
						$data['sub_header']="Sub Prodcut";
						$data['main_content']="back_end/manage_product";
						$this->load->view('back_end/layout/main',$data);
					
					}

			}
		
}