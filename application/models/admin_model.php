<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function user_login($email, $password) {
        $sql_string = " SELECT * FROM `admin` WHERE `email` = ? AND `password` = ? LIMIT 1 ";
        $query = $this->db->query($sql_string, array($email, $password));
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row;
        } else {
            return false;
        }
    }

    public function is_loged() {
        if ($this->session->userdata('loged') == true) {
            if ($this->session->userdata('email_admin') != false) {
                return true;
            }
        }
        return false;
    }

    /*     * ******** change password ****** */

    public function change_data($data) {

        $this->db->where('id', 1);
        $this->db->update('admin', $data);
    }
    
    /*     * ****USERS ***** */

    //dashboard get all count results of pics
    public function count_users() {
        $all_records = $this->db->count_all('users');
        return $all_records;
    }

    
    public function get_all_users($per_page, $offset) {


        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups','users.id=users_groups.user_id','inner');
        $this->db->join('groups','users_groups.group_id=groups.id','inner');
        
        //$this->db->limit(1);
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        //echo ($this->db->last_query());
        $results = $query->result_array();
//        echo '<pre>';
//        
//die(print_r($results));
        return $results;
    }
    
    
    
    
      /*     * ****USERS GROUPS ***** */
    
    
    public function get_groups() {


        $this->db->select('*');
        $this->db->from('groups');
        $query = $this->db->get();
        $results = $query->result_array();

        return $results;
    }
    
    
    public function save_user($data,$user_group)
    {
       $this->db->where('email',$data['email']);
       $res=$this->db->count_all_results('users');
       if($res==0)
       {
           $this->db->insert('users',$data);
           $user_id= $this->db->insert_id();
           
           
           $this->db->insert('users_groups',array('user_id'=>$user_id,'group_id'=>$user_group));
           
           return true;
           
           
       }
       else
           return false;
       
    }

public function get_user_byid($id)
{
    
    $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups','users.id=users_groups.user_id','inner');
        $this->db->join('groups','users_groups.group_id=groups.id','inner');
        $this->db->where('users.id',$id);
        
        
        $query = $this->db->get();
        
        $results = $query->row_array();
       
        return $results;
}

public function update_user_byid($data,$users_group,$user_id)
{
     $this->db->where('id', $user_id);
     $this->db->update('users', $data);
     
     $this->db->where('user_id', $user_id);
     $this->db->update('users_groups', array('group_id'=>(int)$users_group));
     return TRUE;
     
}


public function update_user_pass_byid($data,$user_id)
{
    $this->db->where('id', $user_id);
    $this->db->update('users', $data);
}



public function delete_user($id)
{
    $this->db->where('id', $id);
    $this->db->delete('users');
    
    $this->db->where('user_id', $id);
    $this->db->delete('users_groups');
}






    /******** Categories *****/
      // get categories  
    public function get_categories() {


        $this->db->select('*');
        $this->db->from('categories');
        $query = $this->db->get();
        $results = $query->result_array();

        return $results;
    }
    
    public function add_category($data) {

        $this->db->insert('categories', $data);
    }
    
    
    public function get_category_byid($id) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    
    
    
     public function update_category($data, $id) {
        $this->db->where('cat_id', $id);
        $this->db->update('categories', $data);
    }
    
    
    
    
    
    
    /* USERS GROUPS */

    
     public function add_group($data)
    {
        $this->db->insert('groups',$data);
    }
    
    public function update_group($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('groups', $data);
    }
    
    public function get_group_byid($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }



    
    /*( FILES */
    
    public function count_all_files()
    {
       $all_records = $this->db->count_all('files');
        return $all_records; 
    }
    
    
    public function save_file($data)
    {
       if($this->db->insert('files',$data))
       {
           return TRUE;
       }
       
    }
    
    




 function get_cats_files($cat_id)
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('fk_id',$cat_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

public function delete_file($id)
{
    $this->db->where('id', $id);
    $this->db->delete('files');
}




    
    
    
    
    

    /////////// settings/////////

    public function get_settings() {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', 1);
        $query = $this->db->get();
        $results = $query->row_array();
        return $results;
    }

    

   

   

}

?>
