<?php 
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked_produksi'];
	if(!isset($chk)){
		?> 
			<script>window.location='produksi?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_produksi){
			$sql = mysqli_query($koneksi, "INSERT INTO produksi (id_produksi, truk, asal_batu, kode_lahan, muatan, kosong, volume, tgl) SELECT NULL, truk, asal_batu, kode_lahan, muatan, kosong, volume, tgl FROM produksi WHERE id_produksi = $id_produksi") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='produksi?m=salin';</script>";
		}else{
			echo "<script>window.location='produksi';</script>";
		}
	}
?>