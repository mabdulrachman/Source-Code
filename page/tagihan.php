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
        "SELECT * FROM `test_info_pelanggan` WHERE `pel_no` = '$pel_no';"
      );
      $data2 = mysqli_query(
        $koneksi,
        "SELECT *
        FROM `test_v_tm_rekening` WHERE `pel_no` = '$pel_no' AND `rek_byr_sts` = '0';"
      );
      while ($d = mysqli_fetch_array($data)) {
        ?>
        <table border="1" class="table1">
          <tr>
            <th>&nbsp;No. Pelanggan</th>
            <td colspan="3"><?php echo $d ['pel_no']; ?></td>
          </tr>
          <tr>
            <th>&nbsp;Nama</th>
            <td><?php echo $d ['pel_nama']; ?></td>
            <th>&nbsp;Golongan</th>
            <td><?php echo $d ['gol_kode']; ?></td>
          </tr>
          <tr>
            <th>&nbsp;Alamat</th>
            <td><?php echo $d ['pel_alamat']; ?></td>
            <th>&nbsp;Rayon Pembacaan</th>
            <td><?php echo $d ['dkd_kd']; ?></td>
          </tr>
          <tr>
            <th>&nbsp;Status Pelanggan</th>
            <td><?php echo $d ['kps_ket']; ?></td>
            <th>&nbsp;Jumlah Rekening</th>
            <td><?php echo mysqli_num_rows($data2); ?></td>
          </tr>
        </table>
        <?php
      }

        include '../koneksi.php';
        $jumlahdataperhalaman = 10;
        $jumlahdata = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM `test_v_tm_rekening` WHERE `pel_no` = '$pel_no' AND `rek_byr_sts` = '0' AND `rek_sts` = '1'"));
        $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
        $halamanaktif = (isset($_GET["halaman"]))?$_GET["halaman"] : 1;
        $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
        $no = $awaldata + 1;
        $z = 0;
        $check = mysqli_query(
          $koneksi,
          "SELECT *,
          rek_adm + rek_meter AS Beban_Tetap,
          rek_stankini - rek_stanlalu AS pakai,
          rek_adm + rek_meter + rek_angsuran + rek_uangair AS Total
          FROM `test_v_tm_rekening` WHERE `pel_no` = '$pel_no' AND `rek_byr_sts` = '0' AND `rek_sts` = '1' LIMIT $awaldata, $jumlahdataperhalaman;");
        if (mysqli_num_rows($check) >= 1) {?>
          <br>
          <h3 class="deepshadow">Tagihan Rekening</h3>
          <table border="1" class="table2">
          <tr>
            <th rowspan="2"><center>No</center></th>
            <th rowspan="2"><center>Bulan Tahun</center></th>
            <th colspan="3"><center>Stand Meter</center></th>
            <th colspan="3"><center>Rincian Biaya</center></th>
            <th rowspan="2"><center>Total</center></th>
          </tr>
          <tr>
            <th><center>Lalu</center></th>
            <th><center>Kini</center></th>
            <th><center>Pemakaian</center></th>
            <th><center>Uang Air</center></th>
            <th><center>Beban Tetap</center></th>
            <th><center>Angsuran</center></th>
          </tr>
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

          ?><?php

        while ($d = mysqli_fetch_array($check)) {
          $z++;
          $jumlah[$z] = $d['Total'];
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
            <td style="text-align: right;"><?php echo number_format($d['Total'], 0, ".", "."); ?></td>
          </tr>
          <?php $Jumlah = array($d['Total']);
         } ?>

          <tr style="text-align:right; font-size: 16px;">
            <th colspan="7" class="navigasi">
              <?php for ($i=1; $i<=$jumlahhalaman ; $i++){ ?>
                <a href="?pel_no=<?= $pel_no ?>&halaman=<?php echo $i; ?>"><img src="../pict/np.png" width="30"><b><?php echo $i; ?>&nbsp;&nbsp;</b></a>
              <?php } ?>
            </th>
            <th>Grand Total</th>
            <th><?php echo "Rp. ".number_format(array_sum($jumlah), 0, ".", "."); ?></th>
          </tr>
      </table>
        <?php } else { ?>
        <br><br><br>  <img src="../pict/cai.jpg" width="450" border="20" style="margin-top:-20px;"> <?php
        } ?>
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
