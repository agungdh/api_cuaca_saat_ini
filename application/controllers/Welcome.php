<?php
Class Welcome extends CI_Controller{
    
    var $google_api_key = "";
    var $google_api_url = "";
    var $darksky_api_key = "";
    var $darksky_api_url = "";

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('curl');
        
        $this->google_api_url = "https://maps.googleapis.com/maps/api/geocode/json";
        $this->google_api_key = "AIzaSyBOtOwoMtFgcWfxMDeox8c9-YgH-sHkBT4";
        
        $this->darksky_api_url = "https://api.darksky.net/forecast/";
        $this->darksky_api_key = "6bfdd322a546de5a7e6d965dc6bec4a5/";
    }
    
    function index(){
        if ($this->input->post("submit") && $this->input->post("lokasi") != null) {
            $data['detail_lokasi'] = $this->google_data($this->input->post('lokasi'));
            $data['detail_cuaca'] = $this->darksky_data($data['detail_lokasi']['lat'], $data['detail_lokasi']['lng'], "id")->currently;
            $data['lokasi'] = $this->input->post('lokasi');
            $this->load->view('loaded', $data);            
        } else {
            $this->load->view('main');            
        }
    }

    private function google_data($lokasi) {
        $lokasi = "?address=" . urlencode($lokasi) ."&key=";
        $bahasa = "&language=id";
        $api_url = $this->google_api_url . $lokasi . $this->google_api_key . $bahasa;
        $data_api = json_decode($this->curl->simple_get($api_url));
        $data['alamat'] = $data_api->results[0]->formatted_address;
        $data['lat'] = $data_api->results[0]->geometry->location->lat;
        $data['lng'] = $data_api->results[0]->geometry->location->lng;

        return $data;
    }    

    private function darksky_data($lat, $lng, $lang) {
        $api_url = $this->darksky_api_url . $this->darksky_api_key . $lat . "," . $lng . "?lang=" . $lang;
        $data_api = json_decode($this->curl->simple_get($api_url));

        return $data_api;
    }
    

}