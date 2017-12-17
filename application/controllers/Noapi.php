<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Noapi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_noapi');
    }


    function index(){
        if ($this->session->login != true) {
            $this->load->view('login/index_0');
        } else {
            $this->load->view('login/index_1');
        }
    }

    function aksi(){
        $username = $this->input->post('username');
        $password = hash('sha512', $this->input->post('password'));

        $insert = $this->m_noapi->ambil_data($username, $password);
        if ($insert != null) {            
            $array_data_user = array(
            'id'  => $insert->id,
            'username'  => $insert->username,
            'login'  => true
            );

            $this->session->set_userdata($array_data_user);
        }
        redirect(base_url("noapi"));
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url("noapi"));
    }
    

}
?>