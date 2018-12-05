<?php
class Downloadmodel extends CI_Model {

	public function index()
	{
		
		
		$query=$this->db->query('select * from downloads');

		$data=$query->result();
		return $data;
		

	
	}
}