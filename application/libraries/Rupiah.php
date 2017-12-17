<?php 
 
class Rupiah{
 
	function convert_ke_rupiah($jumlah){		
		$hasil = "Rp" . number_format($jumlah,2,',','.');

		return $hasil;
	}
 
}