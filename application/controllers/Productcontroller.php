<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productcontroller extends CI_Controller   
{

	public function index()
	{
		 $this->load->model('Product');
		 $data['products']=$this->Product->index();
		 $this->load->view("showpro",$data);
	}



	public function create()
	{
		 $this->load->model('Department');
		 $data['products']=$this->Department->index();
		 $this->load->view('createpro',$data);
		//$this->load->view("createpro");
	}

	public function store()
	{

		$pathes=array();
		/*if (isset($_POST['submit'])) {
			$name=$_POST['name'];
			$status=$_POST['status'];
			$date=$_POST['date'];
			$dep_id=$_POST['dep_id'];
			$price=$_POST['price'];
			$data=array(
				"name"=>$name,
				"dep_id"=>$dep_id,
				"status"=>$status,
				"price"=>$price,
				"createdat"=>$date,
			);

			$this->db->insert('product',$data);
			$this->load->model('Product');
		 $data['products']=$this->Product->index();
		 $this->load->view("showpro",$data);
		}*/

			 $filesCount = count($_FILES['imgs']['name']);
			 for ($i=0; $i <$filesCount;$i++) 
			 { 
			
		 $_FILES['file']['name']     = $_FILES['imgs']['name'][$i];
                $_FILES['file']['type']     = $_FILES['imgs']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['imgs']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['imgs']['error'][$i];
                $_FILES['file']['size']     = $_FILES['imgs']['size'][$i];
                

		$config['upload_path']          = 'img/products/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 99999;
        $config['max_width']            = 99999;
        $config['max_height']           = 99999;
        $config['encrypt_name'] =TRUE;		
		
		$new_name = time().$_FILES["imgs"]['name'][$i];
		$config['file_name']=$new_name;
		$this->load->library('upload', $config);
		

		 if ( !$this->upload->do_upload('file'))
            {
                        
                        $error = array('error' => $this->upload->display_errors());

                        return print_r($error);
            }

            else 
            {
            		 
            		$data = array('upload_data' => $this->upload->data());

            		$pathes[]=$fullpath=$config['upload_path'] .$data['upload_data']['file_name'];
            }


			 }

			 $pathes= implode("*",$pathes);
			if(! empty($pathes))
			{
				$name=$_POST['name'];
			$status=$_POST['status'];
			$date=$_POST['date'];
			$dep_id=$_POST['dep_id'];
			$price=$_POST['price'];
			$dataa=array(
				"name"=>$name,
				"dep_id"=>$dep_id,
				"status"=>$status,
				"price"=>$price,
				"createdat"=>$date,
				"imgs"=>$pathes
			);

			$this->db->insert('product',$dataa);
			$this->load->model('Product');
		 $data['products']=$this->Product->index();
		 $this->load->view("showpro",$data);

			}

	}


	public function deleteitem($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('product');
		$this->load->model('Product');
		 $data['products']=$this->Product->index();
		 $this->load->view("showpro",$data);
	}


	public function selectedid($id)
	{
		 $query = $this->db->get_where('product',array('id' => $id),1,0);

		 $data['department']=$query->row();

		  $this->load->model('Department');
		 $data['products']=$this->Department->index();

    	 $this->load->view('updatepro',$data);
	}


	public function update()
	{

			if (isset($_POST['submit'])) {
			$id=$_POST['id'];
			$name=$_POST['name'];
			$status=$_POST['status'];
			$date=$_POST['date'];
			$dep_id=$_POST['dep_id'];
			$price=$_POST['price'];
			$data=array(
				"name"=>$name,
				"dep_id"=>$dep_id,
				"status"=>$status,
				"price"=>$price,
				"createdat"=>$date,
			);

		$this->db->where('id', $id);
		$this->db->update('product', $data);

		$this->load->model('Product');
		 $data['products']=$this->Product->index();
		 $this->load->view("showpro",$data);



	}
}



 public function activechange()
 {
 	$id=$_POST['id'];
 	$data=array(
				
				"status"=>'1',
			);

		$this->db->where('id', $id);
		$this->db->update('product', $data);

			print_r($id);


 }

}