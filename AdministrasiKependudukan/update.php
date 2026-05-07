<?php
include 'koneksi.php';

$id = $_POST['id'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if($foto != ""){
    move_uploaded_file($tmp, "upload/".$foto);

    mysqli_query($conn, "UPDATE penduduk SET 
        nik='$nik',
        nama='$nama',
        alamat='$alamat',
        foto='$foto'
        WHERE id='$id'");
} else {
    mysqli_query($conn, "UPDATE penduduk SET 
        nik='$nik',
        nama='$nama',
        alamat='$alamat'
        WHERE id='$id'");
}

header("Location: tampil.php");
?>