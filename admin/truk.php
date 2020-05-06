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
		<form action="truk" method="POST">
			<h2 style="display: flex; float: left;">TRUK</h2> 
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

		<div id="filterTruk" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CETAK PDF DATA TRUK</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form target="_blank" action="cetakTrukPDF.php" method="post">
              <div class="form-group">
                <label for="">Status Truk</label>
                <select name="nama_cv" class="form-control">
						<option value="">Semua</option>
						<option value="PD. Baramarta">PD. Baramarta</option>
						<option value="kontrak">Kontrak</option>
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
			<form name="truk_proses" method="POST">
			<div class="form-group">
			<button type="button" data-toggle="tooltip" data-placement="top" title="Cetak" class="btn btn-info"><a href="#" data-toggle="modal" data-target="#filterTruk"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z" /></svg></a></button>
			<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah"><a id="log" href="truk_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>

			<div style="display: inline; float: right;">
				<button type="button" onclick="edit_truk()" data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-warning"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z" /></svg></a></button>
				<button type="button" onclick="hapus_truk()" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M20.37,8.91L19.37,10.64L7.24,3.64L8.24,1.91L11.28,3.66L12.64,3.29L16.97,5.79L17.34,7.16L20.37,8.91M6,19V7H11.07L18,11V19A2,2 0 0,1 16,21H8A2,2 0 0,1 6,19Z" /></svg></a></button>
			</div>
		</div>
			<table class="table table-hover table-bordered table-sm">
				<thead class="thead-dark">
				<tr class="text-center">
					<th>No</th>
					<th>Kode Truk <a id="log" href="truk_kode_truk_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>" /></svg></a></th>
					<th>Merk <a id="log" href="truk_merk_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>"/></svg></a></th>
					<th>Daya Angkut (ton) <a id="log" href="truk_daya_angkut_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>" /></svg></a></th>
					<th>No. Polisi <a id="log" href="truk_nopolisi_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>" /></svg></a></th>
					<th>Pemilik <a id="log" href="truk_nama_cv_<?=$polabaru;?>"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="<?= $kodesvg ?>" /></svg></a></th>
					<th><input type="checkbox" id="truk_select"></th>
				</tr>
				<?php
					$halaman 	  = 7; //batasan halaman
					$page    	  = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
					$mulai        = ($page>1) ? ($page * $halaman) - $halaman : 0;
					$sql     	  = mysqli_query($koneksi, 'SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra');
					$total        = mysqli_num_rows($sql);
					$pages   	  = ceil($total/$halaman);
					$previous	  = $page - 1;
					$next		  = $page + 1;

					if(isset($_POST['cari'])){
						$cari = $_POST['cari'];
						$truk = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE kode_truk LIKE '%".$cari."%' OR merk LIKE '%".$cari."%' OR nopolisi LIKE '%".$cari."%' OR nama_cv LIKE '%".$cari."%' OR daya_angkut LIKE '%".$cari."%' ");
					}else{
						if(isset($_GET['urut'])){
							$truk = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra ORDER BY $orderby $polabaru LIMIT $mulai, $halaman");
						}else{
							$truk = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra ORDER BY kode_truk ASC LIMIT $mulai, $halaman");	
						}
					}

					$no = 1;

					if(mysqli_num_rows($truk)> 0){
						while( $data = mysqli_fetch_array($truk) ){ ?>
							<tr class="text-center">
								<td><?= $no++; ?></td>
								<td><?= $data['kode_truk'] ?></td>
								<td><?= $data['merk'] ?></td>
								<td><?= $data['daya_angkut'] ?></td>
								<td><?= $data['nopolisi'] ?></td>
								<td><?= $data['nama_cv'] ?></td>
								<td>
									<input type="checkbox" name="checked[]" class="truk_check" value="<?= $data['id_truk'] ?>">
								</td>
							</tr>
						<?php }
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