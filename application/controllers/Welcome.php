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
        if ($this->input->post("submit")) {
            $detail_lokasi = $this->google_data($this->input->post('lokasi'));

            echo "alamat = " . $detail_lokasi['alamat'] . "<br>";
            // echo "lat = " . $detail_lokasi['lat'] . "<br>";
            // echo "lng = " . $detail_lokasi['lng'] . "<br>";

            $detail_cuaca = $this->darksky_data($detail_lokasi['lat'], $detail_lokasi['lng'], "id")->currently;
            
            $date = new DateTime();
            $date->setTimestamp($detail_cuaca->time);

            echo $date->format('d-m-Y H:i:s');
            echo "<br>";
            echo $detail_cuaca->summary;
            echo "<br>";
            var_dump($detail_cuaca);
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