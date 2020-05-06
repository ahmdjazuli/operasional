<?php 
	require('header-admin.php'); 
	require("../koneksi.php");
	$id = $_GET['id'];
	$data1 =  mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'"));
?>		
	<form action="" method="POST">
	<div class="container">
		<div class="row">
			<div class="container">	
			<h3 style="display: flex; float: left;">DATA ADMIN</h3> 
			<br><hr>
		</div>
			<div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
				<table class="table table-hover table-condensed">
		<tr>
			<th>Username</th>
			<td><input type="text" class="form-control" name="username" value="<?php echo $data1['username']; ?>"></td>
		</tr>
		<tr>
			<th>Password Baru</th>
			<td><input type="text" class="form-control" name="passwordbaru" placeholder="G usah diisi klo g mau!"></td>
		</tr>
	</table>
	</form>
			</div>
		<div style="display: flex; margin: 0 auto;">
				<button type="submit" data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-primary" name="ubah"><b>UBAH</b></button>
			</div>	
	</div>
<?php 
$kon = mysqli_connect('localhost', 'root', '', 'operasional') or die ("kon Gagal");
if(isset($_POST['ubah'])){
	$username 		= $_POST['username'];
	$passwordbaru 	= password_hash($_POST['passwordbaru'], PASSWORD_DEFAULT);
	$edit = mysqli_query($kon, "UPDATE user SET username = '$username', password = '$passwordbaru' WHERE id = '$id'");
	if($edit){
		echo "<script>window.location='user_data?m=ubah';  </script>";
	}else{
		echo "<script>window.location='user_data?m=gagal';</script>";
	}
}

require('footer-admin.php'); 
?>