<?php 
require "../koneksi.php";
require('tgl_indo.php');
	if(isset($_POST['cetak'])){
		$tgl_awal 	= $_REQUEST['tgl_awal'];
		$tgl_akhir 	= $_REQUEST['tgl_akhir'];
		$kode_truk 	= $_REQUEST['kode_truk'];
		$no_transaksi 	= $_REQUEST['no_transaksi'];
		if($kode_truk){
			$result = mysqli_query($koneksi, "SELECT * FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_truk = '$kode_truk'");
			$koko = mysqli_query($koneksi, "SELECT SUM(batubara) AS batubara FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_truk = '$kode_truk'");
		}else if($no_transaksi){
			$result = mysqli_query($koneksi, "SELECT * FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND no_transaksi = '$no_transaksi' ");
			$koko = mysqli_query($koneksi, "SELECT SUM(batubara) AS batubara FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND no_transaksi = '$no_transaksi'");
		}else if($kode_truk AND $no_transaksi){
			$result = mysqli_query($koneksi, "SELECT * FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_truk = '$kode_truk' AND no_transaksi = '$no_transaksi' ");
			$koko = mysqli_query($koneksi, "SELECT SUM(batubara) AS batubara FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_truk = '$kode_truk' AND no_transaksi = '$no_transaksi'");
		}else{
			$result = mysqli_query($koneksi, "SELECT * FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra  WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir'");
			$koko = mysqli_query($koneksi, "SELECT SUM(batubara) AS batubara FROM kirim 
								INNER JOIN stokpile ON kirim.id_stokpile = stokpile.id_stokpile 
								INNER JOIN truk ON kirim.id_truk = truk.id_truk
								INNER JOIN transaksi ON kirim.id_transaksi = transaksi.id_transaksi 
								INNER JOIN mitra ON mitra.id_mitra = transaksi.id_mitra WHERE tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		}
	}
?>
<!DOCTYPE html>
<html lang="id, in">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css.map">
  <link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css.map">
  <link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css.map">

	<title>Cetak Pengiriman Batubara PDF</title>

	<style>
		hr{ border: 4px; border-style: double; width: 82%; }
		.wew{ margin-right: 19%; }
		.wow{ margin-left: 9%; }		
		#kiri{
			width: 50%;
			height: 100px;
			float:left;
			font-weight: normal;
		}
		#kanan{
			width: 50%;
			height: 100px;
			float:right;
			font-weight: normal;
		}
	</style>

</head>
<body>

	<!-- kop kelurahan -->
	<div class="container-fluix"><br>
		<img src="../img/baramarta.png" style="width: 180px" class="float-left wow">
		<p class="text-center wew">
			<font size="4"><b>PEMERINTAH KABUPATEN BANJAR</font>
			<br>
			<font size="6">PERUSAHAAN DAERAH <span style="color:red">BARAMARTA</span></font>
			<br>
			<span style="font-weight: 400;">Kantor Pusat : Komplek Pangeran Antasari No.36 Martapura Kalimantan Selatan - Kode Pos 70614</span>
			<br>
		    <span style="font-weight: 400;">Telp. (0511) 4721019 Fax. (0511) 4722502</span>
		</p>
		<hr>
	</div>
	<!-- akhir kop -->
<br>
<h3 style="text-align: center;">Laporan Pengiriman Batubara Batubara di PD. Baramarta</h3>
<p style="text-align: center; font-weight: 400;">Dari Tanggal : <?php echo tgl_indo($tgl_awal); echo ' hingga '.tgl_indo($tgl_akhir);?></p>
	<!-- container form inputan -->
<div class="container">

  <!-- tabel buat nampilin data -->
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
      	<th style="vertical-align: middle;">NO</th>
        <th style="vertical-align: middle;">Tanggal</th>
        <th style="vertical-align: middle;">No Surat Kirim</th>
        <th style="vertical-align: middle;">Truk</th>
        <th style="vertical-align: middle;">Lahan</th>
        <th style="vertical-align: middle;">No. Transaksi</th>
        <th style="vertical-align: middle;">Nama Mitra</th>
        <th style="vertical-align: middle;">Lokasi</th>
        <th style="vertical-align: middle;">Batu Bara (T)</th>
      </tr>
    </thead>


<?php 
$i = 1;
while( $data = mysqli_fetch_array($result) ) :
 ?>
    
<tr class="text-center">
  <td><?php echo $i;?></td>
  <td><?php $tgl = $data['tanggal_kirim']; echo tgl_indo($tgl); ?></td>
	<td><?= $data['nosurat'] ?></td>
	<td><?= $data['kode_truk'] ?></td>
	<td><?= $data['kode_lahan'] ?></td>
	<td><?= $data['no_transaksi'] ?></td>
	<td><?= $data['nama_cv'] ?></td>
	<td><?= $data['lokasi'] ?></td>
	<td><?php $volume = $data['batubara'];	
		$angka_format = number_format($volume,3,'.','.'); echo $angka_format;  ?>	
	</td>
    </tr>
<?php $i++; ?>
<?php endwhile; ?>
	<tr class="text-center" style="font-weight: bold;">
		<td colspan="8">Total Tonase</td>
		<?php 
			while ($koki = mysqli_fetch_array($koko)) { ?>
				<td><?php $total = $koki['batubara']; $angka_format = number_format($total,3,'.','.'); echo $angka_format;  ?></td>
			<?php }
		?>
	</tr>
  </table>
<!-- akhir table -->
</div>
<br><br><br>
<div class="container text-center">
	<div id="kiri">
		Yang Mengetahui,<br><br><br>
		Bambang Purnawirawan <br>
		Staf Produksi & Pengawas Tambang
	</div>
	<div id="kanan">
		Yang Menyetujui,<br><br><br>
		Slamet Santoso, SP. <br>
		Plt. Direktur Operasional
	</div>
</div>

 	<script type="text/javascript">
	window.print();
</script> 
	
</body>
</html>