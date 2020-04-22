<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include "koneksi.php";
    $pel_no = $_GET['pel_no'];
    $jumlahdataperhalaman = 1;
    $jumlahdata = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `test_history_cicilan_bp` WHERE `pel_no` = '$pel_no'"));
    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    $halamanaktif = (isset($_GET["halaman"]))?$_GET["halaman"] : 1;
    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
    $no = 1;
    $check = mysqli_query($koneksi,"SELECT * FROM `test_history_cicilan_bp` WHERE `pel_no` = '$pel_no' LIMIT $awaldata, $jumlahdataperhalaman ");
    if (mysqli_num_rows($check) >= 1) { ?>
      <br>
      <h3 class="deepshadow">Cicilan PSB</h3>
      <?php for ($i=1; $i<=$jumlahhalaman ; $i++){ ?>
        <a href="?pel_no=<?= $pel_no ?>&halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
      <?php } ?>
      <table border="1" class="table2">
      <tr>
      <th><center>No</center></th>
      <th><center>Nomor Register</center></th>
      <th><center>Tahun Cicilan</center></th>
      <th><center>Bulan Cicilan</center></th>
      <th><center>Cicilan Ke</center></th>
      <th><center>Jumlah Cicilan</center></th>
      <th><center>Keterangan Nama</center></th>
      </tr>
      <?php
      while ($d = mysqli_fetch_assoc($check)) { ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $d['pem_reg']; ?></td>
          <td><?php echo $d['cic_thn']; ?></td>
          <td><?php echo $d['cic_bulan']; ?></td>
          <td><?php echo $d['cic_ke']; ?></td>
          <td><?php echo number_format($d['cic_jml'], 0, ".", "."); ?></td>
          <td><?php echo $d['gr_nama']; ?></td>
        </tr>

    <?php }} else {
      ?><br><br><br> <img src="../pict/PSB.png" width="350" style="margin-top:-40px;"> <?php
    } ?>
</table>
  </body>
</html>
