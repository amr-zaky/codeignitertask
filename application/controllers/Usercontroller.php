<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercontroller extends CI_Controller   {

		
	  public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }
	

	public function index()
	{
		
		 $this->load->model('Department');
		 $data['products']=$this->Department->index();
		 $this->load->view('view',$data);

	}


	public function create()
	{
		$this->load->view('create');
	}

	public function do_upload()
	{
		/*if (isset($_POST['submit'])) {
			$name=$_POST['name'];
			$status=$_POST['status'];
			$date=$_POST['date'];
			$data=array(
				"name"=>$name,
				"status"=>$status,
				"createdat"=>$date
			);

			$this->db->insert('department',$data);
			 $this->load->model('Department');
		 	$data['products']=$this->Department->index();
			$this->load->view('view',$data);
		}*/

        $config['upload_path']          = 'img/department/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 99999;
        $config['max_width']            = 99999;
        $config['max_height']           = 99999;
        $config['encrypt_name'] = TRUE;		
		
		$new_name = time().$_FILES["img"]['name'];
		$config['file_name']=$new_name;
		
		$this->load->library('upload', $config);

		 if ( ! $this->upload->do_upload('img'))
            {
                        
                        $error = array('error' => $this->upload->display_errors());

                        return print_r($error);
            }
                else
                {

                		$data = array('upload_data' => $this->upload->data());
                       
						$name=$_POST['name'];
						$status=$_POST['status'];
						$date=$_POST['date'];
						$img=$config['upload_path'].$data['upload_data']['file_name'];
						$data=array(
							"name"=>$name,
							"status"=>$status,
							"createdat"=>$date,
							"imge"=>$img
						);

						$this->db->insert('department',$data);
						 $this->load->model('Department');
					 	$data['products']=$this->Department->index();
						$this->load->view('view',$data);
					

                }



	}


	public function selectedid($id)
	{
		 $query = $this->db->get_where('department', array('id' => $id),1,0);

		 $data['department']=$query->row();
    	 $this->load->view('update',$data);

	}

	public function update()
	{	
			if($_FILES['img']['name'] =='')
			{
			$name=$_POST['name'];
			$status=$_POST['status'];
			$date=$_POST['date'];
			$id=$_POST['id'];
			$data=array(
				"name"=>$name,
				"status"=>$status,
				"createdat"=>$date
			);

		$this->db->where('id', $id);
		$this->db->update('department', $data);

		$this->load->model('Department');
		$data['products']=$this->Department->index();
		$this->load->view('view',$data);
	
	}

	else 
	{

		$id=$_POST['id'];
		

		$query = $this->db->get_where('department', array('id' => $id),1,0);

		 $data['department']=$query->row();
		 unlink($data['department']->imge);


		  $config['upload_path']          = 'img/department/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 99999;
        $config['max_width']            = 99999;
        $config['max_height']           = 99999;
        $config['encrypt_name'] = TRUE;		
		
		$new_name = time().$_FILES["img"]['name'];
		$config['file_name']=$new_name;
		
		$this->load->library('upload', $config);

		 if ( ! $this->upload->do_upload('img'))
            {
                        
                        $error = array('error' => $this->upload->display_errors());

                        return print_r($error);
            }
                else
                {

                		$data = array('upload_data' => $this->upload->data());
                       
						$name=$_POST['name'];
						$status=$_POST['status'];
						$date=$_POST['date'];
						$img=$config['upload_path'].$data['upload_data']['file_name'];
						$data=array(
							"name"=>$name,
							"status"=>$status,
							"createdat"=>$date,
							"imge"=>$img
						);

						$this->db->where('id', $id);
						$this->db->update('department', $data);
						 $this->load->model('Department');
					 	$data['products']=$this->Department->index();
						$this->load->view('view',$data);
					

                }



	}
	
   }


   public function deleteitem($id)
   {
   		$this->db->where('id', $id);
		$this->db->delete('department');

		$this->load->model('Department');
		$data['products']=$this->Department->index();
		$this->load->view('view',$data);
   }
}
