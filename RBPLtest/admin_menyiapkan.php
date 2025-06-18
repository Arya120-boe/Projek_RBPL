<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menyiapkan Pesanan - Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header"><h2>TOKO DIGITAL</h2><span>ADMIN PANEL</span></div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li class="active"><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h1>Menyiapkan Pesanan</h1>
                 <div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div>
            </header>
            <div class="prepare-order-layout">
                <div class="prepare-top-section">
                    <div class="orders-to-prepare">
                        <h4>Pesanan Masuk Siap Disiapkan</h4>
                        <div class="order-to-prepare-grid">
                            <div class="order-to-prepare-card"><p>#INV/001</p><span>Budi S.</span></div>
                            <div class="order-to-prepare-card"><p>#INV/002</p><span>Ani Y.</span></div>
                            <div class="order-to-prepare-card"><p>#INV/005</p><span>Citra L.</span></div>
                        </div>
                    </div>
                    <div class="driver-notification-panel">
                        <h4>Notifikasi Pesanan Driver</h4>
                        <div class="driver-notif-item"><p><strong>Driver Ojol-01</strong> menerima pesanan #INV/001.</p><span>1 menit yang lalu</span></div>
                         <div class="driver-notif-item"><p>Menunggu konfirmasi driver untuk pesanan #INV/002.</p><span>5 menit yang lalu</span></div>
                    </div>
                </div>
                <div class="preparation-area">
                    <button class="add-preparation-batch"><i class="fas fa-plus"></i><p>Siapkan Batch Pengantaran Baru</p></button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
