<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM penduduk WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>Edit Data</h4>
        </div>

        <div class="card-body">
            <form action="update.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $d['id'] ?>">

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?= $d['nik'] ?>">
                </div>

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $d['alamat'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Foto Baru (opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button class="btn btn-success">Update</button>
                <a href="tampil.php" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

</body>
</html>