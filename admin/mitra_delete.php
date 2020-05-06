<?php
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked'];
	if(!isset($chk)){
		?> 
			<script>window.location='mitra?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_mitra){
			$sql = mysqli_query($koneksi, "DELETE FROM mitra WHERE id_mitra ='$id_mitra'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='mitra?m=hapus';</script>";
		}else{
			echo "<script>window.location='mitra';</script>";
		}
	}
?>