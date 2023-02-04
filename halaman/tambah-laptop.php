<?php
  $kosong = "kosong";
  $status = !empty($_POST['status']) ? true : false;
  // $gambar = $status ? $_POST['gambar']: "";
  $nama_laptop = $status ? $_POST['nama_laptop']: "";
  $nama_prosesor = $status ? $_POST['nama_prosesor']: "";
  $deskripsi = $status ? $_POST['deskripsi']: "";
  $resolusi = $status ? $_POST['resolusi']: "";
  $prosesor_min = $status ? $_POST['prosesor_min']: "";
  $prosesor_max = $status ? $_POST['prosesor_max']: "";
  $ram = $status ? $_POST['ram']: "";
  $penyimpanan = $status ? $_POST['penyimpanan']: "";
  $baterai = $status ? $_POST['baterai']: "";
  $harga = $status ? $_POST['harga']: "";
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
      <h4>Tambah Data Laptop</h4><br>
      <form action="../proses/proses-tambah-laptop.php" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
          <label for="formFile" class="col-sm-2 col-form-label">Gambar Laptop</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" name="gambar" id="formFile">
            <?php if ($status) : ?>
              <label for="gambar">Mohon pilih lagi filenya</label>
            <?php endif; ?>            
          </div>          
        </div>

        <div class="row mb-3">
          <label for="nama-laptop" class="col-sm-2 col-form-label">Nama Laptop</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="text" class="form-control" name="nama_laptop" id="nama-laptop" value="<?php
                if (($nama_laptop != $kosong) && ($nama_laptop != "")) echo $nama_laptop;
              ?>">
              <?php 
                if (!$status) echo "<label for='nama-laptop' class='err-petik'>*</label>";
                else if ($status && $nama_laptop == $kosong) echo "<label for='nama-laptop' class='err-petik'>*</label>";
              ?>             
            </div> 
            <?php if ($nama_laptop == $kosong) : ?>
              <label for="nama-laptop" class="err">* Masukan Nama Laptop *</label>   
            <?php endif; ?>                    
          </div>
        </div>

        <div class="row mb-3">
          <label for="nama-prosesor" class="col-sm-2 col-form-label">Nama Prosesor</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="text" class="form-control" name="nama_prosesor" id="nama-prosesor" value="<?php
                if (($nama_prosesor != $kosong) && ($nama_prosesor != "")) echo $nama_prosesor; ?>">
              <?php 
                if (!$status) echo "<label for='nama-prosesor' class='err-petik'>*</label>";
                else if ($status && $nama_prosesor == $kosong) echo "<label for='nama-prosesor' class='err-petik'>*</label>";
              ?> 
            </div>
            <?php if ($nama_prosesor == $kosong) : ?>
              <label for="nama-prosesor" class="err">* Masukan Nama Prosesor *</label>    
            <?php endif; ?>            
          </div>          
        </div>

        <div class="row mb-3">
          <label for="deskripsi-tambahan" class="col-sm-2 col-form-label">Deskripsi Tambahan</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="deskripsi-tambahan" name="deskripsi" 
              rows="3"><?php if (($deskripsi != $kosong) && ($nama_laptop != "")) echo $deskripsi; ?></textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label for="resolusi" class="col-sm-2 col-form-label">Resolusi</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="resolusi" id="resolusi" value="<?php
                if (($resolusi != $kosong) && ($resolusi != "")) echo $resolusi; ?>">
              <?php 
                if (!$status) echo "<label for='resolusi' class='err-petik'>*</label>";
                else if ($status && $resolusi == $kosong) echo "<label for='resolusi' class='err-petik'>*</label>";
              ?> 
              <label for="resolusi" class="satuan" style="padding-left: 15px;">Inci</label>
            </div>
            <?php if ($resolusi == $kosong) : ?>
              <label for="resolusi" class="err">* Masukan Nilai Resolusi *</label>
            <?php endif; ?>            
          </div>
        </div>

        <div class="row mb-3">
          <label for="prosesor-min" class="col-sm-2 col-form-label">Prosesor</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="prosesor_min" id="prosesor-min" placeholder="base clock" 
                value="<?php if (($prosesor_min != $kosong) && ($prosesor_min != "")) echo $prosesor_min; ?>">
              <?php 
                if (!$status) echo "<label for='prosesor-min' class='err-petik'>*</label>";
                else if ($status && $prosesor_min == $kosong) echo "<label for='prosesor-min' class='err-petik'>*</label>";
              ?> 
              <label for="prosesor-min" class="satuan" style="padding-right: 15px;">GHz</label>
              <label class="satuan" style="padding-right: 10px;"> s/d </label>
              <input type="number" class="form-control" name="prosesor_max" id="prosesor-max" placeholder="boost clock"
                value="<?php if (($prosesor_max != $kosong) && ($prosesor_max != "")) echo $prosesor_max; ?>">
              <?php 
                if (!$status) echo "<label for='prosesor-max' class='err-petik'>*</label>";
                else if ($status && $prosesor_max == $kosong) echo "<label for='prosesor-max' class='err-petik'>*</label>";
              ?> 
              <label for="prosesor-max" class="satuan">GHz</label>
            </div>
            <div>
              <?php if (($prosesor_min == $kosong) && ($prosesor_max == $kosong)) { ?>
                <label for="prosesor-min" class="err">* Masukan Kecepatan Dasar Prosesor (Base Clock) *</label>
                <label for="prosesor-max" class="err" style="margin-left: 200px;">* Masukan Kecepatan Maksimal Prosesor (Boost Clock) *</label>
              <?php } else if ($prosesor_min == $kosong) { ?>
                <label for="prosesor-min" class="err">* Masukan Kecepatan Dasar Prosesor (Base Clock) *</label>
              <?php } else if ($prosesor_max == $kosong) { ?>
                <label for="prosesor-max" class="err" style="margin-left: 565px;">* Masukan Kecepatan Maksimal Prosesor (Boost Clock) *</label>
              <?php } ?>              
            </div>                   
          </div>
        </div>

        <div class="row mb-3">
          <label for="ram" class="col-sm-2 col-form-label">RAM</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="ram" id="ram" value="<?php
                if (($ram != $kosong) && ($ram != "")) echo $ram; ?>">
              <?php 
                if (!$status) echo "<label for='ram' class='err-petik'>*</label>";
                else if ($status && $ram == $kosong) echo "<label for='ram' class='err-petik'>*</label>";
              ?>              
              <label for="ram" class="satuan" style="padding-left: 20px;">GB</label>
            </div>
            <?php if ($ram == $kosong) : ?>
              <label for="ram" class="err">* Masukan Nilai RAM *</label>
            <?php endif; ?>                        
          </div>
        </div>

        <div class="row mb-3">
          <label for="penyimpanan" class="col-sm-2 col-form-label">Penyimpanan</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="penyimpanan" id="penyimpanan" value="<?php
                if ($penyimpanan != $kosong && ($penyimpanan != "")) echo $penyimpanan; ?>">
              <?php 
                if (!$status) echo "<label for='penyimpanan' class='err-petik'>*</label>";
                else if ($status && $penyimpanan == $kosong) echo "<label for='penyimpanan' class='err-petik'>*</label>";
              ?>
              <label for="penyimpanan" class="satuan" style="padding-left: 20px;">GB</label>
            </div>
            <?php if ($penyimpanan == $kosong) : ?>
              <label for="penyimpanan" class="err">* Masukan Nilai Penyimpanan *</label>
            <?php endif; ?>                  
          </div>
        </div>

        <div class="row mb-3">
          <label for="baterai" class="col-sm-2 col-form-label">Baterai</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <input type="number" class="form-control" name="baterai" id="baterai" value="<?php
                if (($baterai != $kosong) && ($baterai != "")) echo $baterai; ?>">
              <?php 
                if (!$status) echo "<label for='baterai' class='err-petik'>*</label>";
                else if ($status && $baterai == $kosong) echo "<label for='baterai' class='err-petik'>*</label>";
              ?>
              <label for="baterai" class="satuan" style="padding-left: 16px;">Wh</label>
            </div>
            <?php if ($baterai == $kosong) : ?>
              <label for="baterai" class="err">* Masukan Nilai Baterai *</label>
            <?php endif; ?>                         
          </div>
        </div>

        <div class="row mb-3">
          <label for="harga" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <div class="d-flex">
              <label for="harga" class="satuan-harga">Rp.</label>
              <input type="number" class="form-control" name="harga" id="harga" value="<?php
                if (($harga != $kosong) && ($harga != "")) echo $harga; ?>">
              <?php 
                if (!$status) echo "<label for='harga' class='err-petik'>*</label>";
                else if ($status && $harga == $kosong) echo "<label for='harga' class='err-petik'>*</label>";
              ?>                            
            </div>
            <?php if ($harga == $kosong) : ?>
              <label for="harga" class="err">* Masukan Harga *</label>   
            <?php endif; ?>                      
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <div class="d-flex">
              <p class="err-petik" style="padding-left:0;">*</p>
              <p style="margin-left: 5px;">Tidak boleh kosong</p>
            </div>            
          </div>
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Tambah Laptop</button>
        </div>        
      </form>
    </div>    
  </div>  
</body>
</html>
