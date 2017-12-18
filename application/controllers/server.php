<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Welcome extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('m_welcome');
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == null) {
            $mahasiswa = $this->m_welcome->get();
        } else {
            $mahasiswa = $this->m_welcome->get_id($id);
        }
        $this->response($mahasiswa, 200);
    }

    function index_post() {
        $npm = $this->post('npm');
        $nama = $this->post('nama');

        $data = array(
                    'npm' => $npm,
                    'nama' => $nama);

        $insert = $this->m_welcome->post($npm, $nama);
        if ($insert['query']) {
            $data['id'] = $insert['id'];
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $npm = $this->put('npm');
        $nama = $this->put('nama');

        $data = array(
                    'id' => $id,
                    'npm' => $npm,
                    'nama' => $nama);

        $update = $this->m_welcome->put($id, $npm, $nama);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');

        $delete = $this->m_welcome->delete($id);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>