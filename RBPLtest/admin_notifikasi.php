<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pelanggan - Admin Dashboard</title>
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
                    <li class="active"><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h1>Notifikasi Pesanan Pelanggan</h1>
                <div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div>
            </header>
            <section class="order-list">
                <?php
                $orders = [['id' => 'INV/001', 'customer' => 'Budi Santoso', 'time' => '2 menit yang lalu', 'status' => 'pending', 'items' => ['Sunlight x2', 'Chitato x1']],['id' => 'INV/002', 'customer' => 'Ani Yudhoyono', 'time' => '15 menit yang lalu', 'status' => 'processing', 'items' => ['Rinso x1']],['id' => 'INV/003', 'customer' => 'Joko Widodo', 'time' => '1 jam yang lalu', 'status' => 'shipped', 'items' => ['Gula Pasir x5', 'Kapal Api x10']],['id' => 'INV/004', 'customer' => 'Prabowo Subianto', 'time' => '3 jam yang lalu', 'status' => 'completed', 'items' => ['Beras Tawon x1']]];
                foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header"><div class="order-indicator status-<?php echo $order['status']; ?>"><i class="fas fa-receipt"></i></div><div class="order-info"><h4>Pesanan Baru - #<?php echo $order['id']; ?></h4><p>Dari: <?php echo $order['customer']; ?> &bull; <?php echo $order['time']; ?></p></div></div>
                    <div class="order-body"><h5>Detail Pesanan:</h5><ul><?php foreach($order['items'] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?></ul><h5>Kontrol Status Pesanan Pelanggan:</h5><div class="status-controls"><button class="status-btn pending <?php if($order['status'] == 'pending') echo 'active'; ?>">Menunggu</button><button class="status-btn processing <?php if($order['status'] == 'processing') echo 'active'; ?>">Diproses</button><button class="status-btn shipped <?php if($order['status'] == 'shipped') echo 'active'; ?>">Dikirim</button><button class="status-btn completed <?php if($order['status'] == 'completed') echo 'active'; ?>">Selesai</button></div></div>
                </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>
</html>
