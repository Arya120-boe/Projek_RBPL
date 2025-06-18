<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman akan diatur di setiap file utama -->
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <div class="container header-content">
        <a href="index.php" class="logo-link"><div class="logo">TOKO<br>DIGITAL</div></a>
        <div class="search-bar">
            <input type="text" placeholder="Cari Barang/Kategori">
            <button><i class="fa fa-search"></i></button>
        </div>
        <div class="user-icons">
            <a href="#" class="cart-icon-wrapper">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-item-count">0</span>
            </a>
            <a href="notifikasi.php"><i class="fa fa-bell"></i></a>
            <a href="login.php"><i class="fa fa-user"></i></a> <!-- Tautan diperbarui di sini -->
        </div>
    </div>
</header>

<!-- Cart Sidebar -->
<div class="cart-overlay"></div>
<aside class="cart-sidebar">
    <div class="cart-header">
        <h3>Keranjang Anda</h3>
        <button class="close-cart-btn">&times;</button>
    </div>
    <div class="cart-items">
        <div class="cart-empty-message" style="display: none;">
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

<!-- Toast Notification -->
<div id="toast-notification" class="toast-notification"></div>
