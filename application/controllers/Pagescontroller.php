<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagescontroller extends CI_Controller  
{



	public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('security');
                $this->load->model('Pagesmodel');
                $this->load->library('form_validation');

        }


        public function index()
        {
        	

        	$data['pagesdata']=$this->Pagesmodel->index();

        	$data['content']='table';
		   $this->load->view('admin/test',$data);


        }


        public function add()
        {
        	$data['content']='addpage';
		   $this->load->view('admin/test',$data);
        }


function file_selected_test()
        {

    if ($_FILES['img']['name'] =='') {
    $this->form_validation->set_message('file_selected_test', 'Please select file.');

            return false;
        }else{
            return true;
        }
        }



        public function store()
        {


        $this->form_validation->set_rules('name', 'Name', 'required');

        $this->form_validation->set_rules('description', 'Description', 'required');

        
        $this->form_validation->set_rules('img', 'Img', 'callback_file_selected_test');

        

            if ($this->form_validation->run() == FALSE)
                {
                       
                        $data['content']='addpage';
           $this->load->view('admin/test',$data);


                        
                      
                }




                else 
                {
$config['upload_path']          = 'Uploads/images/staticpages/';
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

            $data['content']='addpage';
            $data['error']=$error;
           $this->load->view('admin/test',$data);
                        
            }
                else
                {

                        $data = array('upload_data' => $this->upload->data());
                       
                        $name=$this->input->post('name');
                        
                        $description=$this->input->post('description');
                        $img=$config['upload_path'].$data['upload_data']['file_name'];
                        $data=array(
                            "name"=>$name,
                            "description"=>$description,
                            "image"=>$img
                        );

                        $this->db->insert('staticpages',$data);
                         
                    
                        redirect(base_url('Pagescontroller/'));
                }
                }
        	

        }


        public function selectedid($id)
        {
            $query = $this->db->get_where('staticpages', array('id' => $id),1,0);
            $data['pagesdata']=$query->row();

            $data['content']='editpage';
           $this->load->view('admin/test',$data);

        }


        public function update($id)
        {
            if($_FILES['img']['name'] =='')
            {
            $name=$this->input->post('name');
            $description=$this->input->post('description');
            

            $data=array(
                "name"=>$name,
                "description"=>$description,
               
            );

        $this->db->where('id', $id);
        $this->db->update('staticpages', $data);

        redirect(base_url('Pagescontroller/'));
    
    }

    else 
    {


        $query = $this->db->get_where('staticpages', array('id' => $id),1,0);

         $data['department']=$query->row();
         unlink($data['department']->image);


          $config['upload_path']          = 'Uploads/images/staticpages/';
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
                       
                        $name=$this->input->post('name');
                        $description=$this->input->post('description');
                        $img=$config['upload_path'].$data['upload_data']['file_name'];
                        $data=array(
                            "name"=>$name,
                            "description"=>$description,
                            "image"=>$img
                        );

                        $this->db->where('id', $id);
                        $this->db->update('staticpages', $data);
                        redirect(base_url('Pagescontroller/'));
                    

                }



    }
    
        }
}