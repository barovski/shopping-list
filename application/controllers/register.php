<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{
    protected $session_data;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('App_model');
    }

    
    public function index() {

		if($this->App_model->is_loged()==true)
		{
			redirect(base_url().('home'));
		}
               

                $this->form_validation->set_rules('name', 'User name', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]|xss_clean|sha1');
		$this->form_validation->set_error_delimiters('<em style=" color:red;padding-left:0px;">','</em>');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/register');
           
        } else {
            
            if($this->App_model->check_name($this->input->post('name')))
            {
            
             $this->App_model->register(array('user_name'=>$this->input->post('name'),'password'=> $this->input->post('password')));
             $user = $this->App_model->user_login($this->input->post('name'), $this->input->post('password'));
            
            
            
            
            if ($user != false) {
              $this->session_data = array('logged' => 'true', 'user_name' => $user['user_name'], 'id' => $user['id']);
                
                $this->session->set_userdata($this->session_data);
				redirect(base_url().'home');
                
            }
            }
            else
            {	
            	$data['error_register'] = 'Name is already taken';
               $this->load->view('site/register',$data);
            }
        }
    }
    
    
    
    
}

?>
