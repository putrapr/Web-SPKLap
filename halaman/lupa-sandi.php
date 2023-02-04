<?php
$nama = isset($_GET['nama']) ? $_GET['nama'] : "";    // kosong, salah
$box_admin = isset($_GET['box']) ? $_GET['box'] : ""; // ya, tdk
$email = isset($_GET['email']) ? $_GET['email'] : ""; // kosong, salah      

$lolos_1 = false;
if (!($nama == "kosong" 
  || $nama == "salah" 
  || $nama == "")) $lolos_1 = true;

$lolos_2 = false;
if (!($email == "kosong" 
  || $email == "salah" 
  || $email == "")) $lolos_2 = true;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Sandi</title>
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
        </div>
      </div>

      <div class="card text-start formulir-masuk">
        <h5 class="card-header judul-masuk">Lupa Sandi</h4>
        <form action="../proses/lupa-sandi-validasi.php" method="post">
          <div class="card-body">
            <div class="form-check" style="margin-bottom:20px;">
              <input class="form-check-input" type="checkbox" name="box_admin" value="ya"  id="flexCheckDefault"
              <?php
                  if ($box_admin == "ya") echo "checked ";
                  if ($lolos_1) echo "disabled";
                ?>>
              <label class="form-check-label" for="flexCheckDefault">
                Admin (Jangan Centang Jika Bukan Admin)
              </label>
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text masuk-input" id="inputGroup-sizing-default">Nama</span>
              <input type="text" class="form-control" name="nama" <?php
                if ($lolos_1) echo "value='$nama' disabled";
                ?> aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              <div>
                <img src="../images/40x40 checklist.png" alt="V" style="margin-left:3px; <?php
                  if (!$lolos_1) echo "display:none;";
                ?>">

                <?php if ($lolos_1) : ?>
                  <input type="hidden" name="lolos_satu" value="benar">
                <?php endif; ?>
                
                <button type="submit" class="btn btn-secondary" name="btn_cek_nama" style="margin-left:10px;">
                  <?= $lolos_1 ? "Batal" : "Cek"; ?>
                </button>
              </div>
            </div>

            <div class="text-end">
              <?php
                if ($nama == "kosong") echo "<p style='color: red'> * Nama Kosong, Masukkan Nama Terlebih Dahulu ! *</p>";
                else if ($nama == "salah") echo "<p style='color: red'> * Nama Tidak Ada *</p>";
              ?>
            </div>            
<!-- --------------------------------------------------------------------------------------------------- -->
            <div style="<?= $lolos_1 ? "" : "display:none"; ?>">
              <p><br> Email saat daftar :</p>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                <input type="text" class="form-control" name="email" <?php
                  if ($lolos_2) echo "value='$email' disabled";
                  ?> aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <img src="../images/40x40 checklist.png" alt="V" style="margin-left:3px; <?php
                  if (!$lolos_2) echo "display:none;";
                ?>">
                
                <?php if ($lolos_2) : ?>
                  <input type="hidden" name="lolos_dua" value="benar">
                <?php endif; ?>
                <input type="hidden" name="nama_benar" value="<?=$nama?>">
                <input type="hidden" name="box_admin" value="<?=$box_admin?>">
                <button type="submit" class="btn btn-secondary" name="btn_cek_email" style="margin-left:10px;" <?php
                  if($lolos_2) echo "disabled";
                ?>>Cek</button>                  
              </div>

              <div class="text-end">
                <?php
                  if ($email == "kosong") echo "<p style='color: red'> * Email Kosong, Masukkan Email Terlebih Dahulu ! *</p>";
                  else if ($email == "salah") echo "<p style='color: red'> * Email Salah *</p>";
                ?>
              </div>
            </div>
<!-- -------------------------------------------------------------------------------------------------- -->
            <div style="<?= $lolos_2 ? "" : "display:none"; ?>">
              <br> <br>
              <h4 class="text-success text-center">Sukses !</h4>
              <p>Masukkan sandi baru :</p>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Sandi Baru</span>
                <input type="text" class="form-control" name="sandi_baru" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">                    
              </div> 
              <input type="hidden" name="nama_benar" value="<?=$nama?>">
              <input type="hidden" name="email_benar" value="<?=$email?>">
              <input type="hidden" name="box_admin" value="<?=$box_admin?>">
              <div class="text-end">
                <button type="submit" class="btn btn-dark" name="btn_simpan">Simpan</button>
              </div> 
            </div>
          </div>  
        </form>
      </div>
    </div>    
  </body>
</html>