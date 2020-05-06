<?php 
	require('header-admin.php'); 
	require("../koneksi.php");
	$pola = 'ASC';
	$polabaru = 'ASC';
	if(isset($_GET['urut'])){
		$orderby = $_GET['urut'];
		$pola = $_GET['pola'];
		if($pola=='ASC'){
			$polabaru = 'DESC';
			$kodesvg = 'M10 11V13H18V11H10M10 17V19H14V17H10M10 5V7H22V5H10M6 7H8.5L5 3.5L1.5 7H4V20H6V7Z';
		}else{
			$polabaru = 'ASC';
			$kodesvg = 'M10,13V11H18V13H10M10,19V17H14V19H10M10,7V5H22V7H10M6,17H8.5L5,20.5L1.5,17H4V4H6V17Z';
		}
	}else{
		$kodesvg = 'M10,13V11H18V13H10M10,19V17H14V19H10M10,7V5H22V7H10M6,17H8.5L5,20.5L1.5,17H4V7H1.5L5,3.5L8.5,7H6V17Z';
	}
?>
	<div class="container">	
		<form action="" method="POST">
			<h2 style="display: flex; float: left;">STOKPILE</h2> 
			<div style="display: flex; float: right">
				<input type="text" id="keyword" placeholder="Cari.." name="cari" autofocus>
				<button type="submit" id="tombol-cari" data-toggle="tooltip" data-placement="top" title="Cari" class="btn-sm btn-dark" style="border:none;"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg></button>
		</form>
	</div>	
	<br>
	<hr>
		<?php 
			?> <script src="../js/sweetalert2.all.min.js"></script> <?php
		
		if($_GET['m']=="ubah"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Berhasil Diubah',
				  type: 'success',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php } 

		if($_GET['m']=="mana"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Tidak Ada Data Yang Dipilih!',
				  type: 'warning',
				  confirmButtonColor: '#d33',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php } 

		if($_GET['m']=="salin"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Berhasil Disalin',
				  type: 'success',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php }

		if($_GET['m']=="hapus"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Berhasil Dihapus',
				  type: 'deleted',
				  confirmButtonColor: '#d33',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php } 

		?>

		<div id="cetakperiode" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CETAK PDF DATA STOKPILE</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form target="_blank" action="CetakStokpilePDF.php" method="post">
              <div class="form-group">
                <label for="">Nama Stockpile</label>
                <select name="kode_lahan" class="form-control" required>
					<option disabled selected>-PILIH-</option>
						<?php
							$ahay = mysqli_query($koneksi, "SELECT * FROM stokpile ORDER BY kode_lahan ASC");
							    while($baris = mysqli_fetch_array($ahay)) { ?>
							    	<option value="<?= $baris[kode_lahan] ?>"><?= $baris['kode_lahan'] ?></option>
						<?php } ?>
			  	</select>
              </div>
              <div class="text-left">
                <button class="btn btn-info" type="submit" name="cetak">CETAK</button>
                <button class="btn btn-dark" type="reset">RESET</button>
              </div>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

		<div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg" >
			<form name="stokpile_proses" method="POST">
			<div class="form-group">
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah"><a id="log" href="stokpile_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
		</div>
			<table class="table table-hover table-bordered table-sm">
				<thead class="thead-dark">
				<tr class="text-center">
					<th>No</th>
					<th>Nama Stokpile <a id="log" href="stokpile_kode_lahan_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>" /></svg></a></th>
					<th>Jumlah Batubara (T) <a id="log" href="stokpile_stok_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>"/></svg></a></th>
				</tr>
				<?php
					$halaman 	  = 7; //batasan halaman
					$page    	  = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
					$mulai        = ($page>1) ? ($page * $halaman) - $halaman : 0;
					$sql     	  = mysqli_query($koneksi, 'SELECT * FROM stokpile');
					$total        = mysqli_num_rows($sql);
					$pages   	  = ceil($total/$halaman);
					$previous	  = $page - 1;
					$next		  = $page + 1;

					if(isset($_POST['cari'])){
						$cari = $_POST['cari'];
						$stokpile = mysqli_query($koneksi, "SELECT * FROM stokpile WHERE stok LIKE '%".$cari."%' OR kode_lahan LIKE '%".$cari."%'");
					}else{
						if(isset($_GET['urut'])){
							$stokpile = mysqli_query($koneksi, "SELECT * FROM stokpile ORDER BY $orderby $polabaru LIMIT $mulai, $halaman");
						}else{
							$stokpile = mysqli_query($koneksi, "SELECT * FROM stokpile LIMIT $mulai, $halaman");	
						}
					}

					$no = 1;

					if(mysqli_num_rows($stokpile)> 0){
						while($data = mysqli_fetch_array($stokpile)){ ?>
							<tr class="text-center">
								<td><?= $no++; ?></td>
								<td><?php echo $data['kode_lahan'];?></td>
								<td>
									<?php
										$angka = $data['stok'];
										$angka_format = number_format($angka,3,'.','.');
										echo $angka_format; 
									?>	
								</td>
							</tr>
						<?php }
						?>
					<?php
					}else{
						echo "<tr><td colspan=\"10\" align=\"center\"><b style='font-size:18px;'>DATA TIDAK DAPAT DITEMUKAN!</b></td></tr>";
					}?>
			</table>
			</form>
		</div>
		
	</div>

	<br>

<?php
	?>
		<nav aria-label="Page navigation example">
  		<ul class="pagination justify-content-center">

  		<!-- INFO HALAMAN -->
  			 <li class="page-item disabled">
  			 	<a class="page-link" href="#">PAGE <?= $page ?> of <?= $pages ?></a>
  		<!-- LINK AWAL DAN SELANJUTNYA -->
	<?php 
  		if($page == 1){ // Jika page terakhir
      ?>
        <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a>
		<li class="page-item disabled"><a class="page-link" href="#">&lsaquo;</a>
      <?php
      }else{ // Jika Bukan page terakhir
       $link_prev = ($page > 1)? $page - 1 : 1;
      ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?=$link_prev?>">&laquo;</a>
		<li class="page-item"><a class="page-link" href="?halaman=<?=$pages?>">&lsaquo;</a>
      <?php
      }
      ?>
  	
  		<!-- LINK NUMBER -->
  		<?php
  		$jumlah_number 	= 2; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
  		$start_number 	= ($page > $jumlah_number)? $page - $jumlah_number : 1;
		$end_number 	= ($page < ($pages - $jumlah_number))? $page + $jumlah_number : $pages;
      
      	for($i = $start_number; $i <= $end_number; $i++){
      		$link_active = ($page == $i) ? 'class="page-item active"' : ''; ?>
    	<li <?= $link_active ?>><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
		<?php } ?>

		<!-- LINK NEXT AND LAST -->
      <?php
      // Jika page sama dengan jumlah page, maka disable link NEXT nya
      // Artinya page tersebut adalah page terakhir 
      if($page == $pages){ // Jika page terakhir
      ?>
        <li class="page-item disabled"><a class="page-link" href="#">&rsaquo;</a>
		<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a>
      <?php
      }else{ // Jika Bukan page terakhir
        $link_next = ($page < $pages)? $page + 1 : $pages;
      ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?=$link_next?>">&rsaquo;</a>
		<li class="page-item"><a class="page-link" href="?halaman=<?=$pages?>">&raquo;</a>
      <?php
      }
      ?>
  </ul>
</nav>


<?php require('footer-admin.php'); ?>