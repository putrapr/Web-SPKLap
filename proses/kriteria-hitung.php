<?php
include "koneksi.php";
// w = weight = bobot;
$w_prosesor = isset($_POST['prosesor']) ? (float) $_POST['prosesor'] : "";
$w_resolusi = isset($_POST['resolusi']) ? (float) $_POST['resolusi'] : "";
$w_ram = isset($_POST['ram']) ? (float) $_POST['ram'] : "";
$w_penyimpanan = isset($_POST['penyimpanan']) ? (float) $_POST['penyimpanan'] : "";
$w_baterai = isset($_POST['baterai']) ? (float) $_POST['baterai'] : "";
$w_harga = isset($_POST['harga']) ? (float) $_POST['harga'] : "";
$w_total = isset($_POST['total']) ? (float) $_POST['total'] : "";
$id_laptop = isset($_POST['laptop_pilihan']) ? $_POST['laptop_pilihan'] : "";

$arr_prosesor = db_prosesor($id_laptop);
$arr_resolusi = db_resolusi($id_laptop);
$arr_ram = db_ram($id_laptop);
$arr_penyimpanan = db_penyimpanan($id_laptop);
$arr_baterai = db_baterai($id_laptop);
$arr_harga = db_harga($id_laptop);

$radio = $_POST['radio_resolusi'];
if ($radio == "besar") {
  $maks = count($id_laptop);
  $hasil_akhir = [];
  for ($i=0; $i<$maks;$i++){
    $hasil_akhir[$i] = (norm_prosesor($arr_prosesor)[$i] * $w_prosesor)
                     + (norm_resolusi_besar($arr_resolusi)[$i] * $w_resolusi)
                     + (norm_ram($arr_ram)[$i] * $w_ram)
                     + (norm_penyimpanan($arr_penyimpanan)[$i] * $w_penyimpanan)
                     + (norm_baterai($arr_baterai)[$i] * $w_baterai)
                     + (norm_harga($arr_harga)[$i] * $w_harga);
    $hasil_akhir[$i] = number_format($hasil_akhir[$i],2,'.','');    
  }?>

  <form id="form" action="../halaman/hasil.php" method="POST">
    <?php for ($i=0;$i<$maks;$i++) : ?>
      <input type="hidden" name="id_laptop[]" value="<?= $id_laptop[$i]?>">
      <input type="hidden" name="hasil_akhir[]" value="<?= $hasil_akhir[$i]?>">
    <?php endfor; ?>    
  </form>
  <script>
    document.getElementById("form").submit();
  </script>
  <?php

} else {
  $maks = count($id_laptop);
  $hasil_akhir = [];
  for ($i=0; $i<$maks;$i++){
    $hasil_akhir[$i] = (norm_prosesor($arr_prosesor)[$i] * $w_prosesor)
                     + (norm_resolusi_kecil($arr_resolusi)[$i] * $w_resolusi)
                     + (norm_ram($arr_ram)[$i] * $w_ram)
                     + (norm_penyimpanan($arr_penyimpanan)[$i] * $w_penyimpanan)
                     + (norm_baterai($arr_baterai)[$i] * $w_baterai)
                     + (norm_harga($arr_harga)[$i] * $w_harga);
    $hasil_akhir[$i] = number_format($hasil_akhir[$i],2,'.','');    
  } ?>

  <form id="form" action="../halaman/hasil.php" method="POST">
    <?php for ($i=0;$i<$maks;$i++) : ?>
      <input type="hidden" name="id_laptop[]" value="<?= $id_laptop[$i]?>">
      <input type="hidden" name="hasil_akhir[]" value="<?= $hasil_akhir[$i]?>">
    <?php endfor; ?>    
  </form>
  <script>
    document.getElementById("form").submit();
  </script>
  <?php
}

function db_prosesor ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT prosesor_min FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['prosesor_min'];
    }
  }		
	return $hasil;
}

function db_resolusi ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT resolusi FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['resolusi'];
    }
  }		
	return $hasil;
}

function db_ram ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT ram FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['ram'];
    }
  }		
	return $hasil;
}

function db_penyimpanan ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT penyimpanan FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['penyimpanan'];
    }
  }		
	return $hasil;
}

function db_baterai ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT baterai FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['baterai'];
    }
  }		
	return $hasil;
}

function db_harga ($arr_id){
  include "koneksi.php";
  $maks = count($arr_id);
  $hasil = [];
  for ($i=0; $i<$maks;$i++){
    $qry = "SELECT harga FROM laptop WHERE id_laptop = $arr_id[$i]";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){				
      $hasil[$i] = (float) $db_laptop['harga'];
    }
  }		
	return $hasil;
}

function benefit ($x, $max_x){
  return $x/$max_x;
}

function cost ($y, $min_y){
  return $min_y/$y;
}

function norm_prosesor($arr_db){
  $hasil = [];  
  $nilai_maks = max($arr_db);
  foreach ($arr_db as $prosesor){
    $hasil[] = benefit($prosesor, $nilai_maks);
  }
  return $hasil;
}

function norm_resolusi_besar($arr_db){
  $hasil = [];  
  $nilai_maks = max($arr_db);
  foreach ($arr_db as $resolusi){
    $hasil[] = benefit($resolusi, $nilai_maks);
  }
  return $hasil;
}

function norm_resolusi_kecil($arr_db){
  $hasil = [];  
  $nilai_min = min($arr_db);
  foreach ($arr_db as $resolusi){
    $hasil[] = cost($resolusi, $nilai_min);
  }
  return $hasil;
}

function norm_ram($arr_db){
  $hasil = [];  
  $nilai_maks = max($arr_db);
  foreach ($arr_db as $ram){
    $hasil[] = benefit($ram, $nilai_maks);
  }
  return $hasil;
}

function norm_penyimpanan($arr_db){
  $hasil = [];  
  $nilai_maks = max($arr_db);
  foreach ($arr_db as $penyimpanan){
    $hasil[] = benefit($penyimpanan, $nilai_maks);
  }
  return $hasil;
}

function norm_baterai($arr_db){
  $hasil = [];  
  $nilai_maks = max($arr_db);
  foreach ($arr_db as $baterai){
    $hasil[] = benefit($baterai, $nilai_maks);
  }
  return $hasil;
}

function norm_harga($arr_db){
  $hasil = [];  
  $nilai_min = min($arr_db);
  foreach ($arr_db as $harga){
    $hasil[] = cost($harga, $nilai_min);
  }
  return $hasil;
}
?>