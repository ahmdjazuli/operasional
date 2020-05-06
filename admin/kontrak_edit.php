<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['id_kontrak']); $i++){
	            $id_kontrak = $_POST['id_kontrak'][$i];
	            $bagihasil  = $_POST['bagihasil'][$i];
	            $id_mitra   = $_POST['id_mitra'][$i];
	            $tanggal = $_POST['tanggal'][$i];
	            $tanggal1 = $_POST['tanggal1'][$i];
	            $edit = mysqli_query($koneksi, "UPDATE kontrak SET bagihasil = '$bagihasil', id_mitra = '$id_mitra', tanggal = '$tanggal', tanggal1 = '$tanggal1' WHERE id_kontrak = '$id_kontrak'");
	            if($edit){
	                echo "<script>window.location='kontrak?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='kontrak?m=gagal';</script>";
	            }
	        }
	    }
	    else{ 
	    	?> <script>window.location='kontrak?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">KONTRAK</h3></div> 
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
							<th>No. Kontrak</th>
							<th>Nama Mitra</th>
							<th>Bagi Hasil</th>
							<th>Awal Tanggal</th>
							<th>Batas Kontrak</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_kontrak){
							$sql = mysqli_query($koneksi, "SELECT * FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra WHERE id_kontrak = '$id_kontrak'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="text" name="no_kontrak[]" value="<?= $data['no_kontrak'] ?>" class="form-control" readonly>
								</td>
								<td>
								<select name="id_mitra[]" class="form-control" required>
										<option value="<?php echo $data['id_mitra'] ?>"><?= $data['nama_cv'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM mitra WHERE NOT nama_cv = '$data[nama_cv]' ORDER BY nama_cv ASC");
							    				while ($row = mysqli_fetch_array($ahay)) {  
							    					?>
							    						<option value="<?= $row[id_mitra] ?>"><?= $row['nama_cv'] ?></option>
							    					<?php
							    				}  
							    				?>
							    			?>
							    	</select>
							    </td>
								<td>
									<input type="hidden" name="id_kontrak[]" value="<?= $data['id_kontrak'] ?>" >
									<input type="text" name="bagihasil[]" class="form-control" value="<?= $data['bagihasil'] ?>">
								</td>
								<td>
									<input type="date" name="tanggal[]" value="<?= $data['tanggal'] ?>" class="form-control">
								</td>
								<td>
									<input type="date" name="tanggal1[]" value="<?= $data['tanggal1'] ?>" class="form-control">
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