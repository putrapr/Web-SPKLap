<?php
include '../proses/koneksi.php';
  
//halaman
$batas = 10;
extract($_GET);
if(empty($hal)){
  $posisi = 0;
  $hal = 1;
  $nomor = 1;
}
else {
  $posisi = ($hal - 1) * $batas;
  $nomor = $posisi+1;
}	

// validasi method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $pencarian = trim(mysqli_real_escape_string($conn, $_POST['pencarian']));
  if($pencarian != ""){
    $sql = "SELECT * FROM laptop WHERE nama_laptop LIKE '%$pencarian%'";                    
    $query = $sql;
    $queryJml = $sql;                    
  } else {
    $query = "SELECT * FROM laptop ORDER BY id_laptop DESC  LIMIT $posisi, $batas";
    $queryJml = "SELECT * FROM laptop ";
    $no = $posisi * 1; 
  }			
} else {
  $query = "SELECT * FROM laptop ORDER BY id_laptop DESC  LIMIT $posisi, $batas";
  $queryJml = "SELECT * FROM laptop ";
  $no = $posisi * 1;
}

function getId($p_nama){
  include "../proses/koneksi.php";	
  $id="";
  $qry = "SELECT id_laptop FROM laptop WHERE nama_laptop = '$p_nama';";
  $query = mysqli_query($conn,$qry);
  if ($db_laptop = mysqli_fetch_assoc($query)){    
    $id = $db_laptop['id_laptop'];
  }  	
  return $id;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pilih Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <div class="pembungkus">
      <div class="butir">
        <div class="logo">
          <img src="../images/50x50 logo.png" alt="Logo" />
        </div>
        <div class="bab">
          <div class="webname">
            <a href="beranda.php">SPKLap</a>
          </div>
          <div class="menu1">
            <a href="pilih-laptop.php">Pilih Laptop</a>
          </div>
          <div class="menu2">
            <a href="edit-laptop.php">Edit Laptop</a>
          </div>
          <div class="menu3">
            <a href="bantuan.php">Bantuan</a>
          </div>
        </div>
      </div>

      <div class="konten-edit-laptop">
        <div class="margin-edit">
          <form class="d-flex pencarian-edit" role="search" method="post">
            <div>
              <a href="tambah-laptop.php" class="btn btn-primary btn-tambah">Tambah Laptop</a>  
            </div>                    
            <div class="d-flex">
              <input class="form-control me-2 masukan-pencarian" type="search" placeholder="Cari" aria-label="Search" name="pencarian">
              <button class="btn btn-outline-success" type="submit">Cari</button>
            </div>
          </form>

          <table class="table table-bordered border-dark" style="margin-top:10px;">
            <thead>
              <tr>
                <th style="white-space: nowrap; width: 1%;">No</th>
                <th class="col">Nama Laptop</th>
                <th class="col-2">Tgl Pendataan</th>
                <th class="col-1 text-center">Spesifikasi</th>
                <th class="col-2 text-center">Aksi</th>
              </tr>
            </thead>            
            <tbody>
              <?php
                $conn_query = mysqli_query($conn, $query);
                if(mysqli_num_rows($conn_query)>0) :
                  while( $db_laptop = mysqli_fetch_assoc($conn_query) ) :                        
                    $nama_laptop = $db_laptop['nama_laptop'];    
                    $tgl_pendataan = new DateTime($db_laptop['tgl_pendataan']);
                    $tgl_pendataan = date_format($tgl_pendataan,"d/m/Y");
              ?>
              <tr>
                <th class="vertikal-tengah text-center"><?= $nomor; ?></th>
                <td class="vertikal-tengah"><?= $nama_laptop ?></td>
                <td class="vertikal-tengah"><?= $tgl_pendataan ?></td>
                <td class="text-center">
                  <a href="detail-laptop.php?id=<?= getId($nama_laptop) ?>" class="btn btn-secondary btn-sm lebar-tombol">Detail</a>
                </td>
                <td class="text-center">
                  <a href="ubah-laptop.php?id=<?= getId($nama_laptop) ?>" class="btn btn-primary btn-sm lebar-tombol">Ubah</a>
                  <a href="../proses/hapus-laptop.php?id=<?= getId($nama_laptop) ?>" 
                    class="btn btn-primary btn-sm lebar-tombol" 
                    onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')">Hapus</a>
                </td>
              </tr>
              <?php
                  $nomor++;
                  endwhile;                  
                endif;
              ?>
            </tbody>
          </table>
        </div>

        <nav aria-label="...">
          <ul class="pagination halaman-pilih-1">
            <?php
              $jml = mysqli_num_rows(mysqli_query($conn, $queryJml));              
              $jml_hal = ceil($jml/$batas);
              for($i=1; $i<=$jml_hal; $i++):
                if($i != $hal){ 
                  echo "<li class='page-item' aria-current='page'>";
                    if (isset($_GET['id'])) echo "<a class='page-link' href='?hal=$i&id=".$_GET['id']."'>$i</a>";
                    else echo "<a class='page-link' href='?hal=$i'>$i</a>";
                  echo "</li>";
                } else {
                  echo "<li class='page-item active'>";
                    echo "<a class='page-link' href='#'>$i</a>";
                  echo "</li>";
                }
              endfor;
            ?>                  
          </ul>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>