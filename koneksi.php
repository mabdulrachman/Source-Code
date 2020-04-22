<?php
  $host = '127.0.0.1';
  $user = 'root';
  $pass = '';
  $db = 'pdam';

  $koneksi = mysqli_connect($host,$user,$pass,$db);

  if (mysqli_connect_errno()) {
    echo "Koneksi database gagal = ".mysqli_connect_error();
  }
?>
