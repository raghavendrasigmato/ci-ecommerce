<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_model  extends CI_MODEL
{
	public function fetch_latest_products(){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('active_status','1');
		$this->db->order_by('product_id', 'DESC');
		$this->db->limit('4');
		$res = $this->db->get();
		return $res->result();
	}

	public function fetch_product_join_cat($id){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('categories', 'products.category_id=categories.category_id');
		$this->db->where('products.product_id', $id);
		$res = $this->db->get();
		return $res->row();
	}
}