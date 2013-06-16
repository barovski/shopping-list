<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('App_model');
    }

//entertinment delete
    public function statusitems() {

        switch ((int) $_POST['status']) {
            case 0:
                $status = 'pending';
                break;
            case 1:
                $status = 'bought';
                break;
        }

        $this->App_model->set_status($status, $_POST['item_id']);
    }

    public function delete_item() {
        if ($this->App_model->delete_item($this->input->post('id'))) {
            return true;
        }
    }

    public function users() {

        $all_users = $this->App_model->get_users();
        foreach ($all_users as $user)
        {
        $users[] = array('key' => $user['id'], 'value' => $user['user_name']);
        
    }
    echo json_encode($users);

        }


}
?>
