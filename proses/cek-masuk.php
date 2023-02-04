<?php
session_start();
$_SESSION['sesi'] = NULL;

include "koneksi.php";
  if (isset($_POST['submit'])){
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
    $sandi = isset($_POST['sandi']) ? $_POST['sandi'] : "";
    if (isset($_POST['cek_admin'])){      
      $qry = mysqli_query($conn,"SELECT * FROM admin WHERE nama_adm = '$nama' AND sandi_adm = '$sandi'");
      $sesi = mysqli_num_rows($qry);
      if ($sesi == 1){
        $data_admin	= mysqli_fetch_array($qry);
        $_SESSION['id_adm'] = $data_admin['id_adm'];
        $_SESSION['sesi'] = $data_admin['nama_adm'];            
        echo "<script>alert('Anda berhasil Log In');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../halaman/beranda.php'>";
      } else {
        echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
        echo "<script>alert('Nama dan/atau Sandi salah');</script>";
      }
    } else {
      // Pengguna			
      $qry = mysqli_query($conn,"SELECT * FROM pengguna WHERE nama_pengguna = '$nama' AND sandi_pengguna = '$sandi'");
      $sesi = mysqli_num_rows($qry);
      if ($sesi == 1){
        $data_admin	= mysqli_fetch_array($qry);
        $_SESSION['id_pengguna'] = $data_admin['id_pengguna'];
        $_SESSION['sesi'] = $data_admin['nama_pengguna'];            
        // echo "<script>alert('Anda berhasil Log In');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../halaman/beranda.php'>";
      } else {
        echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
        echo "<script>alert('Nama dan/atau Sandi salah');</script>";
      }
    }  
  } else header('location:../index.php');    
?>
