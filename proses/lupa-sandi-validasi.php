<?php 
include "koneksi.php";
$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
$box_admin = isset($_POST['box_admin']) ? "ya" : "tdk";
// $box_admin = !empty($_POST['box_admin']) ? "ya" : "tdk";
$lolos_validasi = false;
$email = isset($_POST['email']) ? $_POST['email'] : "";
$nama_benar = isset($_POST['nama_benar']) ? $_POST['nama_benar'] : "";
$email_benar = isset($_POST['email_benar']) ? $_POST['email_benar'] : "";
$sandi_baru = isset($_POST['sandi_baru']) ? $_POST['sandi_baru'] : "";
echo $box_admin;

// Tombol Atur Sandi
if (isset($_POST['btn_simpan'])){
  $sql = "UPDATE admin SET sandi_adm='$sandi_baru' WHERE nama_adm = '$nama_benar';";
	mysqli_query($conn, $sql);
  echo "<script>alert('Sandi Berhasil Diubah');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
}

// Tombol Email
else if (isset($_POST['btn_cek_email'])){
  if (isset($_POST['box_admin'])){
    if ($email == "") header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=kosong&box=ya");
    else {
      $qry = "SELECT * FROM admin";
      $query = mysqli_query($conn,$qry);
      while ($db_admin = mysqli_fetch_assoc($query)){				
        $email_adm = $db_admin['email_adm'];
        if ($email == $email_adm) $lolos_validasi = true;        
      }      
      if (!$lolos_validasi) header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=salah&box=ya");
      else header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=$email&box=ya");
    }
  } else {
    if ($email == "") header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=kosong&box=tdk");
    else {
      $qry = "SELECT * FROM pengguna";
      $query = mysqli_query($conn,$qry);
      while ($db_pengguna = mysqli_fetch_assoc($query)){				
        $email_pgn = $db_pengguna['email_pengguna'];
        if ($email == $email_pgn) $lolos_validasi = true;        
      }      
      if (!$lolos_validasi) header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=salah&box=tdk");
      else header("location:../halaman/lupa-sandi.php?nama=$nama_benar&email=$email&box=tdk");
    }
  }  
}

// Tombol Batal
else if (isset($_POST['lolos_satu'])) {
  header("location:../halaman/lupa-sandi.php");
  return;
}

// Tombol Cek
else if (isset($_POST['btn_cek_nama'])){
  // Ceklis Checkbox Admin 
  if ($box_admin == "ya"){
    // Admin
    if ($nama == "") header("location:../halaman/lupa-sandi.php?nama=kosong&box=$box_admin");
    else {
      $qry = "SELECT * FROM admin";
      $query = mysqli_query($conn,$qry);
      while ($db_admin = mysqli_fetch_assoc($query)){				
        $nama_adm = $db_admin['nama_adm'];
        if ($nama == $nama_adm) $lolos_validasi = true;        
      }
      
      if (!$lolos_validasi) header("location:../halaman/lupa-sandi.php?nama=salah&box=$box_admin");
      else header("location:../halaman/lupa-sandi.php?nama=$nama&box=$box_admin");
    }
  } else {
    // Pengguna
    if ($nama == "") header("location:../halaman/lupa-sandi.php?nama=kosong&box=$box_admin");
    else {
      $qry = "SELECT * FROM pengguna";
      $query = mysqli_query($conn,$qry);
      while ($db_pengguna = mysqli_fetch_assoc($query)){				
        $nama_pgn = $db_pengguna['nama_pengguna'];
        if ($nama == $nama_pgn) $lolos_validasi = true;  
      }

      if (!$lolos_validasi) header("location:../halaman/lupa-sandi.php?nama=salah&box=$box_admin");
      else header("location:../halaman/lupa-sandi.php?nama=$nama&box=$box_admin");
    }
  }
} 
?>