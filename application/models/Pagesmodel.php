<?php
class Pagesmodel extends CI_Model {

	public function index()
	{
		
		
		$query=$this->db->query('select * from staticpages');

		$data=$query->result();
		return $data;
		

	
	}
}