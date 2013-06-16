<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	
	 
    
    
   
    public function __construct() {
        parent::__construct();
    $this->load->model('App_model');
        
        if($this->App_model->is_loged()!=true)
		{
			redirect(base_url('login'));
		}
    
      
    }

    
    public function index()
    {
        
        
     $data = array();
     
     $data['my_list'] = $this->App_model->get_my_list($this->session->userdata('id'));
     
     $data['shared_list'] = $this->App_model->get_shared_withme($this->session->userdata('id'));
     

        
        
        $this->load->view('site/home',$data);
    }

   
   
    
}
?>