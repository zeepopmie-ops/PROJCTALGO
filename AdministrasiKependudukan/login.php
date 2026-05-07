<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['login'])) { header("Location: index.php"); exit; }

include 'koneksi.php';
$error = "";

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, trim($_POST['username']));
    $pass = md5(trim($_POST['password']));

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");

    if (!$q) {
        $error = "Database error: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($q) > 0) {
        $row = mysqli_fetch_assoc($q);
        $_SESSION['login']    = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']     = $row['role'];
        $_SESSION['nama']     = $row['nama_lengkap'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Sistem Kependudukan</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --navy: #0b1437;
    --navy2: #112057;
    --blue: #1a56db;
    --cyan: #06b6d4;
    --gold: #f59e0b;
    --light: #f0f4ff;
    --white: #ffffff;
    --card-bg: rgba(255,255,255,0.06);
    --border: rgba(255,255,255,0.12);
}
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    min-height: 100vh;
    background: var(--navy);
    display: flex;
    overflow: hidden;
}

/* ── LEFT PANEL ── */
.left-panel {
    width: 55%;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 60px;
    overflow: hidden;
}
.left-panel::before {
    content:'';
    position: absolute; inset:0;
    background: radial-gradient(ellipse at 30% 50%, rgba(26,86,219,.35) 0%, transparent 70%),
                radial-gradient(ellipse at 80% 20%, rgba(6,182,212,.2) 0%, transparent 60%);
}
.grid-bg {
    position: absolute; inset:0;
    background-image:
        linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size: 50px 50px;
}
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(70px);
    opacity: .25;
    animation: float 8s ease-in-out infinite;
}
.orb1 { width:320px; height:320px; background:#1a56db; top:-80px; left:-80px; animation-delay:0s; }
.orb2 { width:240px; height:240px; background:#06b6d4; bottom:40px; right:40px; animation-delay:-3s; }
.orb3 { width:180px; height:180px; background:#f59e0b; top:50%; left:60%; animation-delay:-6s; }

@keyframes float {
    0%,100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-30px) scale(1.05); }
}

.brand-content { position:relative; z-index:2; text-align:center; color:var(--white); }
.brand-logo {
    width:80px; height:80px; border-radius:20px;
    background: linear-gradient(135deg, var(--blue), var(--cyan));
    display:flex; align-items:center; justify-content:center;
    font-size:36px; margin: 0 auto 28px;
    box-shadow: 0 20px 60px rgba(26,86,219,.5);
}
.brand-content h1 {
    font-size: 2.4rem; font-weight:800; line-height:1.2;
    background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,.7) 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    margin-bottom:16px;
}
.brand-content p {
    font-size: 1rem; color: rgba(255,255,255,.55); line-height:1.7;
    max-width: 340px; margin: 0 auto 40px;
}
.feature-list { display:flex; flex-direction:column; gap:14px; text-align:left; width:100%; max-width:340px; }
.feature-item {
    display:flex; align-items:center; gap:14px;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 12px; padding:14px 18px;
    animation: slideIn .6s ease both;
}
.feature-item:nth-child(1){animation-delay:.1s}
.feature-item:nth-child(2){animation-delay:.2s}
.feature-item:nth-child(3){animation-delay:.3s}
@keyframes slideIn { from{opacity:0;transform:translateX(-20px)} to{opacity:1;transform:translateX(0)} }
.feature-icon { font-size:22px; }
.feature-text strong { display:block; font-size:.85rem; font-weight:600; color:#fff; }
.feature-text span  { font-size:.78rem; color:rgba(255,255,255,.45); }

/* ── RIGHT PANEL ── */
.right-panel {
    width: 45%;
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
    position: relative;
}
.right-panel::before {
    content:'';
    position: absolute; top:0; left:0;
    width:4px; height:100%;
    background: linear-gradient(180deg, var(--blue), var(--cyan), var(--gold));
}

.login-form-wrap { width:100%; max-width:380px; }
.form-title { font-size:1.9rem; font-weight:800; color:var(--navy); margin-bottom:6px; }
.form-sub   { font-size:.9rem; color:#64748b; margin-bottom:36px; }

.role-tabs {
    display:flex; gap:8px; margin-bottom:28px;
    background:#f1f5f9; border-radius:12px; padding:4px;
}
.role-tab {
    flex:1; padding:10px; border:none; border-radius:9px;
    background:transparent; cursor:pointer;
    font-family: inherit; font-size:.85rem; font-weight:600; color:#64748b;
    transition:.2s; display:flex; align-items:center; justify-content:center; gap:6px;
}
.role-tab.active {
    background: var(--white);
    color: var(--blue);
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
}

.field-group { margin-bottom:20px; }
.field-group label {
    display:block; font-size:.82rem; font-weight:700;
    color: #374151; margin-bottom:7px; letter-spacing:.3px;
    text-transform:uppercase;
}
.field-wrap { position:relative; }
.field-wrap input {
    width:100%; padding:14px 16px 14px 44px;
    border: 2px solid #e2e8f0; border-radius:12px;
    font-family:inherit; font-size:.95rem; color:#0f172a;
    outline:none; transition:.25s;
    background: #fafbff;
}
.field-wrap input:focus { border-color:var(--blue); background:#fff; box-shadow:0 0 0 4px rgba(26,86,219,.08); }
.field-icon {
    position:absolute; left:14px; top:50%; transform:translateY(-50%);
    font-size:18px; pointer-events:none;
}

.error-box {
    background:#fef2f2; color:#dc2626;
    border:1px solid #fecaca; border-radius:10px;
    padding:12px 16px; font-size:.85rem;
    margin-bottom:20px;
    display:flex; align-items:center; gap:8px;
}

.btn-login {
    width:100%; padding:16px;
    background: linear-gradient(135deg, var(--blue), #0e40af);
    color:#fff; border:none; border-radius:12px;
    font-family:inherit; font-size:1rem; font-weight:700;
    cursor:pointer; transition:.25s;
    box-shadow: 0 4px 20px rgba(26,86,219,.35);
    letter-spacing:.5px;
}
.btn-login:hover { transform:translateY(-2px); box-shadow: 0 8px 30px rgba(26,86,219,.45); }
.btn-login:active { transform:translateY(0); }

.demo-box {
    margin-top:28px; padding:16px;
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    border:1px solid #bae6fd; border-radius:12px;
}
.demo-box h5 { font-size:.8rem; font-weight:700; color:#0369a1; margin-bottom:10px; letter-spacing:.5px; text-transform:uppercase; }
.demo-accounts { display:flex; gap:8px; }
.demo-account {
    flex:1; padding:10px; border-radius:8px;
    background:rgba(255,255,255,.7); border:1px solid #bae6fd;
    cursor:pointer; transition:.2s; text-align:center;
}
.demo-account:hover { background:#fff; transform:scale(1.02); }
.demo-account .role-badge {
    display:inline-block; padding:2px 8px; border-radius:20px;
    font-size:.7rem; font-weight:700; margin-bottom:4px;
}
.badge-admin { background:#dbeafe; color:#1d4ed8; }
.badge-user  { background:#d1fae5; color:#065f46; }
.demo-account p { font-size:.75rem; color:#475569; }
.demo-account p b { color:#0f172a; }
</style>
</head>
<body>

<!-- LEFT -->
<div class="left-panel">
    <div class="grid-bg"></div>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="orb orb3"></div>

    <div class="brand-content">
        <div class="brand-logo">🏛️</div>
        <h1>Sistem Informasi<br>Kependudukan</h1>
        <p>Platform digital untuk pengelolaan data penduduk yang aman, cepat, dan terintegrasi.</p>

        <div class="feature-list">
            <div class="feature-item">
                <span class="feature-icon">🔐</span>
                <div class="feature-text">
                    <strong>Multi-Level Akses</strong>
                    <span>Admin & User dengan hak berbeda</span>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">📊</span>
                <div class="feature-text">
                    <strong>Dashboard Real-time</strong>
                    <span>Pantau statistik kependudukan</span>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">🔍</span>
                <div class="feature-text">
                    <strong>Pencarian Cepat</strong>
                    <span>Temukan data berdasarkan NIK & nama</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RIGHT -->
<div class="right-panel">
    <div class="login-form-wrap">
        <h2 class="form-title">Selamat Datang 👋</h2>
        <p class="form-sub">Masuk ke sistem dengan akun Anda</p>

        <!-- ROLE TABS -->
        <div class="role-tabs">
            <button class="role-tab active" onclick="setRole('admin',this)">🔑 Admin</button>
            <button class="role-tab" onclick="setRole('user',this)">👤 User</button>
        </div>

        <?php if($error): ?>
        <div class="error-box">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="field-group">
                <label>Username</label>
                <div class="field-wrap">
                    <span class="field-icon">👤</span>
                    <input type="text" name="username" id="inp_user" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>
            <div class="field-group">
                <label>Password</label>
                <div class="field-wrap">
                    <span class="field-icon">🔒</span>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn-login">MASUK SISTEM →</button>
        </form>

        <div class="demo-box">
            <h5>🧪 Akun Demo</h5>
            <div class="demo-accounts">
                <div class="demo-account" onclick="fillDemo('admin','2222')">
                    <div class="role-badge badge-admin">ADMIN</div>
                    <p>User: <b>admin</b><br>Pass: <b>2222</b></p>
                </div>
                <div class="demo-account" onclick="fillDemo('user','122')">
                    <div class="role-badge badge-user">USER</div>
                    <p>User: <b>user</b><br>Pass: <b>122</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setRole(role, el) {
    document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    if(role === 'admin') {
        document.getElementById('inp_user').placeholder = 'Username admin';
    } else {
        document.getElementById('inp_user').placeholder = 'Username petugas';
    }
}
function fillDemo(u, p) {
    document.querySelector('input[name=username]').value = u;
    document.querySelector('input[name=password]').value = p;
}
</script>
</body>
</html>
