<?php 
require "../koneksi.php";
require('tgl_indo.php');

	if(isset($_POST['cetak'])){
		$tgl_awal 	= $_REQUEST['tgl_awal'];
		$tgl_akhir 	= $_REQUEST['tgl_akhir'];
		$status 	= $_REQUEST['status'];
		if($_REQUEST['status']==0){
			$result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND target>0 ");
		}else if($_REQUEST['status']==1){
			$result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND target<1");
		}else if($_REQUEST['status']==2){
			$result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		}
	}else{
		$result = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN mitra ON transaksi.id_mitra = mitra.id_mitra");
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

	<title>Cetak Transaksi PDF</title>

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
<h3 style="text-align: center;">Laporan Transaksi Batubara di PD. Baramarta</h3>
<p style="text-align: center; font-weight: 400;">Dari Tanggal : <?php echo tgl_indo($tgl_awal); echo ' hingga '.tgl_indo($tgl_akhir); ?></p>
<br>
	<!-- container form inputan -->
<div class="container">

  <!-- tabel buat nampilin data -->
  <table class="table table-bordered table-sm" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
      	<th style="vertical-align: middle;">NO</th>
      	<th style="vertical-align: middle;">No. Transaksi</th>
        <th style="vertical-align: middle;">Nama Mitra</th>
        <th style="vertical-align: middle;">Tanggal</th>
        <th style="vertical-align: middle;">Surveyor</th>
        <th style="vertical-align: middle;">Tonase (T)</th>
        <th style="vertical-align: middle;">Harga (Rp)</th>
      </tr>
    </thead>


<?php 
$i = 1;
while( $data = mysqli_fetch_array($result) ) :
 ?>
    
<tr class="text-center">
  <td><?php echo $i;?></td>
  <td><?= $data['no_transaksi'] ?></td>
  <td><?= $data['nama_cv'] ?></td>
  <td><?php $tgl = $data['tanggal']; echo tgl_indo($tgl); ?></td>
  <td><?= $data['surveyor'] ?></td>
  <td><?php 
	  	$angka = $data['tonase'];
	  	$angka_format = number_format($angka,0,',','.');
	  	echo $angka_format; ?>
  </td>
  <td><?php 
  	$angka = $data['harga'];
  	$angka_format = number_format($angka,0,',','.');
	echo $angka_format;  ?>	
  </td>
    </tr>
<?php $i++; ?>
<?php endwhile; ?>

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