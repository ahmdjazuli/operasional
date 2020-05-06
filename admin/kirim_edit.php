<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked_kirim'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['id_kirim']); $i++){
	            $id_kirim 		= $_POST['id_kirim'][$i];
	            $tanggal_kirim  = $_POST['tanggal_kirim'][$i];
	            $nosurat   		= $_POST['nosurat'][$i];
	            $id_stokpile    = $_POST['id_stokpile'][$i];
	            $id_truk    	= $_POST['id_truk'][$i];
	            $id_transaksi   = $_POST['id_transaksi'][$i];
	            $lokasi    		= $_POST['lokasi'][$i];
	            $batubara    	= $_POST['batubara'][$i];
	            $batubara_baru  = $_POST['batubara_baru'][$i];
	            $target  		= $_POST['target'][$i];

	            $edit = mysqli_query($koneksi, "UPDATE kirim SET tanggal_kirim = '$tanggal_kirim', nosurat = '$nosurat', lokasi = '$lokasi', id_truk = '$id_truk' WHERE id_kirim = '$id_kirim'");

	            $stok = mysqli_query($koneksi, "SELECT stok FROM stokpile WHERE id_stokpile = '$id_stokpile' ");
				$data = mysqli_fetch_array($stok);

				$target = mysqli_query($koneksi, "SELECT target FROM transaksi WHERE id_transaksi = '$id_transaksi' ");
				$data1 = mysqli_fetch_array($target);

				if($data['stok']>=$batubara){
					$edit = mysqli_query($koneksi, "UPDATE kirim SET tanggal_kirim = '$tanggal_kirim', nosurat = '$nosurat', lokasi = '$lokasi', id_truk = '$id_truk', id_stokpile = '$id_stokpile', id_transaksi = '$id_transaksi', batubara = '$batubara_baru' WHERE id_kirim = '$id_kirim'");

					$kurangidulu	= $data['stok'] - $batubara;
					$hasilnya		= $kurangidulu + $batubara_baru;

					$targetasal		= $data1['target'] - $batubara; // 600 - 130 = 470
					$hasiltarget	= $targetasal + $batubara_baru; 
					

					mysqli_query($koneksi, "UPDATE stokpile SET stok = '$hasilnya' WHERE id_stokpile = '$id_stokpile' ");
					mysqli_query($koneksi, "UPDATE transaksi SET target = '$hasiltarget' WHERE id_transaksi = '$id_transaksi' ");

					?> <script>window.location = 'kirim?m=ubah';</script> <?php
				}else{
					?> <script>window.location = 'kirim?m=gagal';</script> <?php
				}
	        }
	    }
	    else{ 
	    	?> <script>window.location='kirim?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
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
			</form>
			</div>
		</div> 
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
							<th>Tanggal</th>
							<th>Truk</th>
							<th>No Surat Kirim</th>
							<th>Lahan</th>
							<th>Batu Bara (T)</th>
							<th>No. Transaksi</th>
							<th>Lokasi</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_kirim){
							$sql = mysqli_query($koneksi, "SELECT * FROM kirim INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE id_kirim = '$id_kirim'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="hidden" name="id_kirim[]" value="<?= $data['id_kirim'] ?>" >
									<input type="date" name="tanggal_kirim[]" class="form-control" value="<?= $data['tanggal_kirim'] ?>">
								</td>
								<td>
									<select name="id_truk[]" class="form-control" required>
										<option value="<?= $data['id_truk'] ?>"><?= $data['kode_truk'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE NOT nama_cv = 'PD. Baramarta' AND NOT kode_truk = '$data[kode_truk]' ORDER BY kode_truk ASC");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_truk] ?>"><?= $baris['kode_truk'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<input type="text" name="nosurat[]" value="<?= $data['nosurat'] ?>" class="form-control">
								</td>
								<td>
									<select name="id_stokpile[]" class="form-control" onchange='changeValue(this.value)' required>
										<option value="<?= $data['id_stokpile'] ?>"><?= $data['kode_lahan'] ?></option>
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
									<input type="number" step="any" name="batubara_baru[]" value="<?= $data['batubara'] ?>" class="form-control">
									<input type="hidden" step="any" name="batubara[]" value="<?= $data['batubara'] ?>" class="form-control" >
								</td>
								<td>
									<select name="id_transaksi" class="form-control" readonly>
										<option value="<?= $data['id_transaksi'] ?>">
											<?= $data['no_transaksi'].' - '.$data['nama_cv']; ?></option>
									</select>
								</td>
								<td>
									<input type="text" name="lokasi[]" value="<?= $data['lokasi'] ?>"  class="form-control">
									<input type="hidden" name="target[]" value="<?= $data['target'] ?>"  class="form-control">
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
	<script type="text/javascript">   
	<?php   
		echo $a;
	?>  
        function changeValue(id){  
            document.getElementById('stok').value = stok[id].stok; 
        }; 
</script> 

<?php
	require("footer-admin.php"); 
?> 