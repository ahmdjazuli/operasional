<?php
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked'];
	if(!isset($chk)){
		?> 
			<script>window.location='transaksi?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_transaksi){
			$sql = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi ='$id_transaksi'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='transaksi?m=hapus';</script>";
		}else{
			echo "<script>window.location='transaksi';</script>";
		}
	}
?>