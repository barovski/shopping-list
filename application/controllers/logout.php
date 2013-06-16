<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller 
{
    protected $session_data;
    public function __construct() {
        parent::__construct();
        
		
		
    }

    
     public function index()
    {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('email_user');
        redirect(base_url().'login','refresh');
    }
    
    
}

?>
