
<?php

	$user = 'azhar';
	$host = 'localhost';
	$db = 'fiturifelse';
	$pass = '';

	$koneksi= mysqli_connect($host, $user, $pass, $db);

	if (mysqli_connect_errno()) {
		echo "Koneksi database Gagal : ". mysqli_connect_error();
	}


?>