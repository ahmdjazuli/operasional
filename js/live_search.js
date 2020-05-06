// ambil elemen" yg dibutuhkan

var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var badanLiveSearch = document.getElementById('badan-livesearch');

keyword.addEventListener('keyup', function(){
	// buat objek ajax
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			badanLiveSearch.innerHTML = xhr.responseText;
		}
	}

	xhr.open('GET', '../livesearch/rekap_jual.php?keyword=' + keyword.value,true);
	xhr.send();
});