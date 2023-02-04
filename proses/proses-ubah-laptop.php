<?php
include "koneksi.php";
$kosong = "kosong";
$nol = 0;
$nama_laptop = !empty($_POST['nama_laptop']) ? $_POST['nama_laptop'] : $kosong;
$nama_prosesor = !empty($_POST['nama_prosesor']) ? test_input($_POST['nama_prosesor']) : $kosong;
$deskripsi = !empty($_POST['deskripsi']) ? test_input($_POST['deskripsi']) : ""; // boleh kosong
$resolusi = !empty($_POST['resolusi']) ? test_input($_POST['resolusi']) : $nol;
$prosesor_min = !empty($_POST['prosesor_min']) ? test_input($_POST['prosesor_min']) : $nol;
$prosesor_max = !empty($_POST['prosesor_max']) ? test_input($_POST['prosesor_max']) : $nol;
$ram = !empty($_POST['ram']) ? test_input($_POST['ram']) : $nol;
$penyimpanan = !empty($_POST['penyimpanan']) ? test_input($_POST['penyimpanan']) : $nol;
$baterai = !empty($_POST['baterai']) ? test_input($_POST['baterai']) : $nol;
$harga = !empty($_POST['harga']) ? test_input($_POST['harga']) : $nol;
$id_laptop = $_POST['id'];
$akun = "ADM";
$tgl = getdate();
$sekarang = $tgl['year']."-".$tgl['mon']."-".$tgl['mday'];

$nama_file   = $_FILES['gambar']['name'];
if(!empty($nama_file)){
  // Baca lokasi file sementara dan nama file dari form (fupload)
  $lokasi_file = $_FILES['gambar']['tmp_name'];
  $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
  $file_foto = $id_laptop.".".$tipe_file;

  // Tentukan folder untuk menyimpan file
  $folder = "../images/db/$file_foto";
  // Apabila file berhasil di upload
  move_uploaded_file($lokasi_file,"$folder");
} else $file_foto="-";

mysqli_query($conn,
		"UPDATE laptop
		SET dibuat_oleh='$akun',
        gambar_laptop='$file_foto',
        nama_laptop='$nama_laptop',
        nama_prosesor='$nama_prosesor',
        deskripsi_tambahan='$deskripsi',
        tgl_pendataan='$sekarang',
        resolusi='$resolusi',
        prosesor_min='$prosesor_min',
        prosesor_maks='$prosesor_max',
        ram='$ram',
        penyimpanan='$penyimpanan',
        baterai='$baterai',
        harga='$harga'
		WHERE id_laptop='$id_laptop'");
header("location:../halaman/edit-laptop.php");

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function data_akhir(){
  include "../proses/koneksi.php";	
  $id="";
  $qry = "SELECT id_laptop FROM laptop ORDER BY id_laptop DESC LIMIT 1";
  $query = mysqli_query($conn,$qry);
  if ($db_laptop = mysqli_fetch_assoc($query)){    
    $id = $db_laptop['id_laptop'];
  }
  $id++;  	
  return $id;
}
?>