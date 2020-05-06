<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['id_transaksi']); $i++){
	            $id_transaksi = $_POST['id_transaksi'][$i];
	            $id_mitra  	= $_POST['id_mitra'][$i];
	            $tanggal   	= $_POST['tanggal'][$i];
	            $harga     	= $_POST['harga'][$i];
	            $surveyor   = $_POST['surveyor'][$i];
	            $edit = mysqli_query($koneksi, "UPDATE transaksi SET id_mitra = '$id_mitra', tanggal = '$tanggal', harga = '$harga', surveyor = '$surveyor' WHERE id_transaksi = '$id_transaksi'");
	            if($edit){
	                echo "<script>window.location='transaksi?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='transaksi?m=gagal';</script>";
	            }
	        }
	    }
	    else{ 
	    	?> <script>window.location='transaksi?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">TRANSAKSI</h3></div> 
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
							<th>No. Transaksi</th>
							<th>Nama Mitra</th>
							<th>Tanggal</th>
							<th>Surveyor</th>
							<th>Harga</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_transaksi){
							$sql = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra WHERE id_transaksi = '$id_transaksi'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="text" name="no_transaksi[]" value="<?= $data['no_transaksi'] ?>" class="form-control" readonly>
								</td>
								<td>
									<input type="hidden" name="id_transaksi[]" value="<?= $data['id_transaksi'] ?>" >
									<select name="id_mitra[]" class="form-control" required>
										<option value="<?php echo $data['id_mitra'] ?>"><?= $data['nama_cv'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM mitra WHERE id_mitra NOT IN (SELECT id_mitra FROM kontrak) AND NOT nama_cv ='PD. Baramarta' AND NOT nama_cv = '$data[nama_cv]'");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_mitra] ?>"><?= $baris['nama_cv'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="date" name="tanggal[]" value="<?= $data['tanggal'] ?>" class="form-control">
								</td>
								<td>
									<select name="surveyor[]" class="form-control" required>
						<?php 
							if($data['surveyor'] == ""){
								echo "<option value=''>-PILIH-</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "Geoservices"){
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "Anindya"){
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "SGS Indonesia"){
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "Surveyor Indonesia"){
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "Sucofindo"){
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "CCIC"){
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "lOL"){
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
								echo "<option value='Carsurin'>Carsurin</option>";
							}else if($data['surveyor'] == "Carsurin"){
								echo "<option value='Carsurin'>Carsurin</option>";
								echo "<option value='lOL'>lOL</option>";
								echo "<option value='CCIC'>CCIC</option>";
								echo "<option value='Sucofindo'>Sucofindo</option>";
								echo "<option value='Surveyor Indonesia'>Surveyor Indonesia</option>";
								echo "<option value='SGS Indonesia'>SGS Indonesia</option>";
								echo "<option value='Anindya'>Anindya</option>";
								echo "<option value='Geoservices'>Geoservices</option>";
							}
						?>
			    		</select>
								</td>
								<td>
									<input type="number" step="any" name="harga[]" value="<?= $data['harga'] ?>" class="form-control">
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