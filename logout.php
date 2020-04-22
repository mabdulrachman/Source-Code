<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  include 'koneksi.php';
  $sess_admin = $_SESSION['pel_no'];
  if (isset($sess_admin)){
    session_destroy();
    echo '<script>alert("Anda Telah Logout !");
    window.location.href="input.php"</script>';
  }
 ?>
