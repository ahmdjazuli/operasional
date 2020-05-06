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
					    window.location = 'stokpile_input';
					  }else{
					  	window.location = 'stokpile';
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
			<h3 style="display: flex; float: left;">STOKPILE</h3></div> 
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
							<th>Nama Stokpile</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<select name="kode_lahan-<?= $i ?>"class="form-control" required>
										<option selected disabled>PILIH</option>
										<option value="Pit Barat">Pit Barat</option>
										<option value="Pit Utara">Pit Utara</option>
										<option value="Pit Timur">Pit Timur</option>
										<option value="Pit Selatan">Pit Selatan</option>
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
			$kode_lahan 	= $_REQUEST['kode_lahan-'.$i];

			$cek = mysqli_query($koneksi, "SELECT kode_lahan FROM stokpile WHERE kode_lahan = '$kode_lahan'");

			if(mysqli_num_rows($cek)>0){
				?> <script>window.location = 'stokpile_input?m=sama';</script> <?php 
			}else{
				$hasil = mysqli_query($koneksi, "INSERT INTO stokpile (kode_lahan) VALUES ('$kode_lahan')");
				?> <script>window.location = 'stokpile_input?m=simpan';</script> <?php
			}	
		}
	}
	
	mysqli_close($koneksi);
?>