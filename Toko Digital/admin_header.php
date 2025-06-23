<?php
// Selalu mulai session di setiap halaman admin
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Jika pengguna belum login atau perannya bukan 'admin', paksa kembali ke halaman login
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['error'] = "Anda harus login sebagai admin untuk mengakses halaman ini.";
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TOKO DIGITAL</h2>
                <span>ADMIN PANEL</span>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>
