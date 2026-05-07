<?php
include 'session.php';
requireAdmin();
include 'koneksi.php';
$pageTitle = 'Tambah Data Penduduk';
include 'header.php';
?>

<div class="form-card">
    <div class="form-card-header">
        <span style="font-size:24px">📝</span>
        <div>
            <h4>Form Data Penduduk</h4>
            <p style="font-size:.8rem;color:var(--muted);margin-top:2px">Isi seluruh data dengan benar dan lengkap</p>
        </div>
        <a href="tampil.php" class="btn btn-outline btn-sm" style="margin-left:auto">← Kembali</a>
    </div>
    <div class="form-card-body">
        <?php if(isset($_GET['err'])): ?>
        <div class="alert alert-danger">⚠️ <?= htmlspecialchars($_GET['err']) ?></div>
        <?php endif; ?>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <div style="margin-bottom:24px">
                <div style="font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:var(--muted);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">
                    📌 Identitas Utama
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>NIK *</label>
                        <input type="text" name="nik" maxlength="16" placeholder="16 digit NIK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="nama" placeholder="Nama sesuai KTP" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Kota/Kabupaten">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama">
                            <option value="">-- Pilih --</option>
                            <option>Islam</option><option>Kristen</option>
                            <option>Katolik</option><option>Hindu</option>
                            <option>Buddha</option><option>Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Status Perkawinan</label>
                        <select name="status_perkawinan">
                            <option value="">-- Pilih --</option>
                            <option>Belum Kawin</option>
                            <option>Kawin</option>
                            <option>Cerai Hidup</option>
                            <option>Cerai Mati</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" placeholder="Jenis pekerjaan">
                    </div>
                </div>
            </div>

            <div style="margin-bottom:24px">
                <div style="font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:var(--muted);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">
                    📍 Alamat
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap *</label>
                    <textarea name="alamat" placeholder="Jalan, nomor rumah..." required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" name="rt" placeholder="001">
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" name="rw" placeholder="001">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Kelurahan/Desa</label>
                        <input type="text" name="kelurahan" placeholder="Nama kelurahan">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" placeholder="Nama kecamatan">
                    </div>
                </div>
            </div>

            <div style="margin-bottom:28px">
                <div style="font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:var(--muted);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">
                    📷 Foto KTP
                </div>
                <div class="form-group">
                    <label>Upload Foto KTP</label>
                    <input type="file" name="foto" accept="image/*">
                    <p style="font-size:.75rem;color:var(--muted);margin-top:5px">Format: JPG, PNG. Maks 2MB.</p>
                </div>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-success" style="padding:13px 28px;font-size:.95rem">
                    💾 Simpan Data
                </button>
                <a href="tampil.php" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
