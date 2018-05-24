<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generic_model  extends CI_MODEL
{
	
	public function general_fetch($tablename){
		$this->db->select('*');
		$this->db->from($tablename);
		$res = $this->db->get();
		return $res->result();
	}
	public function general_insert($tablename, $details){
		$this->db->insert($tablename, $details);
		if($this->db->affected_rows() > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function general_insert_return_id($tablename, $details){
		$this->db->insert($tablename, $details);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	public function general_fetch_array_return_result($tablename, $whereclause){
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($whereclause);
		$res = $this->db->get();
		return $res->result();
	}
	public function general_fetch_array_return_row($tablename, $whereclause){
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($whereclause);
		$res = $this->db->get();
		return $res->row();
	}
	public function general_update($tablename, $col, $id, $details){
		$this->db->where($col, $id);
		$this->db->update($tablename, $details);
		$rows = $this->db->affected_rows();
		if(isset($rows)){
			return true;
		}
		else{
			return false;
		}
	}
	public function general_update_multiple_ids($tablename, $colArray, $idArray, $details){
		foreach ($colArray as $key => $col) {
			$this->db->where($col, $idArray[$key]);
		}
		$this->db->update($tablename, $details);
		$rows = $this->db->affected_rows();
		if(isset($rows)){
			return true;
		}
		else{
			return false;
		}
	}
	public function general_delete_by_row_id($tablename,$col,$id){
		$this->db->where($col,$id);
		$this->db->delete($tablename);
		if($this->db->affected_rows()){
			return true;
		}
		else{
			return false;
		}
	}

	//danu work//
		public function general_join($basetable, $tables, $conditions, $sortCol, $sort){
			$this->db->select('*');
			$this->db->from($basetable);
			foreach ($tables as $key => $t) {
				$this->db->join($t, $conditions[$key]);
			}
			if($sortCol != ''){
				$this->db->order_by($sortCol, $sort);
			}
			$res = $this->db->get();
			return $res->result();
		}
		public function general_update_by_id($tablename,$col,$details,$id)
		{
			$this->db->where($col,$id);
			$this->db->update($tablename,$details);
			if($this->db->affected_rows())
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		public function delete_product($id)
		{
			$this->db->where('product_id',$id);
			$this->db->delete('products');
		}	
		public function general_fetch_by_id_return_row($tablename, $col, $id)
		{
			$this->db->select('*');
			$this->db->from($tablename);
			$this->db->where($col, $id);
			$res = $this->db->get();
			return $res->row();
		}
		public function fetch_image_details($products_id)
		{
		    $this->db->select('*');
		 	$this->db->from('product_images');
		 	$this->db->where('product_id',$products_id);
		 	$res=$this->db->get();
			return $res->result();	
		}
		public function remove_image($img_id)
		{
			$this->db->where('image_id',$img_id);
			$this->db->delete('product_images');
		}
		public function insert_jewellery_images($image_details)
		{
		$this->db->insert('product_images', $image_details); 
	     return $this->db->insert_id();
		}
}