<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloadcontroller extends CI_Controller  
{



	public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('security');
                $this->load->model('Downloadmodel');

        }


        public function index()
        {
        	

        	$data['downloaddata']=$this->Downloadmodel->index();

        	$data['content']='downloadtable';
		   $this->load->view('admin/test',$data);


        }


        public function add()
        {
             $data['content']='adddownloadfile';
                   $this->load->view('admin/test',$data);   
        }



function file_selected_test()
        {

    if ($_FILES['file']['name'] =='') {
    $this->form_validation->set_message('file_selected_test', 'Please select file.');

            return false;
        }else{
            return true;
        }
        }



        public function store()
        {
                $name=$this->input->post('name');
                $type=$this->input->post('type');
               
                $this->form_validation->set_rules('name', 'Name', 'required');

        $this->form_validation->set_rules('type', 'type', 'required');

        
        $this->form_validation->set_rules('file', 'file', 'callback_file_selected_test');

            if ($this->form_validation->run() == FALSE)
                {
                       
                        $data['content']='adddownloadfile';

           $this->load->view('admin/test',$data);


                          
                }


                else 
                {
                   if(! empty($name) && !$_FILES['file']['name'] =='')
                {
         $config['upload_path']          = 'Uploads/downloads/';
        $config['allowed_types']        = 'pdf|docx|docm|dotx|dotm|docb';
        $config['max_size']             = 99999;
        $config['max_width']            = 99999;
        $config['max_height']           = 99999;
        $config['encrypt_name'] = TRUE;         
                
                $new_name = time().$_FILES["file"]['name'];
                $config['file_name']=$new_name;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file'))
                    {
                                
                     $error = array('error' => $this->upload->display_errors());

                       $data['content']='adddownloadfile';
            $data['error']=$error;
           $this->load->view('admin/test',$data);

                    }

                    else
                    {
                        $data = array('upload_data' => $this->upload->data());

                        $file=$config['upload_path'].$data['upload_data']['file_name'];

                        $data=array(
                                "name"=>$name,
                                "download_file"=>$file,
                                "type"=>$type
                        );

                       $this->db->insert('downloads',$data);
                       redirect(base_url('Downloadcontroller/'));
                    }



                }

                else
                {
                        redirect(base_url('Downloadcontroller/add'));
                } 
                }
        }


        public function deleteitem($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('downloads');
                redirect(base_url('Downloadcontroller/'));
        }


        public  function selectedid($id)
        {
                $query = $this->db->get_where('downloads', array('id' => $id),1,0);
            $data['downloaddata']=$query->row();

            $data['content']='editdownload';
           $this->load->view('admin/test',$data);
        }


        public function update($id)
        {
        
        $name=$this->input->post('name');

            $type=$this->input->post('type');

        if($_FILES['file']['name'] =='')
            {
            
            

            $data=array(
                "name"=>$name,
                "type"=>$type,
               
            );

        $this->db->where('id', $id);
        $this->db->update('downloads', $data);

        redirect(base_url('Downloadcontroller/'));
    
    }

    else 
    {


        $query = $this->db->get_where('downloads', array('id' => $id),1,0);

         $data['department']=$query->row();
         unlink($data['department']->download_file);


          $config['upload_path']          = 'Uploads/downloads/';
        $config['allowed_types']        = 'pdf|docx|docm|dotx|dotm|docb';
        $config['max_size']             = 99999;
        $config['max_width']            = 99999;
        $config['max_height']           = 99999;
        $config['encrypt_name'] = TRUE;     
        
        $new_name = time().$_FILES["file"]['name'];
        $config['file_name']=$new_name;
        
        $this->load->library('upload', $config);

         if ( ! $this->upload->do_upload('file'))
            {
                        
                        $error = array('error' => $this->upload->display_errors());

                        return print_r($error);
            }
                else
                {

                        $data = array('upload_data' => $this->upload->data());

                        $file=$config['upload_path'].$data['upload_data']['file_name'];

                        $data=array(
                                "name"=>$name,
                                "download_file"=>$file,
                                "type"=>$type
                        );

                        $this->db->where('id', $id);
                        $this->db->update('downloads', $data);
                        redirect(base_url('Downloadcontroller/'));
                        print_r($data);
                    

                }



    }
        }

}