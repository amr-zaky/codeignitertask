<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stingcontroller extends CI_Controller  
{



	public function __construct()
        {
                parent::__construct();
                $this->load->helper('security');
                $this->load->model('Stingmodel');
                

        }

       public function index()
       {
       	  $query = $this->db->get_where('stings', array('id' => 1),1,0);
            $data['stingdata']=$query->row();
            $data['content']='editsting';
           $this->load->view('admin/test',$data);
       }

     


       public function update()
       {	


   
       	$footer_description=$this->input->post('footer_description');
       	$address=$this->input->post('address');
       	$phone=$this->input->post('phone');
       	$email=$this->input->post('email');
       	$facebook=$this->input->post('facebook');
       	$twitter=$this->input->post('twitter');
       	$instagram=$this->input->post('instagram');
       	$googleplus=$this->input->post('googleplus');


       	$data=array(
       		'footer_description'=>$footer_description,
       		'address'=>$address,
       		'phone'=>$phone,
       		'email'=>$email,
       		'facebook'=>$facebook,
       		'twitter'=>$twitter,
       		'instagram'=>$instagram,
       		'googleplus'=>$googleplus
       	);

       	$this->db->where('id', 1);
                        $this->db->update('stings', $data);
                        redirect(base_url('Stingcontroller/'));
                      

       }



       public function editresume()
       {
       	 $query = $this->db->get_where('resume', array('id' => 1),1,0);
            $data['resumedata']=$query->row();
            $data['content']='editresume';
           $this->load->view('admin/test',$data);
            
       }


}
