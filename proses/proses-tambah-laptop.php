<?php
include "koneksi.php";
$kosong = "kosong";
$nama_laptop = !empty($_POST['nama_laptop']) ? $_POST['nama_laptop'] : $kosong;
$nama_prosesor = !empty($_POST['nama_prosesor']) ? test_input($_POST['nama_prosesor']) : $kosong;
$deskripsi = !empty($_POST['deskripsi']) ? test_input($_POST['deskripsi']) : ""; // boleh kosong
$resolusi = !empty($_POST['resolusi']) ? test_input($_POST['resolusi']) : $kosong;
$prosesor_min = !empty($_POST['prosesor_min']) ? test_input($_POST['prosesor_min']) : $kosong;
$prosesor_max = !empty($_POST['prosesor_max']) ? test_input($_POST['prosesor_max']) : $kosong;
$ram = !empty($_POST['ram']) ? test_input($_POST['ram']) : $kosong;
$penyimpanan = !empty($_POST['penyimpanan']) ? test_input($_POST['penyimpanan']) : $kosong;
$baterai = !empty($_POST['baterai']) ? test_input($_POST['baterai']) : $kosong;
$harga = !empty($_POST['harga']) ? test_input($_POST['harga']) : $kosong;
$id_laptop = "";
$akun = "ADM";
$tgl = getdate();
$sekarang = $tgl['year']."-".$tgl['mon']."-".$tgl['mday'];

$nama_file   = $_FILES['gambar']['name'];
if(!empty($nama_file)){
  // Baca lokasi file sementara dan nama file dari form (fupload)
  $lokasi_file = $_FILES['gambar']['tmp_name'];
  $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
  $file_foto = data_akhir().".".$tipe_file;

  // Tentukan folder untuk menyimpan file
  $folder = "../images/db/$file_foto";
  // Apabila file berhasil di upload
  move_uploaded_file($lokasi_file,"$folder");
} else $file_foto="-";

if ( ($nama_laptop != $kosong) 
  && ($nama_prosesor != $kosong) 
  && ($resolusi != $kosong) 
  && ($prosesor_min != $kosong)
  && ($prosesor_max != $kosong) 
  && ($ram != $kosong) 
  && ($penyimpanan != $kosong) 
  && ($baterai != $kosong) 
  && ($harga != $kosong)) {
    
    $sql = "INSERT INTO laptop VALUES
          ('$id_laptop','$akun','$file_foto','$nama_laptop','$nama_prosesor','$deskripsi','$sekarang',
           '$resolusi','$prosesor_min','$prosesor_max','$ram','$penyimpanan','$baterai','$harga')";
	$query = mysqli_query($conn, $sql);
  echo "<script>alert('Laptop Berhasil Ditambahkan');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../halaman/edit-laptop.php'>";
} else { 
  echo "masuk null";
  ?>
  <form action="../halaman/tambah-laptop.php" method="post" id="formid">
    <!-- <input type='hidden' name='gambar[]' value='<?= $_FILES['gambar']?>'> -->
    <input type='hidden' name='nama_laptop' value='<?=$nama_laptop?>'>
    <input type='hidden' name='nama_prosesor' value='<?=$nama_prosesor?>'>
    <input type='hidden' name='deskripsi' value='<?=$deskripsi?>'>
    <input type='hidden' name='resolusi' value='<?=$resolusi?>'>
    <input type='hidden' name='prosesor_min' value='<?=$prosesor_min?>'>

    <input type='hidden' name='prosesor_max' value='<?=$prosesor_max?>'>
    <input type='hidden' name='ram' value='<?=$ram?>'>
    <input type='hidden' name='penyimpanan' value='<?=$penyimpanan?>'>
    <input type='hidden' name='baterai' value='<?=$baterai?>'>
    <input type='hidden' name='harga' value='<?=$harga?>'>
    <input type='hidden' name='status' value='on'>
    <script type="text/javascript">
      document.getElementById("formid").submit(); // Here formid is the id of your form                           ^
    </script>
  </form>
<?php
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>