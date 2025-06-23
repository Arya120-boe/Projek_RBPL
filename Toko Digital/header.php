<?php 
// Selalu mulai session di setiap halaman yang menggunakan header ini
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Digital</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<header>
    <div class="container header-content">
        <a href="index.php" class="logo-link"><div class="logo">TOKO<br>DIGITAL</div></a>
        <div class="search-bar">
            <input type="text" placeholder="Cari Barang/Kategori...">
            <button><i class="fa fa-search"></i></button>
        </div>
        <div class="user-icons">
            <a href="#" class="cart-icon-wrapper">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-item-count">0</span>
            </a>
            <a href="notifikasi.php"><i class="fa fa-bell"></i></a>
            
            <div class="profile-dropdown">
                <a href="#" class="profile-icon-link">
                    <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- JIKA PENGGUNA SUDAH LOGIN -->
                        <div class="dropdown-header">Hai, <strong><?php echo strtok($_SESSION['user_fullname'], " "); ?></strong></div>
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a>
                        <?php elseif ($_SESSION['user_role'] === 'kurir'): ?>
                            <a href="courier_dashboard.php"><i class="fas fa-motorcycle"></i> Dasbor Pengantaran</a>
                        <?php endif; ?>
                        <a href="#"><i class="fas fa-user-circle"></i> Profil Saya</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else: ?>
                        <!-- JIKA PENGGUNA BELUM LOGIN -->
                        <a href="login.php"><i class="fas fa-user-circle"></i> Login Pengguna</a>
                        <a href="admin_login.php"><i class="fas fa-user-shield"></i> Login Admin</a>
                        <a href="courier_login.php"><i class="fas fa-truck"></i> Login Kurir</a>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</header>
<!-- Struktur HTML untuk Keranjang Belanja & Notifikasi -->
<div class="cart-overlay"></div>
<aside class="cart-sidebar">
    <div class="cart-header">
        <h3>Keranjang Anda</h3>
        <button class="close-cart-btn">&times;</button>
    </div>
    <div class="cart-items">
        <div class="cart-empty-message">
            <i class="fa fa-shopping-basket"></i>
            <p>Keranjang Anda masih kosong.</p>
        </div>
    </div>
    <div class="cart-footer">
        <div class="cart-subtotal">
            <span>Subtotal</span>
            <span id="cart-subtotal-value">Rp 0</span>
        </div>
        <a href="checkout.php" class="btn btn-primary btn-full" id="checkout-link">Lanjut ke Pembayaran</a>
    </div>
</aside>
<div id="toast-notification" class="toast-notification"></div>
