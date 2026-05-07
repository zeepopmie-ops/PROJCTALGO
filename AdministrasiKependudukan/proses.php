<?php
include 'koneksi.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$folder = "upload/";
move_uploaded_file($tmp, $folder.$foto);

mysqli_query($conn, "INSERT INTO penduduk VALUES('', '$nik', '$nama', '$alamat', '$foto')");

header("Location: tampil.php");
?>