<?php
include'koneksi.php';
$id=$_GET['id'];

mysqli_query($conn,
	"DELETE FROM laptop
	WHERE id_laptop='$id'"
);

header("location:../halaman/edit-laptop.php");
?>