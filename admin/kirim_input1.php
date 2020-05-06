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
		
	?>

		<div class="row">
			<div class="col-md-6 col-sm-12 col">
			<h3 style="display: flex; float: left;">PENGIRIMAN BATUBARA HARIAN</h3></div> 
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
							<th>No Surat Kirim</th>
							<th colspan="2">Truk</th>
							<th>Asal Batu</th>
							<th>Kode Lahan</th>
							<th>Muatan</th>
							<th>Kosong</th>
							<th>No. Kontrak</th>
						</tr>
					</thead>
					<?php 
						for($i=1; $i<=$_POST['count_add']; $i++){ ?>
							<tr class="text-center">
								<td><?= $i ?></td>
								<td>
									<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="text" name="nosurat-<?= $i ?>" class="form-control">
								</td>
								<td>
									<input type="text" name="unit-<?= $i ?>" class="form-control">
								</td>
								<td>
									<select name="id_produksi-<?= $i ?>" class="form-control" onchange='changeValue(this.value)' required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM produksi ORDER BY truk ASC");
												$a          = "var asal_batu = new Array();\n;";
												$b          = "var muatan = new Array();\n;";
												$c          = "var kode_lahan = new Array();\n;";
												$d          = "var kosong = new Array();\n;";
							    				while ($row = mysqli_fetch_array($ahay)) {  
							    					?>
							    						<option name="id_produksi" value="<?= $row[id_produksi] ?>"><?= $row['truk'] ?></option>
							    					<?php
							    					$a .= "asal_batu['" . $row['id_produksi'] . "'] = {asal_batu:'" . addslashes($row['asal_batu'])."'};\n";
							    					$b .= "muatan['" . $row['id_produksi'] . "'] = {muatan:'" . addslashes($row['muatan'])."'};\n";
							    					$c .= "kode_lahan['" . $row['id_produksi'] . "'] = {kode_lahan:'" . addslashes($row['kode_lahan'])."'};\n"; 
							    					$d .= "kosong['" . $row['id_produksi'] . "'] = {kosong:'" . addslashes($row['kosong'])."'};\n";    
							    				}  
							    				?>
							    			?>
							    	</select>
								</td>
								<td>
									<input type="text" id="asal_batu" class="form-control" readonly>
								</td>
								<td>
									<input type="text" id="kode_lahan" class="form-control" readonly>
								</td>
								<td>
									<input type="number" id="muatan" step="any" class="form-control" readonly>
								</td>
								<td>
									<input type="number" id="kosong" step="any" class="form-control" readonly>
								</td>
								<td>
									<select name="no_kontrak-<?= $i ?>" class="form-control" required>
										<option disabled selected>-PILIH-</option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT no_kontrak FROM kontrak");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[no_kontrak] ?>"><?= $baris['no_kontrak'] ?></option>
							    					<?php
							    				} 
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
<script type="text/javascript">   
	<?php   
		echo $a; echo $b; echo $c; echo $d; 
	?>  
        function changeValue(id){  
            document.getElementById('asal_batu').value = asal_batu[id].asal_batu; 
            document.getElementById('muatan').value = muatan[id].muatan;
            document.getElementById('kode_lahan').value = kode_lahan[id].kode_lahan;
            document.getElementById('kosong').value = kosong[id].kosong; 
        };  
</script> 

<?php
	require("footer-admin.php");
?> 

<?php
	if(isset($_POST['add'])){
		$total = $_POST['total'];

		for($i=1; $i<=$total; $i++){
			$no_kontrak 	= $_REQUEST['no_kontrak-'.$i];
			$id_produksi 	= $_REQUEST['id_produksi-'.$i];
			$tanggal 		= $_REQUEST['tanggal-'.$i];
			$nosurat 		= $_REQUEST['nosurat-'.$i];
			$unit 			= $_REQUEST['unit-'.$i];

			$tambah = "INSERT INTO kirim (no_kontrak, id_produksi, tanggal, nosurat,unit) VALUES ('$no_kontrak','$id_produksi','$tanggal','$nosurat','$unit')";
			$hasil = mysqli_query($koneksi, $tambah);
			if($hasil){ ?>
				<script>window.location = 'kirim_input?m=simpan';</script>
			<?php }
		}
	}
	
	mysqli_close($koneksi);
?>