<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Helper: cek apakah admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Helper: paksa harus admin
function requireAdmin() {
    if (!isAdmin()) {
        header("Location: index.php?err=akses");
        exit;
    }
}
?>
