<?php

use FFI\ParserException;

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model("user_model");
    }


    public function index()
    {
        $data["users"] = $this->user_model->getDataByJoin();
        $this->load->view("admin/user/list", $data);   
    }

}

/* End of file Controllername.php */
