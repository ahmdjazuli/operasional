<?php
	error_reporting(0); 
	require('../koneksi.php');
	$chk = $_POST['checked'];
	if(!isset($chk)){
		?> 
			<script>window.location='truk?m=mana';</script>
		<?php 
	}else{
		foreach($chk as $id_truk){
			$sql = mysqli_query($koneksi, "DELETE FROM truk WHERE id_truk ='$id_truk'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='truk?m=hapus';</script>";
		}else{
			echo "<script>window.location='truk';</script>";
		}
	}
?>