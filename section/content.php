<div class="main" align="center">

  <?php
  include 'koneksi.php';
  $no = 1;
  $data = mysqli_query(
    $koneksi,
    "SELECT * FROM `test_info_pelanggan` WHERE `pel_no` LIKE '%230706%';"
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
  <br><br><br>

  <table border="1" class="table3">
    <tr>
      <th>No</th>
      <th><center>Prek Tahun</center></th>
      <th><center>Prek Bulan</center></th>
      <th><center>Prek Jumlah</center></th>
      <th><center>Keterangan</center></th>
    </tr>

    <?php
    include 'koneksi.php';
    $no = 1;
    $data = mysqli_query(
      $koneksi,
      "SELECT * FROM `test_history_cicilan_pkpt` WHERE `pel_no` LIKE '%230706%';"
    );
    while ($d = mysqli_fetch_array($data)) {
      ?>

    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $d['prek_thn']; ?></td>
      <td><?php echo $d['prek_bln']; ?></td>
      <td><?php echo $d['prek_jml']; ?></td>
      <td><?php echo $d['Keterangan']; ?></td>
    </tr>

      <?php
    }
    ?>
  </table>
    </div>
