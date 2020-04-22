<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- STYLING -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/sweetalert2.min.css">
    <link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- javascript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/sweetalert2.min.js"></script>
    <script src="../sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Info Pelanggan</title>
  </head>
  <body>
    <div class="header">
      <a href="../logout.php"><button style="--caicon: 'kembali';" class="cai">
        <div class="left"></div>
        <font face="Source Code Pro"> Kembali </font>
        <div class="right"></div>
      </button></a>
      <img src="../pict/logo.png" width="150px;">
      <div class="print">
        <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');"><img src="../pict/print.png" width="50px" data-toggle="tooltip" data-placement="left" title="Download/Print Laporan"></a>
        <script type="text/javascript" src="tooltip.js"></script>
      </div>
    </div>
    <div class="main" align="center">

      <?php
      include '../koneksi.php';
      $pel_no = $_GET['pel_no'];
      $no = 1;
      $data = mysqli_query(
        $koneksi,
        "SELECT * FROM `test_info_pelanggan` WHERE `pel_no` = '$pel_no';"
      );
      while ($d = mysqli_fetch_array($data)) {
        ?>
        <table border="1" class="table1">
          <tr>
            <th>No. Pelanggan</th>
            <td><?php echo $d ['pel_no']; ?></td>
            <th>Status Pelanggan</th>
            <td><?php echo $d ['kps_ket']; ?></td>
          </tr>
          <tr>
            <th>Nama</th>
            <td><?php echo $d ['pel_nama']; ?></td>
            <th>Golongan</th>
            <td><?php echo $d ['gol_kode']; ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td><?php echo $d ['pel_alamat']; ?></td>
            <th>Rayon Pembacaan</th>
            <td><?php echo $d ['dkd_kd']; ?></td>
          </tr>
        </table>
        <?php
      }

      include '../koneksi.php';
      $jumlahdataperhalaman = 10;
      $jumlahdata = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `test_history_cicilan_pkpt` WHERE `pel_no` = '$pel_no'"));
      $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
      $halamanaktif = (isset($_GET["halaman"]))?$_GET["halaman"] : 1;
      $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
      $no = $awaldata + 1;
      $check = mysqli_query(
        $koneksi,
        "SELECT * FROM `test_history_cicilan_pkpt` WHERE `pel_no` = '$pel_no' LIMIT $awaldata, $jumlahdataperhalaman;");
        if (mysqli_num_rows($check) >= 1) { ?><br>
          <h3 class="deepshadow">Cicilan PKPT</h3>
          <table border="1" class="table3">
            <tr>
              <th><center>No</center></th>
              <th><center>Tahun</center></th>
              <th><center>Bulan</center></th>
              <th><center>Jumlah</center></th>
              <th><center>Keterangan</center></th>
            </tr>
            <?php
              while ($d = mysqli_fetch_array($check)) { ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $d['prek_thn']; ?></td>
              <td><?php echo $d['prek_bln']; ?></td>
              <td><?php echo number_format($d['prek_jml'], 0, ".", "."); ?></td>
              <td><?php echo $d['Keterangan']; ?></td>
            </tr>
          <?php } ?>
          <tr>
            <th colspan="7" class="navigasi">
              <?php for ($i=1; $i<=$jumlahhalaman ; $i++){ ?>
                <a href="?pel_no=<?= $pel_no ?>&halaman=<?php echo $i; ?>"><img src="../pict/np.png" width="30"><b><?php echo $i; ?>&nbsp;&nbsp;</b></a>
              <?php } ?>
            </th>
          </tr>
          <?php
        } else {
          ?><br><br><br> <img src="../pict/PKPT.png" width="350" style="margin-top:-40px;"> <?php
        }
        ?>
      </table>
        </div>
    <div class="footer">
      <a href="tagihan.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate">Tagihan</a>
      <a href="history.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:200px;">History</a>
      <a href="cicilanPSB.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:400px;">Cicilan PSB</a>
      <a href="cicilanPKPT.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:600px;">Cicilan PKPT</a>
    </div>
    </body>
    </html>
