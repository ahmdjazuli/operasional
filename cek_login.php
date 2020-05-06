<?php 
session_start();
require_once("koneksi.php");

	$username 	= $_REQUEST['username'];
	$password	= $_REQUEST['password'];

	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
	$cek  = mysqli_num_rows($query);

	if($cek>0){
		$_SESSION['username'] = $username;
		header("location:admin/");	
	}else{
		header("location:hahaha_gagal");
	}			
?>