<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['id_mitra']); $i++){
	            $id_mitra = $_POST['id_mitra'][$i];
	            $nama_cv  = $_POST['nama_cv'][$i];
	            $alamat   = $_POST['alamat'][$i];
	            $telp     = $_POST['telp'][$i];
	            $edit = mysqli_query($koneksi, "UPDATE mitra SET nama_cv = '$nama_cv', alamat = '$alamat', telp = '$telp' WHERE id_mitra = '$id_mitra'");
	            if($edit){
	                echo "<script>window.location='mitra?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='mitra?m=gagal';</script>";
	            }
	        }
	    }
	    else{ 
	    	?> <script>window.location='mitra?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">MITRA</h3></div> 
	<?php
		?> <script src="../js/sweetalert2.all.min.js"></script> <?php

		if($_GET['m']=="sama"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Duplikat Data',
				  text: "Data Gagal disimpan!",
				  type: 'warning',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php }

		?>
		<div class="table-responsive-md table-responsive-sm table-responsive-lg">
			<form action="" method="post">
				<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
					<thead class="thead-dark">
						<tr class="text-center">
							<th>NO</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Telp</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_mitra){
							$sql = mysqli_query($koneksi, "SELECT * FROM mitra WHERE id_mitra = '$id_mitra'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="hidden" name="id_mitra[]" value="<?= $data['id_mitra'] ?>" >
									<input type="text" name="nama_cv[]" class="form-control" value="<?= $data['nama_cv'] ?>" required autofocus>
								</td>
								<td>
									<input type="text" name="alamat[]" value="<?= $data['alamat'] ?>" class="form-control" required>
								</td>
								<td>
									<input type="text" name="telp[]" value="<?= $data['telp'] ?>" class="form-control" required>
								</td>
							</tr>
					<?php 		} 
							}
						}
					?>
				</table>
				<div class="form-group" style="text-align: center; margin-top: 10px;">
					<button type="submit" name="edit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN SEMUA</button>
				</div>
			</form>
		</div>
	
	</div> <!-- akhir container -->

<?php
	require("footer-admin.php"); 
?> 