<?php 
require "../koneksi.php";
	if(isset($_POST['cetak'])){
		if($_REQUEST['nama_cv'] == 'kontrak'){
			$result = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE nama_cv IN (SELECT nama_cv FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra)
							 ORDER BY kode_truk ASC");
		}else if($_REQUEST['nama_cv'] == 'PD. Baramarta'){
			$result = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE nama_cv = 'PD. Baramarta' ORDER BY nama_cv ASC ");
		}else{
			$result = mysqli_query($koneksi, "SELECT * FROM truk INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE nama_cv = 'PD. Baramarta' OR nama_cv IN (SELECT nama_cv FROM kontrak INNER JOIN mitra ON kontrak.id_mitra = mitra.id_mitra)
							 ORDER BY kode_truk ASC");
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

	<title>Cetak Truk PDF</title>

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
<h3 style="text-align: center;">Laporan Truk Angkut Operasional Batu Bara</h3>
<br>
	<!-- container form inputan -->
<div class="container">

  <!-- tabel buat nampilin data -->
  <table class="table table-bordered table-sm" border="1px" style="font-weight: 400;">
    <thead class="text-center">
      <tr>
      	<th style="vertical-align: middle;">NO</th>
        <th style="vertical-align: middle;">Kode Truk</th>
        <th style="vertical-align: middle;">Merk</th>
        <th style="vertical-align: middle;">Daya Angkut (T)</th>
        <th style="vertical-align: middle;">No. Polisi</th>
        <th style="vertical-align: middle;">Pemilik</th>
      </tr>
    </thead>


<?php 
$i = 1;
while( $data = mysqli_fetch_array($result) ) :
 ?>
    
<tr class="text-center">
  <td><?php echo $i;?></td>
  <td><?= $data['kode_truk'] ?></td>
  <td><?= $data['merk'] ?></td>
  <td><?= $data['daya_angkut'] ?></td>
  <td><?= $data['nopolisi'] ?></td>
  <td><?= $data['nama_cv'] ?></td>
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