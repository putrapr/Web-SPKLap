<?php
  include '../proses/koneksi.php';
    
  //halaman
  $batas = 9;
  extract($_GET);
  if(empty($hal)){
    $posisi = 0;
    $hal = 1;
  }
  else {
    $posisi = ($hal - 1) * $batas;
  }	

  // validasi method post
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $pencarian = trim(mysqli_real_escape_string($conn, $_POST['pencarian']));
    if($pencarian != ""){
      $sql = "SELECT * FROM laptop WHERE nama_laptop LIKE '%$pencarian%'";                    
      $query = $sql;
      $queryJml = $sql;                    
    } else {
      $query = "SELECT * FROM laptop ORDER BY id_laptop DESC LIMIT $posisi, $batas";
      $queryJml = "SELECT * FROM laptop ";
      $no = $posisi * 1; 
    }			
  } else {
    $query = "SELECT * FROM laptop ORDER BY id_laptop DESC LIMIT $posisi, $batas";
    $queryJml = "SELECT * FROM laptop ";
    $no = $posisi * 1;
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
    <div class="butir pilih-fixed">
      <div class="logo">
        <img src="../images/50x50 logo.png" alt="Logo" />
      </div>
      <div class="bab">
        <div class="webname">
          <a href="beranda.php">SPKLap</a>
        </div>
        <div class="menu1">
          <a href="#">Pilih Laptop</a>
        </div>
        <div class="menu2">
          <a href="edit-laptop.php">Edit Laptop</a>
        </div>
        <div class="menu3">
          <a href="bantuan.php">Bantuan</a>
        </div>
      </div>      
    </div>

    <div class="bilah-sisi">
      <div class="konten-bilah">
        <form class="d-flex pencarian" role="search" method="post">
          <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search" name="pencarian">
          <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>           
        <p class="pilihan-laptop">Pilihan Laptop</p>
        <form action="kriteria.php" method="post">
          <table class="table">
          <?php
            if(isset($_GET["id"])){
              $nilai = explode(",", $_GET["id"]);
              if (isset($nilai[4])){ 
                // no command
              } else if (isset($nilai[3])){
                $nilai[4] = "";
              } else if (isset($nilai[2])){
                $nilai[3] = "";
                $nilai[4] = "";
              } else if (isset($nilai[1])){
                $nilai[2] = "";
                $nilai[3] = "";
                $nilai[4] = "";
              } else if (isset($nilai[0])){
                $nilai[1] = "";
                $nilai[2] = "";
                $nilai[3] = "";
                $nilai[4] = "";
              }
            } else {
              $nilai[0] = "";
              $nilai[1] = "";
              $nilai[2] = "";
              $nilai[3] = "";
              $nilai[4] = "";
            }
            $maks_pilih = 5;
            for($j=0; $j<$maks_pilih; $j++):
              $query_2 = "SELECT nama_laptop FROM laptop WHERE id_laptop = '$nilai[$j]'";
              $conn_query_2 = mysqli_query($conn, $query_2);
              if(mysqli_num_rows($conn_query_2)>0) :
                $db_laptop_2 = mysqli_fetch_assoc($conn_query_2);
                $nama_laptop_2 = $db_laptop_2['nama_laptop']; ?>                
                <tr>              
                  <td style="font-weight: bold;" name="pilih"><?= $nama_laptop_2 ?></td>
                  <td><a href="?id=<?php
                  // HAPUS
                  $temp = [];
                  $temp = $nilai;
                  for ($k=$j; $k < $maks_pilih; $k++){
                    if ($k == $maks_pilih-1) $temp[$k] = "";
                    else $temp[$k] = $temp[$k+1];
                  }
                  
                  // BANGUN id
                  $hasil = "";
                  for ($l=0; $l<$maks_pilih; $l++){
                    if ($temp[$l] == "") {
                      $hasil = substr($hasil, 0, -1);
                      break;
                    }
                    else $hasil .= $temp[$l].","; 
                  }
                  echo $hasil;
                  ?>
                  " class="btn btn-close" aria-label="Close"></a></td>
                  <input type="hidden" name="p<?=$j;?>" value="<?= $nama_laptop_2 ?>">                                                                       
                </tr> <?php                
              endif;
            endfor;
          ?>
          </table>

          <?php
            if ($nilai[1]!=""){ ?>
              <div class="tombol-mulai">
                <input type="submit" class="btn btn-outline-success btn-lg" value="Mulai SPK"></input>
              </div> <?php
            }
          ?>
        </form>
        <br>
        <p>Pilihan laptop minimal 2 dan maksimal 5.  </p>
      </div>
    </div>

    <div class="konten-pilih">
      <div class="margin-pilih">
        <div class="konten-kartu">
        <?php
          // ambil data pada basis data
          $conn_query = mysqli_query($conn, $query);
          if(mysqli_num_rows($conn_query)>0) {
            while( $db_laptop = mysqli_fetch_assoc($conn_query) ) :
              $id_laptop = $db_laptop['id_laptop'];
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
        ?>        
          <div class="card" style="width: 18rem;">
            <img src="../images/db/<?=$gambar_laptop;?>.jpg" class="card-img-top gambar-pilih" alt="...">
            <div class="card-body" style="margin-bottom: -20px;">
              <h5 class="card-title"><?=$nama_laptop;?></h5>                
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
            </div> 

            <div class="tombol-pilih">                  
              <p class="tgl-pilih"><?=$tgl_pendataan;?></p>              
              <?php
                if (isset($_GET['hal'])){ ?>
                  <a href="?hal=<?=$_GET['hal']?>&id=<?php 
                    if (isset($_GET['id'])){
                      $nilai_2 = explode(",", $_GET["id"]);
                      if (isset($nilai_2[4])) echo $_GET['id'];
                      else echo $_GET['id'].",".$id_laptop;
                    } else echo $id_laptop;
                  ?>" class="btn btn-primary col-5">Pilih</a>
                  <?php
                } else { ?>
                  <a href="?id=<?php
                    if (isset($_GET['id'])){
                      $nilai_2 = explode(",", $_GET["id"]);
                      if (isset($nilai_2[4])) echo $_GET['id'];
                      else echo $_GET['id'].",".$id_laptop;
                    } else echo $id_laptop;
                  ?>" class="btn btn-primary col-5">Pilih</a>
                  <?php
                }
              ?>
            </div>
          </div>
          <?php
              endwhile;              
            } else echo " <p style=\"text-align: center;\"> Data Tidak Ditemukan</p>";
          ?>
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