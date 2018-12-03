<?php
class Department extends CI_Model {

	public function index()
	{
		/*$query=$this->db->get('users');
		foreach ($query->result() as $row)
		{
				echo "<br>";
		        echo $row->id;
		}*/
		
		$query=$this->db->query('select * from department');

		$data=$query->result();
		return $data;
		

		/*$data=array(
			'name'=>'dola',
			'age'=>'22'
			);

		$query=$this->db->insert('users',$data);
		echo "Done";
		$sql = "INSERT INTO table (title)VALUES(".$this->db->escape($title).")";
		*/
	}
}