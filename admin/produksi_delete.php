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
			// meambil id_stokpile dan volume
			$produksi = mysqli_query($koneksi, "SELECT id_stokpile, volume FROM produksi WHERE id_produksi = '$id_produksi'");
			$data = mysqli_fetch_array($produksi);
			$id_stokpile = $data['id_stokpile'];

			// mengambil nilai stok dari stokpile
			$datajumlah = mysqli_query($koneksi, "SELECT stok FROM stokpile WHERE id_stokpile = '$id_stokpile'");
	      	$stokygada = mysqli_fetch_array($datajumlah);
	      	// mengurangi nilai yg ada di STOK dengan VOLUME yg akan dihapus
	      	$totalstok = $stokygada['stok'] - $data['volume'];
			mysqli_query($koneksi, "UPDATE stokpile SET stok = '$totalstok' WHERE id_stokpile = '$id_stokpile'");

			// menghapus data produksinya 
			$sql = mysqli_query($koneksi, "DELETE FROM produksi WHERE id_produksi ='$id_produksi'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='produksi?m=hapus';</script>";
		}else{
			echo "<script>window.location='produksi';</script>";
		}
	}
?>