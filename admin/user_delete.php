<?php 
	error_reporting(0);
	require('../koneksi.php');
	$chk = $_POST['checked_user'];
	if(!isset($chk)){
		?> 
			<script>window.location='user_data?m=mana';</script>
		<?php
	}else{
		foreach($chk as $id){
			$sql = mysqli_query($koneksi, "DELETE FROM user WHERE id ='$id'") or die (mysqli_error($koneksi));
		}

		if($sql){
			echo "<script>window.location='user_data?m=hapus';</script>";
		}else{
			echo "<script>window.location='user_data';</script>";
		}
	}
?>