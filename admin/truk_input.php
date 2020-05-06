<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);
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
					    window.location = 'truk_input';
					  }else{
					  	window.location = 'truk';
					  }
					})
				</script>
		<?php } 

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

		<div class="row">
			<div class="col-md-6 col-sm-12 col">
			<h3 style="display: flex; float: left;">TRUK</h3></div> 
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
							<th>Kode Truk</th>
							<th>Merk</th>
							<th>Daya Angkut (ton)</th>
							<th>No. Polisi</th>
							<th>Pemilik</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<input type="text" name="kode_truk-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="merk-<?= $i ?>" class="form-control">
										<option disabled selected>-PILIH-</option>
										<option value="Hino 700 Series Profia SS1E Tractor Head">Hino 700 Series Profia SS1E Tractor Head</option>
										<option value="Hino 235 TI">Hino 235 TI</option>
										<option value="Hino 500">Hino 500</option>
										<option value="Hino Truk Ranger FM 350 T/H">Hino Truk Ranger FM 350 T/H</option>
										<option value="Hino Truk Ranger SG 260">Hino Truk Ranger SG 260</option>
						    		</select>
								</td>
								<td>
									<input type="number" step="any" name="daya_angkut-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="text" name="nopolisi-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="id_mitra-<?= $i ?>" class="form-control">
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_mitra] ?>"><?= $baris['nama_cv'] ?></option>
							    					<?php
							    				}
							    				$baramarta = mysqli_query($koneksi, "SELECT * FROM mitra WHERE nama_cv = 'PD. Baramarta'");
							    				$asem = mysqli_fetch_array($baramarta);
							    					?>
							    						<option value="<?= $asem[id_mitra] ?>"><?= $asem['nama_cv'] ?></option>
							    					<?php
							    			?>
							     	</select>
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
			$kode_truk 	= $_REQUEST['kode_truk-'.$i];
			$merk 		= $_REQUEST['merk-'.$i];
			$nopolisi 	= $_REQUEST['nopolisi-'.$i];
			$daya_angkut= $_REQUEST['daya_angkut-'.$i];
			$id_mitra 	= $_REQUEST['id_mitra-'.$i];

			$tambah = "INSERT INTO truk (kode_truk,merk,daya_angkut,nopolisi,id_mitra) VALUES ('$kode_truk','$merk','$daya_angkut','$nopolisi','$id_mitra')";
			$hasil = mysqli_query($koneksi, $tambah);
			if($hasil){ ?>
				<script>window.location = 'truk_input?m=simpan';</script>
			<?php }
		}
	}
	
	mysqli_close($koneksi);
?>