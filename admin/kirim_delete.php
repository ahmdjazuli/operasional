<?php
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked_kirim'];
	if(!isset($chk)){
		?> 
			<script>window.location='kirim?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_kirim){
			$sql = mysqli_query($koneksi, "DELETE FROM kirim WHERE id_kirim ='$id_kirim'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='kirim?m=hapus';</script>";
		}else{
			echo "<script>window.location='kirim';</script>";
		}
	}
?>