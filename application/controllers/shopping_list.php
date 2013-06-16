<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shopping_list extends CI_Controller 
{
    protected $session_data;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	$this->load->library('form_validation');
	$this->load->model('App_model');
         if($this->App_model->is_loged()!=true)
        {
            redirect(base_url('login'));
        }
    }

    
     public function index()
    {
         //get shopping list
    }
    
    
    public function add()
    {
        if($this->input->post('submit'))
        {
         $this->form_validation->set_rules('list_name', 'Shopping list name', 'trim|required|min_length[3]|xss_clean');
	 $this->form_validation->set_error_delimiters('<em style=" color:red;">','</em>');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/shopping_list_add');
           
        } else {
            
            
            
             $this->App_model->save_list(array('list_name'=>$this->input->post('list_name'),'list_owner'=> $this->session->userdata('id')));
            
            
            
            
            
	  redirect(base_url().'home');
                
            
            
           
        }
    }
    
    else
    {
       $this->load->view('site/shopping_list_add'); 
    }
    
    }
    
    
    
    public function details()
    {
      $data['shopping_list']=  $this->App_model->get_list_byowner($this->uri->segment(3),  $this->session->userdata('id'));
      $data['shared_with'] = $this->App_model->get_shared_list($this->uri->segment(3));
      
      
      $this->load->view('site/shopping_list_details',$data); 
       
    }
    
    
     public function add_item()
    {
          $data['shopping_list']=  $this->App_model->get_list_byowner($this->uri->segment(3),  $this->session->userdata('id'));
      
         if($this->input->post('submit'))
        {
         $this->form_validation->set_rules('item_name', 'Item name', 'trim|required|min_length[3]|xss_clean');
         $this->form_validation->set_rules('item_description', 'Item description', 'trim|required|min_length[3]|xss_clean');
         
	 $this->form_validation->set_error_delimiters('<em style=" color:red;">','</em>');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/shopping_list_details',$data);
           
        } else {
            
            
            
             $this->App_model->save_item(array('fk_id'=>$this->input->post('list_id'),'item_name'=>$this->input->post('item_name'),'item_description'=>$this->input->post('item_description')));
            
            
            
            
            
	  redirect(base_url().'shopping_list/details/'.$this->uri->segment(3));
                
            
            
           
        }
    }
    
    else
    {
      $this->load->view('site/shopping_list_details',$data);
    }
    
       
       
    }
    
    
    
    public function share_list()
    {
        
        $this->App_model->share_list($this->input->post('select3'),  $this->input->post('list_id'));
         redirect(base_url().'shopping_list/details/'.$this->input->post('list_id'));

    }
    
    
    
    public function view_list()
          {  
        
        $data['shopping_list'] = $this->App_model->get_list($this->uri->segment(3));
        
        $this->load->view('site/shopping_list_view',$data);
        
        {
            
    }
        
    }
            
    
    
    
    
}

?>
