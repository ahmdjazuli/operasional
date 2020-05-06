<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);
	$format = str_replace(':', '', date('h:i:s'));
?>
	<div class="container">
	<?php 
		?> <script src="../js/sweetalert2.all.min.js"></script> <?php
		
		if($_GET['m']=="simpan"){ ?>
				<script type="text/javascript">
					Swal.fire({
					  title: 'Tambah Data Lagi?',
					  text: "Data Berhasil disimpan!",
					  type: 'success',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Iya!',
					  cancelButtonText : 'Tidak!',
					}).then((result) => {
					  if (result.value) {
					    window.location = 'transaksi_input';
					  }else{
					  	window.location = 'transaksi';
					  }
					})
				</script>
		<?php } 
		
	?>

		<div class="row">
			<div class="col-md-6 col-sm-12 col">
			<h3 style="display: flex; float: left;">TRANSAKSI</h3></div> 
			<div class="col-md-6 col-sm-12 col" style="margin-left: auto; max-width:250px;">
			<form action="" method="post">
				<div class="input-group mb-3">
					<input type="text" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" placeholder="Jumlah Kolom" class="form-control" aria-label="" aria-describedby="basic-addon1" required>
					<div class="input-group-prepend">
						<button class="btn btn-success" type="submit" name="generate"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#ffffff" d="M14 12L10 8V11H2V13H10V16M22 12A10 10 0 0 1 2.46 15H4.59A8 8 0 1 0 4.59 9H2.46A10 10 0 0 1 22 12Z" /></svg></button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="table-responsive-md table-responsive-sm table-responsive-lg">
			<form action="" method="post">
				<input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
				<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
					<thead class="thead-dark">
						<tr class="text-center">
							<th>NO</th>
							<th>Nama Mitra</th>
							<th>Tanggal</th>
							<th>Surveyor</th>
							<th>Tonase</th>
							<th>Harga</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<input type="hidden" name="no_transaksi-<?= $i ?>" value="<?php echo $format.$i; ?>" class="form-control" readonly>
									<select name="id_mitra-<?= $i ?>" class="form-control">
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM mitra WHERE id_mitra NOT IN (SELECT id_mitra FROM kontrak) AND NOT nama_cv ='PD. Baramarta'");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_mitra] ?>"><?= $baris['nama_cv'] ?></option>
							    					<?php
							    				} 
							    			?>
							     	</select>
								</td>
								<td>
									<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="surveyor-<?= $i ?>" class="form-control">
										<option disabled selected>-PILIH-</option>
										<option value="Geoservices">Geoservices</option>
										<option value="Anindya">Anindya</option>
										<option value="SGS Indonesia">SGS Indonesia</option>
										<option value="Surveyor Indonesia">Surveyor Indonesia</option>
										<option value="Sucofindo">Sucofindo</option>
										<option value="CCIC">CCIC</option>
										<option value="lOL">lOL</option>
										<option value="Carsurin">Carsurin</option>
						    		</select>
								</td>
								<td>
									<input type="number" step="any" name="tonase-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="number" step="any" name="harga-<?= $i ?>" class="form-control">
								</td>
							</tr>
					<?php } ?>
				</table>
				<div class="form-group" style="text-align: center; margin-top: 10px;">
					<button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN SEMUA</button>
				</div>
			</form>
		</div>
	
	</div> <!-- akhir container -->

<?php
	require("footer-admin.php");
?> 

<?php
	if(isset($_POST['add'])){
		$total = $_POST['total'];

		for($i=1; $i<=$total; $i++){
			$id_mitra 	= $_REQUEST['id_mitra-'.$i];
			$tanggal 	= $_REQUEST['tanggal-'.$i];
			$surveyor 	= $_REQUEST['surveyor-'.$i];
			$tonase 	= $_REQUEST['tonase-'.$i];
			$harga 		= $_REQUEST['harga-'.$i];
			$no_transaksi 	= $_REQUEST['no_transaksi-'.$i];

			$tambah = "INSERT INTO transaksi (id_mitra,tanggal,surveyor,tonase,harga,target,no_transaksi) VALUES ('$id_mitra','$tanggal','$surveyor','$tonase','$harga','$tonase','$no_transaksi')";
			$hasil = mysqli_query($koneksi, $tambah);
			?>
				<script>window.location = 'transaksi_input?m=simpan';</script>
			<?php
		}
	}
	
	mysqli_close($koneksi);
?>