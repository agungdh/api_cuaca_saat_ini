<?php
class M_welcome extends CI_Model{	
	function __construct(){
		parent::__construct();		
	}

	function get() {
		$sql = "SELECT *
				FROM mahasiswa";
		$query = $this->db->query($sql, array());
		$row = $query->result();

		return $row;
	}

	function get_id($id) {
		$sql = "SELECT *
				FROM mahasiswa
				WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		$row = $query->row();

		return $row;
	}

	function post($npm, $nama) {
		$sql = "INSERT INTO mahasiswa
				SET npm = ?,
				nama = ?";
		$query = $this->db->query($sql, array($npm, $nama));

		$hasil['query'] = $query;
		$hasil['id'] = $this->db->insert_id();

		return $hasil;
	}

	function put($id, $npm, $nama) {
		$sql = "UPDATE mahasiswa
				SET npm = ?,
				nama = ?
				where id = ?";
		$query = $this->db->query($sql, array($npm, $nama, $id));

		return $query;
	}

	function delete($id) {
		$sql = "DELETE FROM mahasiswa
				WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return $query;
	}

}
?>