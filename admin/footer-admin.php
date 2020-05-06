	<script src="../js/jquery.js"></script>
	<script src="../bootstrap4/dist/js/jquery-3.3.1.slim.min.js"></script>
	<script src="../bootstrap4/dist/js/popper.min.js"></script>
	<script src="../bootstrap4/dist/js/bootstrap.min.js"></script>
	<script src="../bootstrap4/dist/js/bootstrap.bundle.min.js"></script>

	<script src="../js/sweetalert.min.js"></script>
	<script src="../js/sweetalert2.all.min.js"></script>

	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});

		$(document).ready(function(){
			$('#select_all1').on('click',function(){
				if(this.checked){
					$('.check1').each(function(){
						this.checked = true;
					})
				}else{
					$('.check1').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.check1').on('click', function(){
			if($('.check1:checked1').length == $('.check1').length){
				$('#select_all1').prop('checked1', true)
			}else{
				$('#select_all1').prop('checked1', false)
			}
		});

		// stokpile
		$(document).ready(function(){
			$('#stokpile_select').on('click',function(){
				if(this.checked){
					$('.stokpile_cek').each(function(){
						this.checked = true;
					})
				}else{
					$('.stokpile_cek').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.stokpile_cek').on('click', function(){
			if($('.stokpile_cek:checked').length == $('.stokpile_cek').length){
				$('#stokpile_select').prop('checked', true)
			}else{
				$('#stokpile_select').prop('checked', false)
			}
		});

		function stokpile_hapus(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.stokpile_proses.action = 'stokpile_delete.php';
					document.stokpile_proses.submit();
				}
			})
		}

		// transaksi
		$(document).ready(function(){
			$('#transaksi_select').on('click',function(){
				if(this.checked){
					$('.transaksi_cek').each(function(){
						this.checked = true;
					})
				}else{
					$('.transaksi_cek').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.transaksi_cek').on('click', function(){
			if($('.transaksi_cek:checked').length == $('.transaksi_cek').length){
				$('#transaksi_select').prop('checked', true)
			}else{
				$('#transaksi_select').prop('checked', false)
			}
		});

		function transaksi_edit(){
			document.transaksi_proses.action = 'transaksi_edit.php';
			document.transaksi_proses.submit();
		}

		function transaksi_hapus(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.transaksi_proses.action = 'transaksi_delete.php';
					document.transaksi_proses.submit();
				}
			})
		}

		// KIRIM
		$(document).ready(function(){
			$('#select_kirim').on('click',function(){
				if(this.checked){
					$('.kirim_cek').each(function(){
						this.checked = true;
					})
				}else{
					$('.kirim_cek').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.kirim_cek').on('click', function(){
			if($('.kirim_cek:checked').length == $('.kirim_cek').length){
				$('#select_kirim').prop('checked', true)
			}else{
				$('#select_kirim').prop('checked', false)
			}
		});

		function kirim_edit(){
			document.kirim_proses.action = 'kirim_edit.php';
			document.kirim_proses.submit();
		}

		function kirim_hapus(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.kirim_proses.action = 'kirim_delete.php';
					document.kirim_proses.submit();
				}
			})
		}

		// Mitra 
		$(document).ready(function(){
			$('#mitra_select').on('click',function(){
				if(this.checked){
					$('.mitra_check').each(function(){
						this.checked = true;
					})
				}else{
					$('.mitra_check').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.mitra_check').on('click', function(){
			if($('.mitra_check:checked').length == $('.mitra_check').length){
				$('#mitra_select').prop('checked', true)
			}else{
				$('#mitra_select').prop('checked', false)
			}
		});

		function hapus_mitra(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.mitra_proses.action = 'mitra_delete.php';
					document.mitra_proses.submit();
				}
			})
		}

		function edit_mitra(){
			document.mitra_proses.action = 'mitra_edit.php';
			document.mitra_proses.submit();
		}

		// Truk 
		$(document).ready(function(){
			$('#truk_select').on('click',function(){
				if(this.checked){
					$('.truk_check').each(function(){
						this.checked = true;
					})
				}else{
					$('.truk_check').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.truk_check').on('click', function(){
			if($('.truk_check:checked').length == $('.truk_check').length){
				$('#truk_select').prop('checked', true)
			}else{
				$('#truk_select').prop('checked', false)
			}
		});

		function hapus_truk(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.truk_proses.action = 'truk_delete.php';
					document.truk_proses.submit();
				}
			})
		}

		function edit_truk(){
			document.truk_proses.action = 'truk_edit.php';
			document.truk_proses.submit();
		}

		// Produksi 
		$(document).ready(function(){
			$('#produksi_select').on('click',function(){
				if(this.checked){
					$('.produksi_cek').each(function(){
						this.checked = true;
					})
				}else{
					$('.produksi_cek').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.produksi_cek').on('click', function(){
			if($('.produksi_cek:checked').length == $('.produksi_cek').length){
				$('#produksi_select').prop('checked', true)
			}else{
				$('#produksi_select').prop('checked', false)
			}
		});

		function hapus_produksi(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.produksi_proses.action = 'produksi_delete.php';
					document.produksi_proses.submit();
				}
			})
		}

		function edit_produksi(){
			document.produksi_proses.action = 'produksi_edit.php';
			document.produksi_proses.submit();
		}
		
		// Kontrak 
		$(document).ready(function(){
			$('#kontrak_select').on('click',function(){
				if(this.checked){
					$('.kontrak_check').each(function(){
						this.checked = true;
					})
				}else{
					$('.kontrak_check').each(function(){
						this.checked = false;
					})
				}
			})
		});

		$('.kontrak_check').on('click', function(){
			if($('.kontrak_check:checked').length == $('.kontrak_check').length){
				$('#kontrak_select').prop('checked', true)
			}else{
				$('#kontrak_select').prop('checked', false)
			}
		});

		function hapus_kontrak(){
			Swal.fire({
				title: 'Kamu yakin?',
				text: "Data akan dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, aku hapus!',
				cancelButtonText: 'Gak jadi!'
			}).then((result) => {
				if (result.value) {
					document.kontrak_proses.action = 'kontrak_delete.php';
					document.kontrak_proses.submit();
				}
			})
		}

		function edit_kontrak(){
			document.kontrak_proses.action = 'kontrak_edit.php';
			document.kontrak_proses.submit();
		}
	</script>
</body>
</html>