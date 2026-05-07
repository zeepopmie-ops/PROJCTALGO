<?php
include 'session.php';
include 'koneksi.php';
$pageTitle = 'Data Penduduk';

// Query dengan pencarian
if (isset($_GET['cari']) && $_GET['cari'] !== '') {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    $data = mysqli_query($conn, "SELECT * FROM penduduk WHERE nama LIKE '%$cari%' OR nik LIKE '%$cari%' ORDER BY id DESC");
} else {
    $data = mysqli_query($conn, "SELECT * FROM penduduk ORDER BY id DESC");
}

include 'header.php';
?>

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:1.3rem; font-weight:800; color:var(--text);">📊 Data Penduduk</h2>
        <p style="font-size:.83rem; color:var(--muted); margin-top:2px;">Daftar seluruh data penduduk terdaftar</p>
    </div>
    <?php if(isAdmin()): ?>
    <a href="input.php" class="btn btn-primary">➕ Tambah Data</a>
    <?php endif; ?>
</div>

<!-- SEARCH -->
<form method="GET" style="margin-bottom:20px;">
    <div style="display:flex; gap:10px;">
        <input type="text" name="cari" value="<?= htmlspecialchars($_GET['cari'] ?? '') ?>"
            placeholder="🔍 Cari nama atau NIK penduduk..."
            style="flex:1; padding:11px 16px; border:2px solid var(--border); border-radius:10px;
                   font-family:inherit; font-size:.9rem; outline:none; background:#fafbff; color:var(--text);">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if(isset($_GET['cari']) && $_GET['cari'] !== ''): ?>
        <a href="tampil.php" class="btn btn-outline">Reset</a>
        <?php endif; ?>
    </div>
</form>

<!-- TABLE -->
<div class="table-card">
    <div class="table-header">
        <div class="table-title">
            📋 Total: <?= $data ? mysqli_num_rows($data) : 0 ?> data
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$data || mysqli_num_rows($data) == 0): ?>
            <tr>
                <td colspan="6" style="text-align:center; color:var(--muted); padding:40px;">
                    <?= isset($_GET['cari']) ? '🔍 Data tidak ditemukan' : 'Belum ada data penduduk' ?>
                </td>
            </tr>
        <?php else:
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td style="color:var(--muted); font-weight:600;"><?= $no++ ?></td>
                <td><code style="font-size:.8rem; color:var(--blue);"><?= htmlspecialchars($d['nik']) ?></code></td>
                <td><strong><?= htmlspecialchars($d['nama']) ?></strong></td>
                <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--muted);">
                    <?= htmlspecialchars($d['alamat']) ?>
                </td>
                <td>
                    <?php if (!empty($d['foto'])): ?>
                        <img src="upload/<?= htmlspecialchars($d['foto']) ?>" class="avatar-img">
                    <?php else: ?>
                        <span style="color:var(--muted); font-size:.78rem;">—</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        <a href="lihat.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">👁 Lihat</a>
                        <?php if(isAdmin()): ?>
                        <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <a href="delete.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus data <?= htmlspecialchars($d['nama']) ?>?')">🗑 Hapus</a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
