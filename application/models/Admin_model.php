<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model  extends CI_MODEL
{
	public function list_orders(){
		$this->db->select('*');
		$this->db->from('orders');
		$res = $this->db->get();
		return $res->result();
	}

	public function fetch_orders_by_id($id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_id', $id);
		$res = $this->db->get();
		return $res->result();
	}
	public function fetchSubcategories(){
		$this->db->select('s.subcategories_id, s.subcategories_name, s.categories_id, s.active_status, c.categories_id, c.categories_name');
		$this->db->from('subcategories s');
		$this->db->join('categories c', 's.categories_id=c.categories_id');
		$this->db->where('s.active_status','1');
		$this->db->order_by('subcategories_id', 'desc');
		$res = $this->db->get();
		return $res->result();
	}
	public function update_featured_status($item_id,$checked_value){
		$this->db->where('pid',$item_id);
		$this->db->update('products',array('featured_status'=>$checked_value));
		return $this->db->affected_rows();
	}	
	public function update_active_status($item_id,$checked_value){
		$this->db->where('pid',$item_id);
		$this->db->update('products',array('active_status'=>$checked_value));
		return $this->db->affected_rows();
	}	
}