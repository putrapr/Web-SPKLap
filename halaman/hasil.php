<?php
  $id_laptop = isset($_POST['id_laptop']) ? $_POST['id_laptop'] : "";
  $hasil_akhir = isset($_POST['hasil_akhir']) ? $_POST['hasil_akhir'] : "";

  switch(count($id_laptop)){
    case 2 :
      $keluaran = [
        $id_laptop[0] => $hasil_akhir[0],
        $id_laptop[1] => $hasil_akhir[1]
      ];
      break;
    case 3 :
      $keluaran = [
        $id_laptop[0] => $hasil_akhir[0],
        $id_laptop[1] => $hasil_akhir[1],
        $id_laptop[2] => $hasil_akhir[2]
      ];
      break;
    case 4 : 
      $keluaran = [
        $id_laptop[0] => $hasil_akhir[0],
        $id_laptop[1] => $hasil_akhir[1],
        $id_laptop[2] => $hasil_akhir[2],
        $id_laptop[3] => $hasil_akhir[3]
      ];
      break;
    case 5 :
      $keluaran = [
        $id_laptop[0] => $hasil_akhir[0],
        $id_laptop[1] => $hasil_akhir[1],
        $id_laptop[2] => $hasil_akhir[2],
        $id_laptop[3] => $hasil_akhir[3],
        $id_laptop[4] => $hasil_akhir[4] 
      ];
      break;
    default:
      //null
  }
  arsort($keluaran);

  function getNama($p_id){
    include "../proses/koneksi.php";	
    $nama="";
    $qry = "SELECT nama_laptop FROM laptop WHERE id_laptop = '$p_id';";
    $query = mysqli_query($conn,$qry);
    if ($db_laptop = mysqli_fetch_assoc($query)){    
      $nama = $db_laptop['nama_laptop'];
    }      	
    return $nama;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Dukungan Keputusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <div class="pembungkus-hasil">
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

      <div class="konten-hasil">
        <div class="card">
          <h4 class="card-header text-center">Hasil Perangkingan Laptop</h4>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th class="col-2 text-center">Peringkat</th>
                  <th class="col-6">Nama Laptop</th>
                  <th class="col-2">Spesifikasi</th>
                  <th class="col-2 text-center">Skor</th>
                </tr>
              </thead>              
              <tbody>
                <?php
                  $no = 0;
                  // echo "Key=" . $x . ",\t Value=" . $x_value;
                  foreach($keluaran as $x=>$x_value){
                    $no++;
                    if ($no == 1) echo "<tr class='table-secondary'>";
                    else if ($no == 2 || $no == 3) echo "<tr class='table-primary'>";
                    else echo "<tr class='table-success'>";
                    echo "<th class='text-center'>$no</th>";
                    echo "<td>".getNama($x)."</td>";
                    echo "<td><a href='detail-laptop.php?id=$x' class='btn btn-secondary btn-sm lebar-tombol'>Detail</a></td>";
                    echo "<td class='text-center'>$x_value</td>";
                    echo "</tr>";                    
                  }
                ?>                
              </tbody>
            </table>
            <div>
              <form action="kriteria.php" method="post"><br>                
                <?php
                  $maks = count($id_laptop);
                  for ($i=0;$i<$maks;$i++) : ?>                    
                    <input type="hidden" name="p<?=$i;?>" value="<?= getNama($id_laptop[$i])?>">
                <?php endfor; ?>
                <input type="submit" class="btn btn-secondary" value="Ubah Kriteria"></input>
                <a href="pilih-laptop.php" class="btn btn-secondary">Pilih Laptop Lain</a>
              </form>             
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>