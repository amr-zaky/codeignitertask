<?php
class Stingmodel extends CI_Model {

	public function index()
	{
		
		
		$query=$this->db->query('select * from stings');

		$data=$query->result();
		return $data;
		

	
	}


	public function resum()
	{
		
		
		$query=$this->db->query('select * from resume');

		$data=$query->result();
		return $data;
		

	
	}


}