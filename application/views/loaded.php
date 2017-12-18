<?php
$date = new DateTime();
$date->setTimestamp($detail_cuaca->time);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>CUACA SAAT INI</h3>	
	<p>Lokasi = <?php echo $detail_lokasi['alamat']; ?></p>
	<p>Waktu = <?php echo $date->format('d-m-Y H:i:s'); ?></p>
	<p>Cuaca = <?php echo $detail_cuaca->summary; ?></p>
	<p>Suhu = <?php echo number_format((($detail_cuaca->temperature - 32) / 1.8), 2, '.', ''); ?> &#8451;</p>
	<p>Kelembaban = <?php echo round($detail_cuaca->humidity * 100 ); ?> %</p>
	<p>Kecepatan Angin = <?php echo number_format($detail_cuaca->windSpeed * 1.609, 2, '.', ''); ?> km/h</p>

	<br>
	<form method="post" action="<?php echo base_url(); ?>">
		Lokasi
		<input type="text" name="lokasi" value="<?php echo $lokasi; ?>">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>