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
					    window.location = 'produksi_input';
					  }else{
					  	window.location = 'produksi';
					  }
					})
				</script>
		<?php } 
		
	?>

		<div class="row">
			<div class="col-md-6 col-sm-12 col">
			<h3 style="display: flex; float: left;">PRODUKSI</h3></div> 
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
							<th>Tanggal</th>
							<th>Shift</th>
							<th>Truk</th>
							<th>Lahan</th>
							<th>Muatan</th>
							<th>Kosong</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<input type="date" value="<?= date('Y-m-d') ?>" name="tgl-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="shift-<?= $i ?>" class="form-control">
										<option value="Siang">Siang</option>
										<option value="Malam">Malam</option>
									</select>
								</td>
								<td>
									<select name="id_truk-<?= $i ?>" class="form-control" required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM `truk` INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE nama_cv = 'PD. Baramarta' ORDER BY kode_truk ASC");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_truk] ?>"><?= $baris['kode_truk'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<select name="id_stokpile-<?= $i ?>" class="form-control" required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM stokpile ORDER BY kode_lahan ASC");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_stokpile] ?>"><?= $baris['kode_lahan'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="number" step="any" name="muatan-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="number" step="any" name="kosong-<?= $i ?>" class="form-control">
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
			$tgl 	= $_REQUEST['tgl-'.$i];
			$shift 	= $_REQUEST['shift-'.$i];
			$id_truk 	= $_REQUEST['id_truk-'.$i];
			$id_stokpile 	= $_REQUEST['id_stokpile-'.$i];
			$muatan 	= $_REQUEST['muatan-'.$i];
			$kosong 	= $_REQUEST['kosong-'.$i];
			$volume 	= $muatan - $kosong;

			$tambah = "INSERT INTO produksi (tgl,shift,id_truk,id_stokpile,muatan,kosong,volume) VALUES ('$tgl','$shift','$id_truk','$id_stokpile','$muatan','$kosong','$volume')";
			$hasil = mysqli_query($koneksi, $tambah);
			if($hasil){ 
				$stok = mysqli_query($koneksi, "SELECT stok FROM stokpile WHERE id_stokpile = '$id_stokpile' ");
				$data = mysqli_fetch_array($stok);
				$tambah = $data['stok'] + $volume;
				$update = mysqli_query($koneksi, "UPDATE stokpile SET stok = '$tambah' WHERE id_stokpile = '$id_stokpile' ");
			?>
				<script>window.location = 'produksi_input?m=simpan';</script>
			<?php }
		}
	}
	
	mysqli_close($koneksi);
?>