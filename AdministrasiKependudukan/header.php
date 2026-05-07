<?php
// header.php - include after session.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $pageTitle ?? 'Sistem Kependudukan' ?></title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --navy: #0b1437;
    --navy2: #112057;
    --sidebar-w: 260px;
    --blue: #1a56db;
    --blue-light: #3b82f6;
    --cyan: #06b6d4;
    --gold: #f59e0b;
    --green: #10b981;
    --red: #ef4444;
    --bg: #f0f4ff;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --border: #e2e8f0;
    --sidebar-text: rgba(255,255,255,.75);
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }

/* SIDEBAR */
.sidebar {
    position: fixed; top:0; left:0; bottom:0;
    width: var(--sidebar-w);
    background: var(--navy);
    display: flex; flex-direction: column;
    z-index: 100;
    overflow: hidden;
}
.sidebar::before {
    content:'';
    position:absolute; inset:0;
    background: radial-gradient(ellipse at 0% 0%, rgba(26,86,219,.4) 0%, transparent 60%),
                radial-gradient(ellipse at 100% 100%, rgba(6,182,212,.2) 0%, transparent 60%);
    pointer-events:none;
}
.sidebar-brand {
    padding: 28px 24px 24px;
    border-bottom: 1px solid rgba(255,255,255,.07);
    position: relative;
}
.brand-logo-sm {
    width:44px; height:44px; border-radius:12px;
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    display:flex; align-items:center; justify-content:center;
    font-size:20px; margin-bottom:12px;
    box-shadow: 0 8px 24px rgba(26,86,219,.4);
}
.sidebar-brand h2 { font-size:.92rem; font-weight:800; color:#fff; line-height:1.3; }
.sidebar-brand p  { font-size:.72rem; color:rgba(255,255,255,.4); margin-top:2px; }

.sidebar-nav { flex:1; padding:16px 12px; overflow-y:auto; }
.nav-section-title {
    font-size:.65rem; font-weight:800; letter-spacing:1.5px;
    color: rgba(255,255,255,.25); text-transform:uppercase;
    padding: 8px 12px; margin-bottom:4px;
}
.nav-link {
    display:flex; align-items:center; gap:12px;
    padding:11px 14px; border-radius:10px;
    color: var(--sidebar-text); text-decoration:none;
    font-size:.87rem; font-weight:500;
    transition:.2s; margin-bottom:2px; position:relative;
}
.nav-link:hover { background:rgba(255,255,255,.07); color:#fff; }
.nav-link.active {
    background: linear-gradient(135deg, rgba(26,86,219,.6), rgba(59,130,246,.3));
    color: #fff; font-weight:700;
    box-shadow: 0 4px 12px rgba(26,86,219,.3);
}
.nav-link.active::before {
    content:''; position:absolute; left:0; top:50%; transform:translateY(-50%);
    width:3px; height:60%; background:var(--cyan); border-radius:0 3px 3px 0;
}
.nav-icon { font-size:18px; width:24px; text-align:center; }
.nav-badge {
    margin-left:auto; padding:2px 8px; border-radius:20px;
    font-size:.68rem; font-weight:700;
    background: rgba(6,182,212,.25); color:#67e8f9;
}

.sidebar-user {
    padding:16px; border-top:1px solid rgba(255,255,255,.07);
    display:flex; align-items:center; gap:12px;
}
.user-avatar {
    width:38px; height:38px; border-radius:10px;
    background: linear-gradient(135deg, var(--gold), #f97316);
    display:flex; align-items:center; justify-content:center;
    font-size:16px; font-weight:800; color:#fff; flex-shrink:0;
}
.user-info strong { display:block; font-size:.82rem; font-weight:700; color:#fff; }
.user-info span   { font-size:.72rem; color:rgba(255,255,255,.4); }
.user-role-badge {
    display:inline-block; margin-top:3px; padding:1px 7px;
    border-radius:20px; font-size:.65rem; font-weight:700;
}
.badge-admin-sm { background:rgba(26,86,219,.3); color:#93c5fd; }
.badge-user-sm  { background:rgba(16,185,129,.3); color:#6ee7b7; }

/* MAIN */
.main-wrap { margin-left:var(--sidebar-w); min-height:100vh; }
.topbar {
    position:sticky; top:0; z-index:50;
    background:rgba(240,244,255,.85);
    backdrop-filter:blur(12px);
    border-bottom:1px solid var(--border);
    padding: 0 32px;
    height: 64px;
    display:flex; align-items:center; justify-content:space-between;
}
.topbar-title { font-size:1.05rem; font-weight:700; color:var(--text); }
.topbar-right { display:flex; align-items:center; gap:12px; }
.topbar-pill {
    padding:6px 14px; border-radius:20px;
    font-size:.78rem; font-weight:600;
}
.pill-admin { background:#dbeafe; color:#1d4ed8; }
.pill-user  { background:#d1fae5; color:#065f46; }
.btn-logout {
    padding:8px 18px; border-radius:10px;
    background:var(--red); color:#fff;
    text-decoration:none; font-size:.82rem; font-weight:700;
    transition:.2s; border:none; cursor:pointer; font-family:inherit;
}
.btn-logout:hover { background:#dc2626; transform:translateY(-1px); }

.page-content { padding: 32px; }

/* CARDS */
.stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; margin-bottom:32px; }
.stat-card {
    background:var(--card); border-radius:16px; padding:24px;
    border:1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    transition:.25s;
}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,.08); }
.stat-icon {
    width:48px; height:48px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:22px; margin-bottom:16px;
}
.ic-blue  { background:#dbeafe; }
.ic-green { background:#d1fae5; }
.ic-gold  { background:#fef3c7; }
.ic-red   { background:#fee2e2; }
.stat-card h3 { font-size:1.9rem; font-weight:800; color:var(--text); }
.stat-card p  { font-size:.82rem; color:var(--muted); font-weight:500; margin-top:4px; }

/* TABLE */
.table-card { background:var(--card); border-radius:16px; border:1px solid var(--border); overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,.04); }
.table-header { padding:20px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.table-title { font-size:1rem; font-weight:700; color:var(--text); }
table { width:100%; border-collapse:collapse; }
thead { background:#f8faff; }
th { padding:13px 16px; text-align:left; font-size:.76rem; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.7px; border-bottom:1px solid var(--border); }
td { padding:14px 16px; font-size:.88rem; color:var(--text); border-bottom:1px solid #f1f5f9; }
tr:last-child td { border-bottom:none; }
tr:hover td { background:#f8faff; }

/* BUTTONS */
.btn {
    display:inline-flex; align-items:center; gap:6px;
    padding:8px 16px; border-radius:8px;
    font-family:inherit; font-size:.82rem; font-weight:600;
    text-decoration:none; cursor:pointer; border:none; transition:.2s;
}
.btn-primary  { background:var(--blue); color:#fff; }
.btn-primary:hover { background:#1e40af; }
.btn-success  { background:var(--green); color:#fff; }
.btn-success:hover { background:#059669; }
.btn-warning  { background:var(--gold); color:#fff; }
.btn-warning:hover { background:#d97706; }
.btn-danger   { background:var(--red); color:#fff; }
.btn-danger:hover { background:#dc2626; }
.btn-info     { background:var(--cyan); color:#fff; }
.btn-info:hover { background:#0891b2; }
.btn-sm { padding:6px 12px; font-size:.78rem; }
.btn-outline {
    background:transparent; border:1.5px solid var(--border);
    color:var(--muted);
}
.btn-outline:hover { border-color:var(--blue); color:var(--blue); background:#f0f4ff; }

/* FORM CARD */
.form-card { background:var(--card); border-radius:16px; border:1px solid var(--border); overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,.04); }
.form-card-header { padding:20px 28px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:12px; }
.form-card-header h4 { font-size:1rem; font-weight:700; color:var(--text); }
.form-card-body { padding:28px; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.form-group { margin-bottom:20px; }
.form-group label { display:block; font-size:.8rem; font-weight:700; color:#374151; margin-bottom:7px; letter-spacing:.3px; text-transform:uppercase; }
.form-group input,
.form-group textarea,
.form-group select {
    width:100%; padding:12px 14px;
    border:2px solid var(--border); border-radius:10px;
    font-family:inherit; font-size:.92rem; color:var(--text);
    outline:none; transition:.2s; background:#fafbff;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color:var(--blue); background:#fff;
    box-shadow:0 0 0 4px rgba(26,86,219,.08);
}
.form-group textarea { resize:vertical; min-height:90px; }

/* ALERT */
.alert { padding:14px 18px; border-radius:10px; margin-bottom:20px; font-size:.88rem; font-weight:500; }
.alert-danger  { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; }
.alert-success { background:#f0fdf4; color:#16a34a; border:1px solid #bbf7d0; }
.alert-warning { background:#fffbeb; color:#b45309; border:1px solid #fde68a; }

/* PHOTO */
.avatar-img { width:50px; height:50px; object-fit:cover; border-radius:8px; border:2px solid var(--border); }

/* ACCESS DENIED */
.access-denied {
    text-align:center; padding:60px 30px;
}
.access-denied h3 { font-size:1.4rem; color:var(--red); margin:16px 0 8px; }
.access-denied p  { color:var(--muted); }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo-sm">🏛️</div>
        <h2>Sistem Kependudukan</h2>
        <p>Versi 2.0</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Menu Utama</div>
        <a href="index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='index.php')?'active':'' ?>">
            <span class="nav-icon">🏠</span> Dashboard
        </a>
        <a href="tampil.php" class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='tampil.php')?'active':'' ?>">
            <span class="nav-icon">📊</span> Data Penduduk
        </a>
        <?php if(isAdmin()): ?>
        <a href="input.php" class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='input.php')?'active':'' ?>">
            <span class="nav-icon">➕</span> Tambah Data
        </a>
        <div class="nav-section-title" style="margin-top:12px">Manajemen</div>
        <a href="users.php" class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='users.php')?'active':'' ?>">
            <span class="nav-icon">👥</span> Kelola Pengguna
        </a>
        <?php endif; ?>
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar"><?= strtoupper(substr($_SESSION['nama'] ?? $_SESSION['username'], 0, 1)) ?></div>
        <div class="user-info">
            <strong><?= htmlspecialchars($_SESSION['nama'] ?? $_SESSION['username']) ?></strong>
            <span class="user-role-badge <?= isAdmin() ? 'badge-admin-sm' : 'badge-user-sm' ?>">
                <?= isAdmin() ? '🔑 Admin' : '👤 Petugas' ?>
            </span>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main-wrap">
    <div class="topbar">
        <div class="topbar-title"><?= $pageTitle ?? 'Dashboard' ?></div>
        <div class="topbar-right">
            <span class="topbar-pill <?= isAdmin() ? 'pill-admin' : 'pill-user' ?>">
                <?= isAdmin() ? '🔑 Administrator' : '👤 Petugas' ?>
            </span>
            <a href="logout.php" class="btn-logout">⬡ Logout</a>
        </div>
    </div>
    <div class="page-content">
