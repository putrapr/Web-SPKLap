<?php
include "../proses/koneksi.php";
$id_laptop = isset($_GET['id']) ? $_GET['id'] : "";
$query = "SELECT * FROM laptop WHERE id_laptop = $id_laptop";  
$conn_query = mysqli_query($conn, $query);
if(mysqli_num_rows($conn_query)>0) {
  $db_laptop = mysqli_fetch_assoc($conn_query);
  if(empty($db_laptop['gambar_laptop'])or($db_laptop['gambar_laptop']=='-'))
    $gambar_laptop = "no-photo.png";
  else
    $gambar_laptop = $db_laptop['gambar_laptop'];
  $nama_laptop = $db_laptop['nama_laptop'];
  $nama_prosesor = $db_laptop['nama_prosesor'];
  $deskripsi_tambahan = $db_laptop['deskripsi_tambahan'];
  $tgl_pendataan = new DateTime($db_laptop['tgl_pendataan']);
  $tgl_pendataan = date_format($tgl_pendataan,"d/m/Y");
  $resolusi = $db_laptop['resolusi'];
  $prosesor_min = $db_laptop['prosesor_min'];
  $prosesor_maks = $db_laptop['prosesor_maks'];
  $ram = $db_laptop['ram'];
  $penyimpanan = $db_laptop['penyimpanan'];
  $baterai = $db_laptop['baterai'];
  $harga = $db_laptop['harga'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Laptop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" href="../style.css" />
</head>
<body>
  <div class="pembungkus">
    <div class="butir">
      <div class="logo">
        <img src="../images/50x50 logo.png" alt="Logo" />
      </div>
      <div class="bab">
        <div class="webname">
          <a href="#">SPKLap</a>
        </div>          
      </div>        
    </div>
    
    <div class="konten-tambah">
      <h4><u>Detail Laptop</u></h4><br>
      <img src="../images/db/<?=$gambar_laptop;?>.jpg" class="gambar-pilih" alt="...">
      <h5 style="margin-top:10px;"><?=$nama_laptop;?></h5>
      <table>
        <tr>
          <td>Resolusi</td>
          <td class="spek">:</td>
          <td><?=$resolusi;?>"</td>
        </tr>
        <tr>
          <td style="vertical-align: top;">Prosesor</td>
          <td class="spek" style="vertical-align: top;">:</td>
          <td><?=$nama_prosesor?></td>
        </tr>
        <tr>
          <td></td>
          <td class="spek"></td>
          <td><?=$prosesor_min;?> GHz - <?=$prosesor_maks;?> GHz</td>
        </tr>
        <tr>
          <td>RAM</td>
          <td class="spek">:</td>
          <td><?=$ram;?> GB</td>
        </tr>
        <tr>
          <td>Penyimpanan</td>
          <td class="spek">:</td>
          <td><?=$penyimpanan;?> GB</td>
        </tr>
        <tr>
          <td>Baterai</td>
          <td class="spek">:</td>
          <td><?=$baterai;?> Wh</td>
        </tr>
        <tr>
          <td>Harga</td>
          <td class="spek">:</td>
          <td>Rp. <?=$harga;?></td>
        </tr>               
      </table>
      <p style="text-indent: 20px;"><?=$deskripsi_tambahan;?></p>
      <p class="tgl-pilih"><?=$tgl_pendataan;?></p>
      <a href="edit-laptop.php" class="btn btn-secondary tombol-kembali">Kembali</a>   
    </div>    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>