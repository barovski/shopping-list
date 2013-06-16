<?php

class App_model extends CI_Model 
{

    
   
    public function user_login($username, $password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('user_name'=>$username,'password'=>$password));
        $this->db->limit(1);
        $query= $this->db->get();
        if ($query->num_rows() == 1) {
            
         $res = $query->row_array();   
            return $res;
        } else {
            return false;
        }
    }

    public function is_loged() {
        if ($this->session->userdata('logged') == true) {
            if ($this->session->userdata('user_name') != false) {
                return true;
            }
        }
        return false;
    }
    
    
    
     public function check_name($username) {
        $this->db->select('user_name');
        $this->db->from('users');
        $this->db->where(array('user_name'=>$username));
        $query= $this->db->get();
        
        
        if ($query->num_rows() == 1) {
                 return false;
        } else {
            return true;
        }   
     }   
       
      public function register($data)
    {
        $this->db->insert('users',$data);
        return true;
    }  
    
    
   
public function get_my_list($id)
{
        $this->db->select('*');
        $this->db->from('shopping_list');
        $this->db->where(array('list_owner'=>$id));
        
        $query= $this->db->get();
        if ($query->num_rows() >0) {
            
         $res = $query->result_array();   
            return $res;
        } else {
            return false;
        }  
}





public function save_list($data)
{
  $this->db->insert('shopping_list',$data);
        return true;  
}





public function get_list_byowner($id,$owner)
{
        $this->db->select('*');
        $this->db->from('shopping_list');
        $this->db->where(array('id'=>$id,'list_owner'=>$owner));
        
        $query= $this->db->get();
        
        
        if ($query->num_rows() ==1) {
         
        $this->db->select('*');
        $this->db->from('shopping_list');
        $this->db->join('shopping_items','shopping_list.id=shopping_items.fk_id');
        $this->db->where(array('shopping_list.id'=>$id));   
        $qu=$this->db->get();    
         $res = $qu->result_array();   
            return $res;
        } else {
            return false;
        }  
}


public function save_item($data)
{
  $this->db->insert('shopping_items',$data);
        return true;  
}


public function get_item($itm_id)
{
     $this->db->select('*');
     $this->db->from('shopping_items');
     $this->db->where(array('itm_id'=>$itm_id));
     $query= $this->db->get();
     $result = $query->row_array();
     return $result;   
     
}
 public function update_item($itm_id,$data) {

        $this->db->where('itm_id', $itm_id);
        $this->db->update('shopping_items', $data);
    }
    

 public function set_status($status,$item_id) {

        $this->db->where('itm_id', $item_id);
        $this->db->update('shopping_items', array('status'=>$status));
       
    }

public function delete_item($id)
{
    $this->db->where('itm_id', $id);
    $this->db->delete('shopping_items');
}



public function get_users()
{
   $this->db->select('*');
   $this->db->from('users');
   $this->db->where('id !='.$this->session->userdata('id'));
   $query=$this->db->get();
   $result = $query->result_array();
   return $result;
   
}


public function get_shared_list($id)
{
        $this->db->select('*');
        $this->db->from('shared_list');
        $this->db->join('users','shared_list.user_id=users.id');
        $this->db->where(array('shared_list.list_id'=>$id));   
        $qu=$this->db->get();    
        $res = $qu->result_array();   
        return $res;
    
}
public function get_shared_withme($id)
{
        $this->db->select('*');
        $this->db->from('shared_list');
        $this->db->join('shopping_list','shopping_list.id=shared_list.list_id');
        $this->db->where(array('shared_list.user_id'=>$id));   
        $qu=$this->db->get();    
        $res = $qu->result_array();   
        return $res;
    
}


public function share_list($users,$list_id)
{
    
   
    $this->db->where('list_id', $list_id);
    $this->db->delete('shared_list'); 
    $u=array_unique($users);
    if(is_array($u))
    {
    foreach ($u as $user)
    {
        $this->db->insert('shared_list',array('user_id'=>$user['id'],'list_id'=>$list_id));
    }
    }
}
    

public function get_list($id)
{
   $this->db->select('*');
   $this->db->from('shopping_list');
   $this->db->join('shopping_items','shopping_list.id=shopping_items.fk_id');
   $this->db->where(array('shopping_list.id'=>$id,'shopping_items.status'=>'bought'));   
   $qu=$this->db->get();    
   $res = $qu->result_array();   
   return $res;
}


    
}
?>
