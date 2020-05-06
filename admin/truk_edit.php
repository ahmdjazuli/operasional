<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['id_truk']); $i++){
	            $id_truk 		= $_POST['id_truk'][$i];
	            $kode_truk  	= $_POST['kode_truk'][$i];
	            $merk  			= $_POST['merk'][$i];
	            $daya_angkut   	= $_POST['daya_angkut'][$i];
	            $nopolisi     	= $_POST['nopolisi'][$i];
	            $id_mitra     	= $_POST['id_mitra'][$i];
	            $edit = mysqli_query($koneksi, "UPDATE truk SET kode_truk = '$kode_truk', merk = '$merk', daya_angkut = '$daya_angkut', nopolisi = '$nopolisi', id_mitra = '$id_mitra' WHERE id_truk = '$id_truk'");
	            if($edit){
	                echo "<script>window.location='truk?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='truk?m=gagal';</script>";
	            }
	        }
	    }
	    else{ 
	    	?> <script>window.location='truk?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">TRUK</h3></div> 
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
							<th>Kode Truk</th>
							<th>Merk</th>
							<th>Daya Angkut (ton)</th>
							<th>No. Polisi</th>
							<th>Pemilik</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_truk){
							$sql = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE id_truk = '$id_truk'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="hidden" name="id_truk[]" value="<?= $data['id_truk'] ?>" >
									<input type="text" name="kode_truk[]" class="form-control" value="<?= $data['kode_truk'] ?>" autofocus>
								</td>
								<td>
									<select name="merk[]" class="form-control">
										<option value="<?= $data['merk'] ?>"><?= $data['merk'] ?></option>
										<option value="Hino 700 Series Profia SS1E Tractor Head">Hino 700 Series Profia SS1E Tractor Head</option>
										<option value="Hino 235 TI">Hino 235 TI</option>
										<option value="Hino 500">Hino 500</option>
										<option value="Hino Truk Ranger FM 350 T/H">Hino Truk Ranger FM 350 T/H</option>
										<option value="Hino Truk Ranger SG 260">Hino Truk Ranger SG 260</option>
						    		</select>
								</td>
								<td>
									<input type="text" name="daya_angkut[]" value="<?= $data['daya_angkut'] ?>" class="form-control">
								</td>
								<td>
									<input type="text" name="nopolisi[]" value="<?= $data['nopolisi'] ?>" class="form-control">
								</td>
								<td>
									<select name="id_mitra[]" class="form-control" required>
										<option value="<?= $data['id_mitra'] ?>"><?= $data['nama_cv'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra AND NOT nama_cv = '$data[nama_cv]' ");
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