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
					    window.location = 'kirim_input';
					  }else{
					  	window.location = 'kirim';
					  }
					})
				</script>
		<?php } 

		if($_GET['m']=="gagal"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Stok Tidak Tersedia',
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
			<h3 style="display: flex; float: left;">PENGIRIMAN BATUBARA HARIAN</h3>
			<div class="input-group input-group-mb" style="max-width: 270px;">
				<div class="input-group-prepend">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background-color: #28a745; color: white;">Stok Tersedia : </span>
					</div>
				</div>
					<input type="number" id="stok" step="any" class="form-control" disabled>
				</div>
		</div>
			<div class="col-md-6 col-sm-12 col" style="margin-left: auto; max-width:250px;">
			<form action="" method="post">
				<div class="input-group mb-3">
					<input type="text" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" placeholder="Jumlah Kolom" class="form-control" aria-label="" aria-describedby="basic-addon1" required>
					<div class="input-group-prepend">
						<button class="btn btn-success" type="submit" name="generate"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#ffffff" d="M14 12L10 8V11H2V13H10V16M22 12A10 10 0 0 1 2.46 15H4.59A8 8 0 1 0 4.59 9H2.46A10 10 0 0 1 22 12Z" /></svg></button>
					</div>
				</div>
				<div class="input-group input-group-mb" style="max-width: 270px;">
				<div class="input-group-prepend">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background-color: #dc3545; color: white;">Target : </span>
					</div>
				</div>
					<input type="number" id="target" step="any" class="form-control" disabled>
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
							<th>No Surat Kirim</th>
							<th>Truk</th>
							<th>Nama Stockpile</th>
							<th>Batubara</th>
							<th>No. Transaksi</th>
							<th>Lokasi</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal_kirim-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="text" name="nosurat-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="id_truk-<?= $i ?>" class="form-control" required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE NOT nama_cv = 'PD. Baramarta' ORDER BY kode_truk ASC");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_truk] ?>"><?= $baris['kode_truk'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<select name="id_stokpile-<?= $i ?>" class="form-control" onchange='changeValue(this.value)' required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM stokpile ORDER BY kode_lahan ASC");
												$a          = "var stok = new Array();\n;";
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_stokpile] ?>"><?= $baris['kode_lahan'] ?></option>
							    					<?php
							    					$a .= "stok['" . $baris['id_stokpile'] . "'] = {stok:'" . addslashes($baris['stok'])."'};\n";
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="number" step="any" name="batubara-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="id_transaksi-<?= $i ?>" class="form-control" onchange='ubahNilai(this.value)' required>
										<option disabled selected>-PILIH-</option>
											<?php
												$query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra ORDER BY tanggal ASC");
												$b          = "var target = new Array();\n;";
							    				while($tes = mysqli_fetch_array($query)) {
							    					?>
							    						<option value="<?= $tes[id_transaksi] ?>"><?= $tes['no_transaksi'].' - '.$tes['nama_cv'] ?></option>
							    					<?php
							    					$b .= "target['" . $tes['id_transaksi'] . "'] = {target:'" . addslashes($tes['target'])."'};\n";
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="text" name="lokasi-<?= $i ?>" class="form-control">
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
<script type="text/javascript">   
	<?php   
		echo $a;echo $b;
	?>  
        function changeValue(id){  
            document.getElementById('stok').value = stok[id].stok; 
        }; 
        function ubahNilai(id){  
            document.getElementById('target').value = target[id].target; 
        };   
</script> 

<?php
	require("footer-admin.php");
?> 

<?php
	if(isset($_POST['add'])){
		$total = $_POST['total'];

		for($i=1; $i<=$total; $i++){
			$id_transaksi 	= $_REQUEST['id_transaksi-'.$i];
			$id_stokpile 	= $_REQUEST['id_stokpile-'.$i];
			$tanggal_kirim 	= $_REQUEST['tanggal_kirim-'.$i];
			$nosurat 		= $_REQUEST['nosurat-'.$i];
			$id_truk 		= $_REQUEST['id_truk-'.$i];
			$batubara 		= $_REQUEST['batubara-'.$i];
			$lokasi 		= $_REQUEST['lokasi-'.$i];
			
			$stok = mysqli_query($koneksi, "SELECT stok FROM stokpile WHERE id_stokpile = '$id_stokpile' ");
			$data = mysqli_fetch_array($stok);

			$target = mysqli_query($koneksi, "SELECT target FROM transaksi WHERE id_transaksi = '$id_transaksi' ");
			$data1 = mysqli_fetch_array($target);

			if($data['stok']>=$batubara){
				$hasil = mysqli_query($koneksi, "INSERT INTO kirim (id_transaksi, id_stokpile, tanggal_kirim, nosurat,id_truk,batubara,lokasi) VALUES ('$id_transaksi','$id_stokpile','$tanggal_kirim','$nosurat','$id_truk','$batubara','$lokasi')");
				$kurang 	= $data['stok'] - $batubara;
				$kurangi 	= $data1['target'] - $batubara; 
				$updatestok = mysqli_query($koneksi, "UPDATE stokpile SET stok = '$kurang' WHERE id_stokpile = '$id_stokpile' ");
				$updatetarget = mysqli_query($koneksi, "UPDATE transaksi SET target = '$kurangi' WHERE id_transaksi = '$id_transaksi' ");
				?> <script>window.location = 'kirim_input?m=simpan';</script> <?php
			}else{
				?> <script>window.location = 'kirim_input?m=gagal';</script> <?php
			}
				
			
		}
	}
	
	mysqli_close($koneksi);
?>