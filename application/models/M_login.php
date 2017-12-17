<?php
class M_login extends CI_Model{	
	function __construct(){
		parent::__construct();		
	}

	function post($username, $password) {
		$sql = "SELECT *
				FROM user
				WHERE username = ?
				AND password = ?";
		$query = $this->db->query($sql, array($username, $password))->row();

		return $query;
	}
}
?>