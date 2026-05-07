<?php
include 'session.php';
include 'koneksi.php';
$pageTitle = 'Dashboard';

// Fungsi aman untuk ambil angka dari query
function safe_count($conn, $sql) {
    $q = mysqli_query($conn, $sql);
    if (!$q) return 0;
    $row = mysqli_fetch_row($q);
    return $row ? $row[0] : 0;
}

$total     = safe_count($conn, "SELECT COUNT(*) FROM penduduk");
$laki      = safe_count($conn, "SELECT COUNT(*) FROM penduduk WHERE jenis_kelamin='Laki-laki'");
$perempuan = safe_count($conn, "SELECT COUNT(*) FROM penduduk WHERE jenis_kelamin='Perempuan'");
$bulan_ini = safe_count($conn, "SELECT COUNT(*) FROM penduduk WHERE MONTH(created_at)=MONTH(NOW()) AND YEAR(created_at)=YEAR(NOW())");

// 5 data terbaru
$recent = mysqli_query($conn, "SELECT * FROM penduduk ORDER BY id DESC LIMIT 5");
if (!$recent) $recent = null;

include 'header.php';
?>
<!-- STATS -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon ic-blue">👥</div>
        <h3><?= number_format($total) ?></h3>
        <p>Total Penduduk</p>
    </div>
    <div class="stat-card">
        <div class="stat-icon ic-green">♂</div>
        <h3><?= number_format($laki) ?></h3>
        <p>Laki-laki</p>
    </div>
    <div class="stat-card">
        <div class="stat-icon ic-gold">♀</div>
        <h3><?= number_format($perempuan) ?></h3>
        <p>Perempuan</p>
    </div>
    <div class="stat-card">
        <div class="stat-icon ic-red">🆕</div>
        <h3><?= number_format($bulan_ini) ?></h3>
        <p>Baru Bulan Ini</p>
    </div>
</div>

<!-- RECENT DATA -->
<div class="table-card">
    <div class="table-header">
        <div class="table-title">📋 Data Terbaru</div>
        <a href="tampil.php" class="btn btn-outline btn-sm">Lihat Semua →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Kelamin</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!$recent || mysqli_num_rows($recent) == 0): ?>
            <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:40px">Belum ada data penduduk</td></tr>
        <?php else: while($d = mysqli_fetch_assoc($recent)): ?>
            <tr>
                <td><code style="font-size:.8rem;color:var(--blue)"><?= htmlspecialchars($d['nik']) ?></code></td>
                <td><strong><?= htmlspecialchars($d['nama']) ?></strong></td>
                <td><?= $d['jenis_kelamin'] ?: '-' ?></td>
                <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($d['alamat']) ?></td>
                <td>
                    <?php if(!empty($d['foto'])): ?>
                        <img src="upload/<?= htmlspecialchars($d['foto']) ?>" class="avatar-img">
                    <?php else: ?>
                        <span style="color:var(--muted);font-size:.78rem">—</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="lihat.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">👁 Lihat</a>
                </td>
            </tr>
        <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
