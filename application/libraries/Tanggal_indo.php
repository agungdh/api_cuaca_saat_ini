<?php 
 
class Tanggal_indo{
 
	function datetime($p_tanggal){		
		$bulan = date( "m", strtotime( $p_tanggal ) );

		switch ($bulan) {
			case '1':
				$bulan = "Januari";
				break;
			
			case '2':
				$bulan = "Februari";
				break;
			
			case '3':
				$bulan = "Maret";
				break;
			
			case '4':
				$bulan = "April";
				break;
			
			case '5':
				$bulan = "Mei";
				break;
			
			case '6':
				$bulan = "Juni";
				break;
			
			case '7':
				$bulan = "Juli";
				break;
			
			case '8':
				$bulan = "Agustus";
				break;
			
			case '9':
				$bulan = "September";
				break;
			
			case '10':
				$bulan = "Oktober";
				break;
			
			case '11':
				$bulan = "November";
				break;
			
			case '12':
				$bulan = "Desember";
				break;
			
			default:
				return;
				break;
		}

		$tanggal = date( "d", strtotime( $p_tanggal ) );
		$sisa = date( "Y H:i:s", strtotime( $p_tanggal ) );
		$hasil = $tanggal . ' ' . $bulan . ' ' . $sisa;

		return $hasil;
	}
 
}