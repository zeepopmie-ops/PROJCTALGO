<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM penduduk WHERE id='$id'");

header("Location: tampil.php");
?>
