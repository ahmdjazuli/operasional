<style>
  body {
  background: url("../img/background.jpg")
    no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family: "HelveticaNeue", "Arial", sans-serif;
}

.card-body:hover{
  filter: invert(1);
}
</style>

<?php 
  session_start(); 
  require_once('header-admin.php');
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }

  $produksi = mysqli_query($koneksi, "SELECT * FROM produksi");
  $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
  $kontrak = mysqli_query($koneksi, "SELECT * FROM kontrak");
  $truk = mysqli_query($koneksi, "SELECT * FROM truk");
  $pengiriman = mysqli_query($koneksi, "SELECT * FROM kirim");

  $data = mysqli_num_rows($produksi);
  $data1 = mysqli_num_rows($transaksi);
  $data2 = mysqli_num_rows($pengiriman);
  $data3 = mysqli_num_rows($truk);
  $data4 = mysqli_num_rows($kontrak);
?>

<div class="container">
  <div class="text-center">
    <img src="../img/baramarta.png" style="width: 210px; filter: drop-shadow(3px 4px 3px black)">
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>


<div class="container">
  <div class="row">

  <div class="col-sm">
    <a href="truk" target="_blank" style="text-decoration: none;">
  <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M20,8H19L17,8H15V14H2V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M17,12V9.5H19.5L21.46,12H17M18,7H14V13H3L1.57,8H1V6H13L14,5H18V7Z" /></svg>
    <h1 class="card-title" style="display: inline;"><?= $data3 ?></h1>
    <p class="card-text">Truk Angkutan</p>
  </div>
</div>
  </a>
</div>

  <div class="col-sm">
    <a href="kontrak" target="_blank" style="text-decoration: none;">
  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M6,2C4.89,2 4,2.89 4,4V20A2,2 0 0,0 6,22H10V20.09L12.09,18H6V16H14.09L16.09,14H6V12H18.09L20,10.09V8L14,2H6M13,3.5L18.5,9H13V3.5M20.15,13C20,13 19.86,13.05 19.75,13.16L18.73,14.18L20.82,16.26L21.84,15.25C22.05,15.03 22.05,14.67 21.84,14.46L20.54,13.16C20.43,13.05 20.29,13 20.15,13M18.14,14.77L12,20.92V23H14.08L20.23,16.85L18.14,14.77Z" /></svg>
    <h1 class="card-title" style="display: inline;"><?= $data4 ?></h1>
    <p class="card-text">Kontrak</p>
  </div>
</div>
</a>
</div>
  
  <div class="col-sm">
    <a href="produksi" target="_blank" style="text-decoration: none;">
  <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M4,5C2.89,5 2,5.89 2,7V17C2,18.11 2.89,19 4,19H20C21.11,19 22,18.11 22,17V7C22,5.89 21.11,5 20,5H4M4.5,7A1,1 0 0,1 5.5,8A1,1 0 0,1 4.5,9A1,1 0 0,1 3.5,8A1,1 0 0,1 4.5,7M7,7H20V17H7V7M8,8V16H11V8H8M12,8V16H15V8H12M16,8V16H19V8H16M9,9H10V10H9V9M13,9H14V10H13V9M17,9H18V10H17V9Z" /></svg>
    <h1 class="card-title" style="display: inline;"><?= $data ?></h1>
    <p class="card-text">Produksi</p>
  </div>
</div>
</a>
</div>

<div class="col-sm">
  <a href="transaksi" target="_blank" style="text-decoration: none;">
  <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M9,20A2,2 0 0,1 7,22A2,2 0 0,1 5,20A2,2 0 0,1 7,18A2,2 0 0,1 9,20M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18M7.2,14.63C7.19,14.67 7.19,14.71 7.2,14.75A0.25,0.25 0 0,0 7.45,15H19V17H7A2,2 0 0,1 5,15C5,14.65 5.07,14.31 5.24,14L6.6,11.59L3,4H1V2H4.27L5.21,4H20A1,1 0 0,1 21,5C21,5.17 20.95,5.34 20.88,5.5L17.3,12C16.94,12.62 16.27,13 15.55,13H8.1L7.2,14.63M9,9.5H13V11.5L16,8.5L13,5.5V7.5H9V9.5Z" /></svg>
    <h1 class="card-title" style="display: inline;"><?= $data1 ?></h1>
    <p class="card-text">Transaksi</p>
  </div>
</div>
</a>
</div>

<div class="col-sm">
  <a href="pengiriman" target="_blank" style="text-decoration: none;">
  <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M4,5C2.89,5 2,5.89 2,7V17C2,18.11 2.89,19 4,19H20C21.11,19 22,18.11 22,17V7C22,5.89 21.11,5 20,5H4M4.5,7A1,1 0 0,1 5.5,8A1,1 0 0,1 4.5,9A1,1 0 0,1 3.5,8A1,1 0 0,1 4.5,7M7,7H20V17H7V7M8,8V16H11V8H8M12,8V16H15V8H12M16,8V16H19V8H16M9,9H10V10H9V9M13,9H14V10H13V9M17,9H18V10H17V9Z" /></svg>
    <h1 class="card-title" style="display: inline;"><?= $data2 ?></h1>
    <p class="card-text">Pengiriman</p>
  </div>
</div>
</a>
</div>

</div> <!-- row -->

</div> <!-- penutup kontainer -->

<!-- coba coba -->

<script src="../js/jquery.js"></script>
<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>

<?php 
  require_once("footer-admin.php");
?>