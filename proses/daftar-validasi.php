<?php
include "koneksi.php";
$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
$sandi = isset($_POST['sandi']) ? $_POST['sandi'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$aktivasi = isset($_POST['kode_aktivasi']) ? $_POST['kode_aktivasi'] : "";
$kode_benar = isset($_POST['kode_benar']) ? $_POST['kode_benar'] : "";

function aktivasi_sama($p_aktivasi){
	include "koneksi.php";
	$sama = false;
	$qry_2 = "SELECT * FROM admin JOIN aktivasi ON (admin.id_aktivasi_adm = aktivasi.id_aktivasi);";
	$query_2 = mysqli_query($conn,$qry_2);	
	while ($db_admin = mysqli_fetch_assoc($query_2)){
		$kode_admin = $db_admin['kode_aktivasi'];
		if ($p_aktivasi == $kode_admin) $sama = true;
	}	
	return $sama;
}

function aktivasi_ada($p_aktivasi){
	include "koneksi.php";
	$kode = false;
	$qry = "SELECT * FROM aktivasi";
	$query = mysqli_query($conn,$qry);
	while ($db_aktivasi = mysqli_fetch_assoc($query)){				
		$kode_aktivasi = $db_aktivasi['kode_aktivasi'];	
		if ($p_aktivasi == $kode_aktivasi) $kode = true;
	}	
	return $kode;
}

function getId_aktivasi($p_aktivasi){
	include "koneksi.php";
	$id = "";
	$qry = "SELECT * FROM aktivasi";
	$query = mysqli_query($conn,$qry);
	while ($db_aktivasi = mysqli_fetch_assoc($query)){				
		$kode_aktivasi = $db_aktivasi['kode_aktivasi'];	
		if ($p_aktivasi == $kode_aktivasi) $id = $db_aktivasi['id_aktivasi'];
	}
	return $id;
}

//------------------------------------------- Form Daftar --------------------------------------------//
if (isset($_POST['btn_daftar'])) {
	echo "masuk btn-daftar";
	if ($nama == "") echo "<meta http-equiv='refresh' content='0; url=../halaman/daftar.php?nama=kosong&email=$email&aktivasi=$aktivasi'>";
	else if ($sandi == "") echo "<meta http-equiv='refresh' content='0; url=../halaman/daftar.php?sandi=kosong&nama=$nama&email=$email&aktivasi=$aktivasi'>";
	else if ($email == "") echo "<meta http-equiv='refresh' content='0; url=../halaman/daftar.php?email=kosong&nama=$nama&aktivasi=$aktivasi'>";
	else {
		if (isset($_POST['cek_box_admin'])) {	
			echo "Masuk Admin";
			$lolos_validasi = true;
			// Daftar Admin
			if ($kode_benar != "benar") {
				header("location:../halaman/daftar.php?aktivasi=cek-dahulu&nama=$nama&email=$email&cek_box=ya");	
				$lolos_validasi = false;
			} else {
				// Pengecekan duplikasi nama / email
				$qry = "SELECT * FROM admin";
				$query = mysqli_query($conn,$qry);
				while ($db_admin = mysqli_fetch_assoc($query)){				
					$nama_adm = $db_admin['nama_adm'];
					$email_adm = $db_admin['email_adm'];
					if ($nama == $nama_adm){
						header("location:../halaman/daftar.php?nama=sama&email=$email&aktivasi=$aktivasi");
						$lolos_validasi = false;
					} else if ($email == $email_adm) {
						header("location:../halaman/daftar.php?email=sama&nama=$nama&aktivasi=$aktivasi");
						$lolos_validasi = false;
					} 
				}
			}

			// Masukan ke Basis Data
			if ($lolos_validasi) {
				$id = getId_aktivasi($aktivasi);
				$sql =  "INSERT INTO admin VALUES ('','$nama','$sandi','$email','$id')";
				mysqli_query($conn, $sql);
				echo "<script>alert('Daftar Berhasil');</script>";
				echo "<meta http-equiv='refresh' content='0; url=../halaman/beranda.php'>";
			}
			
		} else {		
			// Daftar Pengguna
			$lolos_validasi = true;
			$qry = "SELECT * FROM pengguna";
			$query = mysqli_query($conn,$qry);
			while ($db_pengguna = mysqli_fetch_assoc($query)){
				$nama_pengguna = $db_pengguna['nama_pengguna'];
				$email_pengguna = $db_pengguna['email_pengguna'];
				// Cek duplikat
				if ($nama == $nama_pengguna) {
					header("location:../halaman/daftar.php?nama=sama&email=$email");
					$lolos_validasi = false;
				} 
				
				else if ($email == $email_pengguna) {
					header("location:../halaman/daftar.php?email=sama&nama=$nama");
					$lolos_validasi = false;
				} 
			}
			
			// Masukan ke Basis Data			 
			if ($lolos_validasi){
				$sql =  "INSERT INTO pengguna VALUES 
          	('','$nama','$sandi','$email')";
  			mysqli_query($conn, $sql); 
				echo "<script>alert('Daftar Berhasil');</script>";
				echo "<meta http-equiv='refresh' content='0; url=../halaman/beranda.php'>";
			}
		}
	}
}

//------------------------------------------- Form Cek Aktivasi --------------------------------------------//
if (isset($_POST['btn_aktivasi'])) { 
	$kode_sama = aktivasi_sama($aktivasi);
	$kode_ada = aktivasi_ada($aktivasi);
	$semua = "&nama=".$nama."&email=".$email;
	if ($aktivasi == "") header("location:../halaman/daftar.php?aktivasi=kosong$semua&cek_box=ya");	
	else if ($kode_sama) header("location:../halaman/daftar.php?aktivasi=sama$semua&cek_box=ya");
	else if (!$kode_ada) header("location:../halaman/daftar.php?aktivasi=salah$semua&cek_box=ya");
	else header("location:../halaman/daftar.php?status=benar$semua&cek_box=ya&aktivasi=$aktivasi");
}
/* Algoritma
	---->	Admin
	1. Daftar admin tidak akan dijalankan sebelum mendapatkan ceklis pada kode aktivasi
	2. Pengecekan kode aktivasi. Input :
	   a. kosong?
	   b. sudah dipakai admin lain ?
	   c. kode sesuai dengan data di db aktivasi?
	3. Jika benar semua, ceklis kode diberikan
	4. Form daftar admin menerima ceklis kode, lanjutkan
	5. Cek nama dan email. Input : kosong?, sudah dipakai?
	6. Simpan nama, sandi, email, kode-aktivasi

	----> Pengguna
	1. Cek nama dan email. Input : kosong?, sudah dipakai?
	2. Simpan nama, sandi, email, kode-aktivasi
*/
?>