<?php
require "koneksi.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='../img/baramarta.png' rel='icon' type='image/x-icon'/>
  <title>Sistem Informasi Operasional Pertambangan di Kantor PD. Baramarta Martapura</title>
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css.map">
  <link rel="stylesheet" href="css/style-index.css">
</head>
<body>
<div id="formWrapper">

	<?php
?> <script src="js/sweetalert2.all.min.js"></script> <?php
if ($_GET['m'] == "gagal") {?>
					<script type="text/javascript">
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							text: 'Username/Password Tidak Sesuai!',
						})
					</script>
			<?php }
?>

<div id="form">
<div class="logo">
	<a href="/operasional/"><img src="img/baramarta.png" max-width="200px"></a>
</div>
		<div class="row">
				<div class="col">
					<form action="cek_login.php" method="post">
						<div class="row" style="margin: 0 auto;">
							<div class="input-group input-group-mb" style="max-width: 300px; margin:0 auto;">
								<div class="input-group-prepend">
									<span class="input-group-text"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#000000" d="M12,3A4,4 0 0,1 16,7A4,4 0 0,1 12,11A4,4 0 0,1 8,7A4,4 0 0,1 12,3M16,13.54C16,14.6 15.72,17.07 13.81,19.83L13,15L13.94,13.12C13.32,13.05 12.67,13 12,13C11.33,13 10.68,13.05 10.06,13.12L11,15L10.19,19.83C8.28,17.07 8,14.6 8,13.54C5.61,14.24 4,15.5 4,17V21H10L11.09,21H12.91L14,21H20V17C20,15.5 18.4,14.24 16,13.54Z" /></svg></span>
								</div>
								<input type="text" name="username" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"  placeholder="username" required autocomplete="off">
							</div>
						</div>
						<div class="row" style="margin: 0 auto; margin-top: 10px;">
							<div class="input-group input-group-mb" style="max-width: 300px; margin:0 auto;">
								<div class="input-group-prepend">
									<span class="input-group-text"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#000000" d="M7,14A2,2 0 0,1 5,12A2,2 0 0,1 7,10A2,2 0 0,1 9,12A2,2 0 0,1 7,14M12.65,10C11.83,7.67 9.61,6 7,6A6,6 0 0,0 1,12A6,6 0 0,0 7,18C9.61,18 11.83,16.33 12.65,14H17V18H21V14H23V10H12.65Z" /></svg></span>
								</div>
								<input type="password" name="password" class="form-control" aria-label="Default"  aria-describedby="inputGroup-sizing-default" placeholder="password" autocomplete="off" required>
							</div>
						</div>
						<div class="text-center">
						<input style="margin-top: 10px;" type="submit" class="btn btn-dark btn-md" value="MASUK">
						</div>
					</form>
				</div>
			</div>
</div>
</div>
</body>

<!-- script awal -->
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
	var formInputs = $('input[type="text"],input[type="password"]');
	formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
       $('div#formWrapper').addClass('darken-bg');
       $('div.logo').addClass('logo-active');
       $('div.logo').removeClass('logo');
	});
	formInputs.focusout(function() {
		if ($.trim($(this).val()).length == 0){
		$(this).parent().children('p.formLabel').removeClass('formTop');
		}
		$('div#formWrapper').removeClass('darken-bg');
		$('div.logo-active').addClass('logo');
		$('div.logo').removeClass('logo-active');

	});
	$('p.formLabel').click(function(){
		 $(this).parent().children('.form-style').focus();
	});
});
</script>
<!-- script akhir -->
</html>