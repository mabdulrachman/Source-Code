<?php
  // // CHECK LOGIN
  // include 'input_exe.php';

  // HEADER
  include 'section/header.php';

  // CONTENT
  if (isset($_GET['cicilanBP'])) {
    include 'cicilanBP.php';
  }else if (isset($_GET['cicilanPKPT'])) {
    include 'cicilanPkpt.php';
  }else if (isset($_GET['history'])) {
    include 'history.php';
  }else {
    include 'tagihan.php';
  }

  // FOOTER
  include 'section/footer.php';
 ?>
