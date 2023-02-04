<?php
$nama = isset($_GET['nama']) ? $_GET['nama'] : "";              //kosong, sama
$sandi = isset($_GET['sandi']) ? $_GET['sandi'] : "";           //kosong,
$email = isset($_GET['email']) ? $_GET['email'] : "";           //kosong, sama
$aktivasi = isset($_GET['aktivasi']) ? $_GET['aktivasi'] : "";  //kosong, cek-dahulu, sama, salah
$status = isset($_GET['status']) ? $_GET['status'] : "";        //benar
$cek_box = isset($_GET['cek_box']) ? $_GET['cek_box'] : "";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar</title>
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
            <a href="beranda.php">SPKLap</a>
          </div>
        </div>
      </div>

      <div class="card text-end formulir-masuk">
        <h5 class="card-header judul-masuk">Daftar</h4>
        <div class="card-body">
          <form action="../proses/daftar-validasi.php" method="post">            
            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Nama</span>
              <input type="text" class="form-control" name="nama" 
                value="<?php
                if (!($nama == "kosong" || $nama == "sama")) echo $nama;
                ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <?php 
              if ($nama == "kosong") echo "<p class='err'>* Isi nama terlebih dahulu *</p>";
              else if ($nama == "sama") echo "<p class='err'>* Nama sudah ada, masukkan nama lain *</p>";
            ?>
            
            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Sandi</span>
              <input type="password" class="form-control" name="sandi" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <?php 
              if ($sandi == "kosong") echo "<p class='err'>* Isi sandi terlebih dahulu *</p>";
            ?>

            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Email</span>
              <input type="text" class="form-control" name="email" 
              value="<?php
                if (!($email == "kosong" || $email == "sama")) echo $email;
              ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <?php 
              if ($email == "kosong") echo "<p class='err'>* Isi email terlebih dahulu *</p>";
              else if ($email == "sama") echo "<p class='err'>* Email sudah ada, masukkan email lain *</p>";
            ?>

            <button type="submit" class="btn btn-dark" name="btn_daftar" value="submit">Daftar</button>
            <?php
              if ($aktivasi == "cek-dahulu") echo "<p class='err'>* Klik tombol \"Cek\" di bawah terlebih dahulu *</p>";
            ?>
            <div class="form-check text-start">
              <input class="form-check-input" type="checkbox" onchange="showHide(this.checked)" name="cek_box_admin" id="cek_box_admin" 
              <?= ($cek_box == "ya" ? 'checked' : '');?>>
              <label class="form-check-label" for="cek_box_admin">Admin</label>
            </div>
            <?php if ($status == "benar") :?>
              <input type="hidden" name="kode_benar" value="benar">
              <input type="hidden" name="kode_aktivasi" value="<?=$aktivasi?>">
            <?php endif; ?>            
          </form>            
        </div>
      </div>
    </div>

    <div class="card formulir-masuk">
      <div class="card-body">
        <form action="../proses/daftar-validasi.php" method="post">
          <div id="div-admin" <?= ($cek_box == "ya" ? "" : "style='display:none;'");?>>          
            <p style="margin-top: -10px;"><br> Jika anda admin masukkan kode aktivasi : </p>
            <input type="text" class="form-control aktivasi-admin" name="kode_aktivasi" 
              value="<?php                  
                if (!($aktivasi == "kosong" 
                    || $aktivasi == "sama" 
                    || $aktivasi == "salah" 
                    || $aktivasi == "cek-dahulu")) echo $aktivasi;
              ?>" id="kode_aktivasi" placeholder="Kode Aktivasi">
              <?php if ($status == "benar") :?>
                <img src="../images/40x40 checklist.png" id="ceklis" alt="checklist-icon" class="checklist-icon">
              <?php endif; ?>
              
              <?php if ($aktivasi == "kosong" || $aktivasi == "sama" || $aktivasi == "salah") :?>
                <img src="../images/30x30 close.png" id="silang" alt="wrong-icon" class="checklist-icon" width="29px;">
              <?php endif; ?>
              
              <button type="submit" class="btn btn-secondary cek-aktivasi" name="btn_aktivasi" value="submit">Cek</button>
              <?php //kosong, cek-dahulu, sama, salah
                if ($aktivasi == "kosong") echo "<p class='err'>* Isi kode aktivasi terlebih dahulu *</p>";
                else if ($aktivasi == "sama") echo "<p class='err'>* Kode aktivasi sudah dipakai, masukkan kode aktivasi lain *</p>";
                else if ($aktivasi == "salah") echo "<p class='err'>* Kode Aktivasi Salah *</p>";                
              ?>                      
          </div>        
        </form>
      </div>       
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script>
      function showHide(checked) {
        if (checked == true) $("#div-admin").fadeIn();
        else $("#div-admin").fadeOut();
      }
    </script>
  </body>
</html>