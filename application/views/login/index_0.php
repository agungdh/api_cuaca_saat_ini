<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Login
	<br>
	<form action="<?php echo base_url("noapi/aksi"); ?>" method="post">
		Username
		<input type="text" name="username">
		<br>
		Password
		<input type="password" name="password">
		<br>
		<input type="submit" name="submit" value="Kirim">
	</form>
</body>
</html>