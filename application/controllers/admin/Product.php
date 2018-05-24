<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
	public function index(){
		if($this->login->isLoggedIn()){
			$data['products'] = $this->Generic_model->general_fetch('products');
			$data['header']="Products";
			$data['sub_header']="Manage Products";
			$data['main_content']="back_end/manage_product_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
	public function addProduct(){
		if($this->login->isLoggedIn()){
			$product_id = $this->uri->segment(4);
			$data['categories'] = $this->Generic_model->general_fetch_array_return_result('categories', array('active_status'=>'1'));
			$data['attributes_select'] = $this->Generic_model->general_fetch('attributes');
			$data['brands'] = $this->Generic_model->general_fetch('brands');
			$data['header']="Product";
			$data['sub_header']="Add Product";
			$data['main_content']="back_end/add_product_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
	public function editProduct(){
		if($this->login->isLoggedIn()){
			$product_id = $this->uri->segment(4);
			$data['categories'] = $this->Generic_model->general_fetch_array_return_result('categories', array('active_status'=>'1'));
			$data['attributes_select'] = $this->Generic_model->general_fetch('attributes');
			$data['brands'] = $this->Generic_model->general_fetch('brands');
			$data['products'] = $this->Generic_model->general_fetch_by_id_return_row('products','pid',$product_id);
			$data['stock_master_details'] = $this->Generic_model->general_fetch_array_return_result('stock_master',array('pid'=>$product_id));
			$data['images'] = $this->Generic_model->general_fetch_array_return_result('images',array('pid'=>$product_id));
			$data['shippingdetails'] = $this->Generic_model->general_fetch_array_return_result('shipping_master',array('pid'=>$product_id));
			$t = $data['pricingdetails'] = $this->Generic_model->general_fetch_array_return_result('pricing_structure',array('pid'=>$product_id));
			$data['header']="Product";
			$data['sub_header']="Edit Product";
			$data['main_content']="back_end/edit_product_page";
			$this->load->view('back_end/layout/main',$data);
		}
	}
	public function productFormSubmit(){
//insert to product master table
		$details = array(
			'cat_id' => $this->input->post('category_id'),
			'sub_cat_id' => $this->input->post('subcategory_id'),
			'name' => $this->input->post('prod_name'),
			'brand_id' => $this->input->post('brand_id'),
			'summary' => $this->input->post('summary'),
			'description' => $this->input->post('description'),
			'added_on' => date('Y-m-d')
		);
		$product_id = $this->Generic_model->general_insert_return_id('products', $details);
//insert to pricing structure
		foreach ($this->input->post('attr_price') as $key => $attr) {
			$onSale = '1';
			if($this->input->post('onSaleStruct['.$key.']') == ''){
				$onSale = '0';
			}
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr, 'value'=>$this->input->post('value_price['.$key.']')))->map_id;
			$details = array(
				'pid' => $product_id,
				'map_id' => $map_id,
				'retail_price' => $this->input->post('price_tax_excl_struct['.$key.']'),
				'retail_price_tax' => $this->input->post('price_tax_incl_struct['.$key.']'),
				'cost_price' => $this->input->post('cost_price_tax_excl_struct['.$key.']'),
				'on_sale_status' => $onSale
			);
			$this->Generic_model->general_insert('pricing_structure', $details);
		}
//insert product images
		for($i=0;$i<count($_FILES['images']['name']);$i++)
		{
			$target = './assets/backend/img/';
			$date = date('dmyhis');
			$myfile = $date.$_FILES['images']['name'][$i];
			$target1 = $target.$myfile;
			move_uploaded_file($_FILES['images']['tmp_name'][$i],$target1);
			$image_details = array('pid'=>$product_id, 'image_path'=>'http://localhost/amruth/'.$target1);
			$response = $this->Generic_model->general_insert('images', $image_details);
		}
//insert to stock master table
		foreach ($this->input->post('attr_variant') as $key => $attr_variant) {
			$oos = $this->input->post('oos'.($key+1));
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr_variant, 'value'=>$this->input->post('value_variant['.$key.']')))->map_id;
			$skuid = str_replace(' ', '', $this->input->post('skuid['.$key.']'));
			$details = array(
				'pid' => $product_id,
				'skuid' => $skuid,
				'map_id' => $map_id,
				'instock' => $this->input->post('qty['.$key.']'),
				'reorder_level' => $this->input->post('reorder['.$key.']'),
				'min_qty_to_order' => $this->input->post('min_qty['.$key.']'),
				'oos_status' => $oos
			);
			$this->Generic_model->general_insert('stock_master', $details);
		}
//insert to shipping master table
		foreach ($this->input->post('attr') as $key => $attr) {
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr, 'value'=>$this->input->post('values['.$key.']')))->map_id;
			$details = array(
				'pid' => $product_id,
				'map_id' => $map_id,
				'cost' => $this->input->post('cost['.$key.']')
			);
			$response = $this->Generic_model->general_insert('shipping_master', $details);
		}
		if($response){
			$this->session->set_flashdata('success', 'Product added successfully.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('ak-admin/add-product');
	}
//Edit Product details
	public function productEditFormSubmit(){
		$product_id = $this->uri->segment(4); 
		$details = array(
			'cat_id' => $this->input->post('category_id'),
			'sub_cat_id' => $this->input->post('subcategory_id'),
			'name' => $this->input->post('prod_name'),
			'brand_id' => $this->input->post('brand_id'),
			'summary' => $this->input->post('summary'),
			'description' => $this->input->post('description'),
			'added_on' => date('Y-m-d')
		);
		$this->Generic_model->general_update_by_id('products','pid',$details,$this->uri->segment(4));

		foreach ($this->input->post('attr_variant') as $key => $attr_variant) {
			$oos = $this->input->post('oos'.($key+1));
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr_variant, 'value'=>$this->input->post('value_variant['.$key.']')))->map_id;
			$skuid = str_replace(' ', '', $this->input->post('skuid['.$key.']'));
			$details = array(
				'skuid' => $skuid,
				'map_id' => $map_id,
				'instock' => $this->input->post('qty['.$key.']'),
				'reorder_level' => $this->input->post('reorder['.$key.']'),
				'min_qty_to_order' => $this->input->post('min_qty['.$key.']'),
				'oos_status' => $oos
			);
			$this->Generic_model->general_update_by_id('stock_master','stock_master_id',$details,$this->input->post('stockMasterId['.$key.']'));
		}

		foreach ($this->input->post('attr') as $key => $attr) {
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr, 'value'=>$this->input->post('values['.$key.']')))->map_id;
			$details = array(
				'map_id' => $map_id,
				'cost' => $this->input->post('cost['.$key.']')
			);
			$this->Generic_model->general_update_by_id('shipping_master','shipping_master_id',$details,$this->input->post('shippingMasterId['.$key.']'));
		}

		foreach ($this->input->post('attr_price') as $key => $attr) {
			$onSale = '1';
			if($this->input->post('onSaleStruct['.$key.']') == ''){
				$onSale = '0';
			}
			$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$attr, 'value'=>$this->input->post('value_price['.$key.']')))->map_id;
			$details = array(
				'map_id' => $map_id,
				'retail_price' => $this->input->post('price_tax_excl_struct['.$key.']'),
				'retail_price_tax' => $this->input->post('price_tax_incl_struct['.$key.']'),
				'cost_price' => $this->input->post('cost_price_tax_excl_struct['.$key.']'),
				'on_sale_status' => $onSale
			);
			$response =	$this->Generic_model->general_update_by_id('pricing_structure','structure_id', $details,$this->input->post('structureId['.$key.']'));
		}

		$response = true;
		if($response){
			$this->session->set_flashdata('success', 'Product Updated successfully.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('admin/product/editProduct/'.$product_id);
	}	
	//Add new quantity variant
	public function addNewVariant(){
		$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$this->input->post('newAttr'), 'value'=>$this->input->post('newValue')))->map_id;
		$skuid = str_replace(' ', '', $this->input->post('skuidNew'));
		$details = array(
			'pid' => $this->uri->segment(4),
			'skuid' => $skuid,
			'map_id' => $map_id,
			'instock' => $this->input->post('qtyNew'),
			'reorder_level' => $this->input->post('reorderLevelNew'),
			'min_qty_to_order' => $this->input->post('minQtyNew'),
			'oos_status' => $this->input->post('oosNew')
		);
		$response = $this->Generic_model->general_insert('stock_master', $details);
		if($response){
			$this->session->set_flashdata('success', 'Product Updated successfully with new variant.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('admin/product/editProduct/'.$this->uri->segment(4));
	}
	//Add new shipping row
	public function addNewShippingRow(){
		$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$this->input->post('newRowAttr'), 'value'=>$this->input->post('newRowValue')))->map_id;
		$details = array(
			'pid' => $this->uri->segment(4),
			'map_id' => $map_id,
			'cost' => $this->input->post('costRowNew')
		);
		$response = $this->Generic_model->general_insert('stock_master', $details);
		if($response){
			$this->session->set_flashdata('success', 'Product Updated successfully with new variant.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('admin/product/editProduct/'.$this->uri->segment(4));
	}
	//Add new structure row
	public function addNewStructureRow(){
		$map_id = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('attribute_id'=>$this->input->post('newStructureAttr'), 'value'=>$this->input->post('newStructureValue')))->map_id;
		$onSale = '1';
		if($this->input->post('onSaleStruct') == ''){
			$onSale = '0';
		}
		$details = array(
			'pid' => $this->uri->segment(4),
			'map_id' => $map_id,
			'retail_price' => $this->input->post('price'),
			'retail_price_tax' => $this->input->post('priceTax'),
			'cost_price' => $this->input->post('costPrice'),
			'on_sale_status' => $onSale
		);
		$response = $this->Generic_model->general_insert('pricing_structure', $details);
		if($response){
			$this->session->set_flashdata('success', 'Product Updated successfully with new pricing structure.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('admin/product/editProduct/'.$this->uri->segment(4));
	}
//Delete Product details
	public function deleteProducts(){
		$id = $this->uri->segment(4);
		$this->Generic_model->general_delete_by_row_id('pricing_structure','pid',$id);
		$this->Generic_model->general_delete_by_row_id('shipping_master','pid',$id);
		$this->Generic_model->general_delete_by_row_id('stock_master','pid',$id);
		$this->Generic_model->general_delete_by_row_id('images','pid',$id);
		$response = $this->Generic_model->general_delete_by_row_id('products','pid',$id);
		if($response){
			$this->session->set_flashdata('success', 'Product deleted successfully.');
		}else{
			$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
		}
		redirect('ak-admin/products');
	}
//inactive categories code..
	public function inactive(){
		if($this->login->isLoggedIn()){
			$details = array(
				'active_status' => '0'
			);
			$response = $this->Generic_model->general_update('product', 'product_id', $this->uri->segment(4), $details);
			if($response){
				$this->session->set_flashdata('success', 'Category deleted successfully.');
			}else{
				$this->session->set_flashdata('failure', 'Oops!! Something went wrong. Try again...');
			}
			redirect(base_url('ak-admin/product'));
		}
	}
	public function Ajax_fetch_sub_categories(){
		$id = $_POST['cat_id'];
		$result = $this->Generic_model->general_fetch_array_return_result('subcategories', array('categories_id'=>$id));
		$reply = '
		<option selected="" disabled="" value="">Select subcategory</option>
		';
		foreach ($result as $key => $row) {
			$reply .= '
			<option value="'.$row->subcategories_id.'">'.$row->subcategories_name.'</option>
			';
		}
		echo $reply;
	}
	public function Ajax_fetch_values(){
		$attr_id = $_POST['attr_id'];
		$result = $this->Generic_model->general_fetch_array_return_result('map_attributes_values', array('attribute_id'=>$attr_id));
		$reply = '
		<option selected="" value="">Select value</option>
		';
		foreach ($result as $key => $row) {
			$reply .= '
			<option value="'.$row->value.'">'.$row->value.'</option>
			';
		}
		echo $reply;
	}
	public function Ajax_generate_sku(){
		$count=count($this->Generic_model->general_fetch('stock_master'))+1;
		echo $count;
	}

	public function update_featured_status(){
		if($_POST)
		{
			$item_id=$_POST['product_Id'];
			$checked_value=$_POST['checked_value'];
			$query = $this->Admin_model->update_featured_status($item_id,$checked_value);

			$status = "false";

			if ($this->db->affected_rows() > 0)
			{
				$status = "true";
			}
			echo $status;
		}
	}
	public function update_active_status(){
		if($_POST)
		{
			$item_id = $_POST['product_Id'];
			$checked_value = $_POST['checked_value'];
			$query = $this->Admin_model->update_active_status($item_id,$checked_value);

			$status = "false";

			if ($this->db->affected_rows() > 0)
			{
				$status = "true";
			}
			echo $status;
		}
	}
}