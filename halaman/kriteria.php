<?php
$p0 = isset($_POST['p0']) ? $_POST['p0'] : "";
$p1 = isset($_POST['p1']) ? $_POST['p1'] : "";
$p2 = isset($_POST['p2']) ? $_POST['p2'] : "";
$p3 = isset($_POST['p3']) ? $_POST['p3'] : "";
$p4 = isset($_POST['p4']) ? $_POST['p4'] : "";

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
      <div class="butir pilih-fixed">
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

      <div class="bilah-sisi">
        <div class="konten-bilah">
          <p class="pilihan-laptop">Pilihan Laptop</p>          
            <?php
            if (isset($_POST['p4'])) $maks = 5;
            else if (isset($_POST['p3'])) $maks = 4;
            else if (isset($_POST['p2'])) $maks = 3;
            else if (isset($_POST['p1'])) $maks = 2;
            else {
              header("location:../halaman/pilih-laptop.php");
              return;
            }
            $data = [];            
            $data[0] = $p0;
            $data[1] = $p1;
            $data[2] = $p2;
            $data[3] = $p3;
            $data[4] = $p4;
            ?>
            <table class="table">
              <?php for ($i=0;$i<$maks;$i++) : ?>
              <tr>
                <td style="font-weight: bold"><?= $data[$i] ?></td>
              </tr>
              <?php endfor; ?>
            </table>
            <p style="text-align: justify;" >Berikan presentase sesuai kriteria yang anda inginkan. Tombol "Mulai SPK" akan aktif jika 
              <span style="background-color: coral; font-weight:bold;">Total = 100%.</span>  </p>          
        </div>
      </div>

      <div class="konten-pilih">
        <div style="margin:4%;">
          <div class="card">          
            <h3 class="card-header text-center">Kriteria</h3>
            <div class="card-body">
              <form action="../proses/kriteria-hitung.php" method="post">
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">Prosesor</span>
                  <input type="text" class="form-control text-end" name="prosesor" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="radio_resolusi" value="besar" id="inlineRadio1" value="option1" checked>
                  <label class="form-check-label" for="inlineRadio1">Resolusi Besar</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="radio_resolusi" value="kecil" id="inlineRadio2" value="option2">
                  <label class="form-check-label" for="inlineRadio2">Resolusi Kecil</label>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">Resolusi</span>
                  <input type="text" class="form-control text-end" name="resolusi" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">RAM</span>
                  <input type="text" class="form-control text-end" name="ram" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">Penyimpanan</span>
                  <input type="text" class="form-control text-end" name="penyimpanan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">Baterai</span>
                  <input type="text" class="form-control text-end" name="baterai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-input" id="inputGroup-sizing-default">Harga</span>
                  <input type="text" class="form-control text-end" name="harga" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text kriteria-total" id="inputGroup-sizing-default">Total</span>
                  <input type="text" class="form-control text-end" name="total" disabled value="100" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                  <span class="input-group-text">%</span>
                </div>
                <div class="btn-kriteria">
                  <a href="pilih-laptop.php?id=<?php
                    for ($i=0;$i<$maks;$i++){
                      if ($i == $maks-1) echo getId($data[$i]);
                      else echo getId($data[$i]).",";
                    }
                  ?>" class="btn btn-secondary"> < Kembali</a>
                  <?php for ($i=0;$i<$maks;$i++) : ?>
                    <input type="hidden" name="laptop_pilihan[]" value="<?= getId($data[$i])?>">
                  <?php endfor; ?>
                  <input type="hidden" name="id_pilihan" value="">
                  <input type="submit" class="btn btn-dark" value="Mulai SPK >"></input>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
