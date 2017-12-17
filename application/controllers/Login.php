<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('m_login');
    }

    function index_get() {
        if ($this->session->login == true) {
            $this->response($this->session->userdata, 200);
        }
    }

    function index_post() {
        $username = $this->post('username');
        $password = $this->post('password');

        $data = array(
                    'username' => $username,
                    'password' => $password);

        $insert = $this->m_login->post($username, $password);
        if ($insert != null) {            
            $array_data_user = array(
            'id'  => $insert->id,
            'username'  => $insert->username,
            'login'  => true
            );

            $this->session->set_userdata($array_data_user);
            $this->response(array($array_data_user), 200);
        }
    }

    function index_delete(){
        $this->session->sess_destroy();
        $this->response(array("status" => "success"), 200);
    }

}
?>