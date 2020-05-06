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
					    window.location = 'kontrak_input';
					  }else{
					  	window.location = 'kontrak';
					  }
					})
				</script>
		<?php } 

		if($_GET['m']=="gagal"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Gagal Simpan Data',
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
			<h3 style="display: flex; float: left;">KONTRAK</h3></div> 
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
							<th>Bagi Hasil </th>
							<th>Awal Tanggal</th>
							<th>Batas Kontrak</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<input type="hidden" name="nokontrak-<?= $i ?>" value="<?php echo $format.$i; ?>" class="form-control" readonly>
								<td>
									<select name="id_mitra-<?= $i ?>" class="form-control" required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM mitra WHERE NOT nama_cv = 'PD. Baramarta' AND nama_cv NOT IN (SELECT nama_cv FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra) ORDER BY nama_cv ASC");
							    				while($baris = mysqli_fetch_array($ahay)) { ?>
							    					<option value="<?= $baris[id_mitra] ?>"><?= $baris['nama_cv'] ?></option>
							    				<?php } 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="text" name="bagihasil-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="date" value="<?php $tgl = date('Y-m-d'); echo date('Y-m-d',strtotime($tgl.' +1 year'));  ?>" name="tanggal1-<?= $i ?>" class="form-control">
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
			$id_mitra 		= $_REQUEST['id_mitra-'.$i];
			$tanggal 		= $_REQUEST['tanggal-'.$i];
			$bagihasil 		= $_REQUEST['bagihasil-'.$i];
			$tanggal1 		= $_REQUEST['tanggal1-'.$i];
			$nokontrak 		= $_REQUEST['nokontrak-'.$i];

			$tambah = "INSERT INTO kontrak (no_kontrak,id_mitra,tanggal,tanggal1,bagihasil) VALUES ('$nokontrak','$id_mitra','$tanggal','$tanggal1','$bagihasil')";
			$hasil = mysqli_query($koneksi, $tambah);
			if($hasil){ ?>
				<script>window.location = 'kontrak_input?m=simpan';</script>
			<?php }else{ ?>
				<script>window.location = 'kontrak_input?m=gagal';</script>
			<?php }
		}
	}
	
	mysqli_close($koneksi);
?>