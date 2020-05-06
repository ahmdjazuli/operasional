<?php
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked'];
	if(!isset($chk)){
		?> 
			<script>window.location='kontrak?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_kontrak){
			$sql = mysqli_query($koneksi, "DELETE FROM kontrak WHERE id_kontrak ='$id_kontrak'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='kontrak?m=hapus';</script>";
		}else{
			echo "<script>window.location='kontrak';</script>";
		}
	}
?>