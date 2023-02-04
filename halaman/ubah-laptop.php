<?php
include"../proses/koneksi.php";
$id=$_GET['id'];
  
// ambil data pada basis data
$query = "SELECT * FROM laptop WHERE id_laptop = '$id' ";
$conn_query = mysqli_query($conn, $query);
if(mysqli_num_rows($conn_query)>0) :  
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Homepage</title>
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
          <a href="#">SPKLap</a>
        </div>          
      </div>        
    </div>

    <div class="konten-tambah">
      <h4>Ubah Data Laptop</h4><br>
      <form action="../proses/proses-ubah-laptop.php" method="post" enctype="multipart/form-data">
        <img src="../images/db/<?=$gambar_laptop;?>.jpg" alt="..." height="200px;" class="gambar-ubah">
        <br>
        <div class="row mb-3">        
          <label for="formFile" class="col-sm-2 col-form-label">Gambar Laptop</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" name="gambar" id="formFile">                        
          </div>          
        </div>

        <div class="row mb-3">
          <label for="nama-laptop" class="col-sm-2 col-form-label">Nama Laptop</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="text" class="form-control" name="nama_laptop" id="nama-laptop" value="<?= $nama_laptop ?>">             
            </div>                           
          </div>
        </div>

        <div class="row mb-3">
          <label for="nama-prosesor" class="col-sm-2 col-form-label">Nama Prosesor</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="text" class="form-control" name="nama_prosesor" id="nama-prosesor" value="<?= $nama_prosesor ?>">
            </div>                      
          </div>          
        </div>

        <div class="row mb-3">
          <label for="deskripsi-tambahan" class="col-sm-2 col-form-label">Deskripsi Tambahan</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="deskripsi-tambahan" name="deskripsi" 
              rows="3"><?= $deskripsi_tambahan ?></textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label for="resolusi" class="col-sm-2 col-form-label">Resolusi</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="resolusi" id="resolusi" value="<?= $resolusi ?>">              
              <label for="resolusi" class="satuan" style="padding-left: 15px;">Inci</label>
            </div>                        
          </div>
        </div>

        <div class="row mb-3">
          <label for="prosesor-min" class="col-sm-2 col-form-label">Prosesor</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="prosesor_min" id="prosesor-min" placeholder="base clock" value="<?= $prosesor_min ?>"> 
              <label for="prosesor-min" class="satuan" style="padding-right: 15px;">GHz</label>
              <label class="satuan" style="padding-right: 10px;"> s/d </label>
              <input type="number" class="form-control" name="prosesor_max" id="prosesor-max" placeholder="boost clock" value="<?= $prosesor_maks ?>">
              <label for="prosesor-max" class="satuan">GHz</label>
            </div>                  
          </div>
        </div>

        <div class="row mb-3">
          <label for="ram" class="col-sm-2 col-form-label">RAM</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="ram" id="ram" value="<?= $ram ?>">
              <label for="ram" class="satuan" style="padding-left: 20px;">GB</label>
            </div>                        
          </div>
        </div>

        <div class="row mb-3">
          <label for="penyimpanan" class="col-sm-2 col-form-label">Penyimpanan</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="penyimpanan" id="penyimpanan" value="<?= $penyimpanan ?>">
              <label for="penyimpanan" class="satuan" style="padding-left: 20px;">GB</label>
            </div>               
          </div>
        </div>

        <div class="row mb-3">
          <label for="baterai" class="col-sm-2 col-form-label">Baterai</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="baterai" id="baterai" value="<?= $baterai ?>">
              <label for="baterai" class="satuan" style="padding-left: 16px;">Wh</label>
            </div>                        
          </div>
        </div>

        <div class="row mb-3">
          <label for="harga" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <label for="harga" class="satuan-harga">Rp.</label>
              <input type="number" class="form-control" name="harga" id="harga" value="<?= $harga ?>">                           
            </div>                   
          </div>
        </div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Ubah Laptop</button>
        </div>        
      </form>
      <?php endif; ?>
    </div>    
  </div>  
</body>
</html>