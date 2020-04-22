	<?php
	include 'koneksi.php';

	$no_pelanggan = $_GET['no_pelanggan'];

	?>

	<?php

			include 'koneksi.php';

			$data = mysqli_query ($koneksi, "select * from ifelse where no_pelanggan = '$no_pelanggan'");

			$cek = mysqli_num_rows($data);

			if ( $cek == 1 ) {

				while ($d = mysqli_fetch_array($data)){
	        			echo "|- ";
	                    echo $d ['no_pelanggan'];
	                    echo " -|- ";
	                    echo $d ['nama'];
	                    echo " -|- ";
	                    echo $d ['alamat'];
	                    echo " -|";}

			}

			else {

				echo "Maaf, nomor pelanggan tidak di temukan :(";

			}


	?>

	<!-- Akhir Function -->


	<!-- ================================================== -->


	<!-- OUTPUT -->

	<!-- OUTPUT -->
