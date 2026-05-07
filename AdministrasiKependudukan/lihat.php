<?php
include 'session.php';
include 'koneksi.php';
$pageTitle = 'Detail Penduduk';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tampil.php");
    exit;
}

$id   = (int) $_GET['id'];
$q    = mysqli_query($conn, "SELECT * FROM penduduk WHERE id='$id'");
if (!$q || mysqli_num_rows($q) == 0) {
    header("Location: tampil.php");
    exit;
}
$d = mysqli_fetch_assoc($q);

include 'header.php';
?>

<div style="max-width:680px; margin:0 auto;">

    <!-- BACK -->
    <div style="margin-bottom:20px;">
        <a href="tampil.php" class="btn btn-outline">← Kembali ke Daftar</a>
    </div>

    <!-- DETAIL CARD -->
    <div class="form-card">
        <div class="form-card-header">
            <span style="font-size:24px;">👤</span>
            <div>
                <h4>Detail Data Penduduk</h4>
                <p style="font-size:.78rem; color:var(--muted); margin-top:2px;">NIK: <?= htmlspecialchars($d['nik']) ?></p>
            </div>
        </div>
        <div class="form-card-body">

            <!-- FOTO -->
            <div style="text-align:center; margin-bottom:28px;">
                <?php if (!empty($d['foto'])): ?>
                    <img src="upload/<?= htmlspecialchars($d['foto']) ?>"
                         style="width:140px; height:140px; object-fit:cover; border-radius:16px; border:3px solid var(--border);">
                <?php else: ?>
                    <div style="width:140px; height:140px; border-radius:16px; background:#f0f4ff;
                                border:2px dashed var(--border); display:inline-flex;
                                align-items:center; justify-content:center; flex-direction:column; gap:8px;">
                        <span style="font-size:40px;">👤</span>
                        <span style="font-size:.72rem; color:var(--muted);">Tidak ada foto</span>
                    </div>
                <?php endif; ?>
                <div style="margin-top:12px;">
                    <strong style="font-size:1.1rem;"><?= htmlspecialchars($d['nama']) ?></strong>
                </div>
            </div>

            <!-- DATA TABLE -->
            <div style="border:1px solid var(--border); border-radius:12px; overflow:hidden;">
                <table style="width:100%; border-collapse:collapse;">
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:14px 18px; font-size:.8rem; font-weight:700; color:var(--muted); text-transform:uppercase; width:35%; background:#f8faff;">NIK</td>
                        <td style="padding:14px 18px; font-size:.9rem; color:var(--text);">
                            <code style="color:var(--blue); font-size:.88rem;"><?= htmlspecialchars($d['nik']) ?></code>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:14px 18px; font-size:.8rem; font-weight:700; color:var(--muted); text-transform:uppercase; background:#f8faff;">Nama Lengkap</td>
                        <td style="padding:14px 18px; font-size:.9rem; color:var(--text); font-weight:600;"><?= htmlspecialchars($d['nama']) ?></td>
                    </tr>
                    <?php if (!empty($d['jenis_kelamin'])): ?>
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:14px 18px; font-size:.8rem; font-weight:700; color:var(--muted); text-transform:uppercase; background:#f8faff;">Jenis Kelamin</td>
                        <td style="padding:14px 18px; font-size:.9rem; color:var(--text);">
                            <?= $d['jenis_kelamin'] == 'Laki-laki' ? '♂ Laki-laki' : '♀ Perempuan' ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td style="padding:14px 18px; font-size:.8rem; font-weight:700; color:var(--muted); text-transform:uppercase; background:#f8faff;">Alamat</td>
                        <td style="padding:14px 18px; font-size:.9rem; color:var(--text); line-height:1.6;"><?= htmlspecialchars($d['alamat']) ?></td>
                    </tr>
                </table>
            </div>

            <!-- ACTIONS -->
            <div style="display:flex; gap:10px; margin-top:24px; flex-wrap:wrap;">
                <a href="tampil.php" class="btn btn-outline">← Kembali</a>
                <?php if(isAdmin()): ?>
                <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning">✏️ Edit Data</a>
                <a href="delete.php?id=<?= $d['id'] ?>" class="btn btn-danger"
                   onclick="return confirm('Yakin hapus data <?= htmlspecialchars($d['nama']) ?>?')">🗑 Hapus</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
