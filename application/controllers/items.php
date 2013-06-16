<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller 
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
        
    }
    
    public function edit()
    {
        
        $data['item']= $this->App_model->get_item($this->uri->segment(3)); ;
         if($this->input->post('submit'))
        {
         $this->form_validation->set_rules('item_name', 'Item name', 'trim|required|min_length[3]|xss_clean');
	 $this->form_validation->set_rules('item_description', 'Item name', 'trim|required|min_length[3]|xss_clean');
	 
         $this->form_validation->set_error_delimiters('<em style=" color:red;">','</em>');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/item_edit',$data);
           
        } else {
            
            $item['item_name'] = $this->input->post('item_name');
            $item['item_description'] = $this->input->post('item_description');
            
             $this->App_model->update_item($this->input->post('itm_id'),$item);
            
            
            
            
	  redirect(base_url().'shopping_list/details/'.$this->input->post('list_id'));
                
            
            
           
        }
    }
    else
    {
       $this->load->view('site/item_edit',$data); 
    }
    
    
        }
    
    
    
        }
?>
