<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- STYLING -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/sweetalert2.min.css">
    <link rel="stylesheet" href="../@sweetalert2/theme-borderless/borderless.css">
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
      </button>
      <img src="../pict/logo.png" width="150px;">
      <div class="print">
        <a href="javascript:printDiv('id-elemen-yang-ingin-di-print');"><img src="../pict/print.png" width="50px" data-toggle="tooltip" data-placement="left" title="Download/Print Laporan"></a>
        <script type="text/javascript" src="tooltip.js"></script>
      </div>
    </div>
    <div class="main" align="center">

      <textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
      <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
      <script type="text/javascript">
      function printDiv(elementId) {
       var a = document.getElementById('printing-css').value;
       var b = document.getElementById(elementId).innerHTML;
       window.frames["print_frame"].document.title = document.title;
       window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
       window.frames["print_frame"].window.focus();
       window.frames["print_frame"].window.print();
      }
      </script>

      <div id="id-elemen-yang-ingin-di-print">

      <?php
      include '../koneksi.php';
      $pel_no = $_GET['pel_no'];
      $no = 1;
      $data = mysqli_query(
        $koneksi,
        "SELECT * FROM `test_info_pelanggan` WHERE `pel_no` = '$pel_no'"
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
      ?>
      <?php

        function bulan($tanggal){

          $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              );
          $split = explode('-', $tanggal);
          return $bulan[ (int)$split[0] ];
        }

        ?>

        <?php
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query(
          $koneksi,
          "SELECT *,
          rek_adm + rek_meter AS Beban_Tetap,
          rek_adm + rek_meter + rek_angsuran + rek_uangair + rek_denda + rek_materai AS Total
          FROM `history_drd` WHERE `pel_no` = '$pel_no' AND rek_sts='1' AND `rek_byr_sts` NOT LIKE '0' AND '3' order by rek_nomor DESC LIMIT 0,3;"
        );
        if (mysqli_num_rows($data) >= 1) { ?>

          <br>
          <h3 class="deepshadow">History</h3>
          <table border="1" class="table2">
            <tr>
              <th rowspan="2"><center>No</center></th>
              <th rowspan="2"><center>Bulan Tahun</center></th>
              <th colspan="3"><center>Stand Meter</center></th>
              <th colspan="5"><center>Rincian Biaya</center></th>
              <th rowspan="2"><center>Total</center></th>
              <th rowspan="2"><center>Loket Bayar</center></th>
              <th rowspan="2"><center>Tanggal Bayar</center></th>
            </tr>
            <tr>
              <th>Lalu</th>
              <th>Kini</th>
              <th>Pemakaian</th>
              <th>Uang Air</th>
              <th>Beban Tetap</th>
              <th>Angsuran</th>
              <th>Denda</th>
              <th>Materai</th>
            </tr>

        <?php
        while ($d = mysqli_fetch_array($data)) {
          ?>

          <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo bulan($d ['rek_bln']); ?> <?php echo $d ['rek_thn']; ?></td>
            <td><?php echo $d['rek_stanlalu']; ?></td>
            <td><?php echo $d['rek_stankini']; ?></td>
            <td><?php echo $d['pakai']; ?></td>
            <td><?php echo number_format($d['rek_uangair'], 0, ".", "."); ?></td>
            <td><?php echo number_format($d['Beban_Tetap'], 0, ".", "."); ?></td>
            <td><?php echo number_format($d['rek_angsuran'], 0, ".", "."); ?></td>
            <td><?php echo number_format($d['rek_denda'], 0, ".", "."); ?></td>
            <td><?php echo number_format($d['rek_materai'], 0, ".", "."); ?></td>
            <td><?php echo number_format($d['Total'], 0, ".", "."); ?></td>
            <td><?php echo $d['ket_loket']; ?></td>
            <td><?php echo date('d-m-Y', strtotime($d['byr_upd_sts'])); ?></td>
          </tr>
          <?php
        }
        ?></table><?php
      }else {
          ?><br><br><br> <img src="../pict/HISTORY.png" width="350" style="margin-top:-40px;"> <?php
        }
        ?>
    </div>
    </div>
    </div>
    <div class="footer">
      <a href="tagihan.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate">Tagihan</a>
      <a href="history.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:200px;">History</a>
      <a href="cicilanPSB.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:400px;">Cicilan PSB</a>
      <a href="cicilanPKPT.php?pel_no=<?php echo $pel_no; ?>" class="button2 button2-white button2-animate" style="margin-left:600px;">Cicilan PKPT</a>
    </div>
    </body>
    </html>
