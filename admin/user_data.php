<?php 
	require('header-admin.php'); 
	require("../koneksi.php");
	$data1 =  mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user"));
?>
		<?php 
			?> <script src="../js/sweetalert2.all.min.js"></script> <?php
		
		if($_GET['m']=="ubah"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Berhasil Diubah',
				  type: 'success',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php } 

		?>
		
		<div class="container">
			
		<div class="row">
			<div class="container">	
			<h3 style="display: flex; float: left;">DATA ADMIN</h3> 
			<div style="display: flex; float: right" id="pencarian1">
				<button type="button" data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-warning"><a href="user_edit.php?id=<?=$data1[id]?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z" /></svg></a></button>
			</div>	
			<br><hr>
		</div>
			<div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
				<table class="table table-striped table-condensed">
		<tr>
			<th>Username</th>
			<td><input type="text" value="<?php echo $data1['username']; ?>" class='form-control' readonly></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" value="<?php echo $data1['password']; ?>" class='form-control' readonly></td>
		</tr>
	</table>
			</div>
		</div>

		
	</div>

	<br>
<?php require('footer-admin.php'); ?>