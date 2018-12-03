<?php
class Product extends CI_Model 
{

	public function index()
	{	
		$query=$this->db->query('select * from product');
		$data=$query->result();
		return $data;
	}



}