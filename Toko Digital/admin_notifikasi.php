<?php require_once 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pelanggan - Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
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
                // Ambil data pesanan terbaru dari database
                $query_orders = "SELECT * FROM orders ORDER BY tanggal DESC";
                $result_orders = mysqli_query($koneksi, $query_orders);

                if (mysqli_num_rows($result_orders) > 0):
                    while($order = mysqli_fetch_assoc($result_orders)):
                        // Ambil item untuk setiap pesanan
                        $items_query = "SELECT * FROM order_items WHERE order_id = " . $order['id'];
                        $items_result = mysqli_query($koneksi, $items_query);
                        $items = [];
                        while($item_row = mysqli_fetch_assoc($items_result)) {
                            $items[] = $item_row['product_name'] . ' x' . $item_row['quantity'];
                        }
                ?>
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-indicator status-<?php echo $order['status']; ?>">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="order-info">
                            <h4>Pesanan Baru - #<?php echo $order['no_transaksi']; ?></h4>
                            <p>Dari: <?php echo htmlspecialchars($order['customer_name']); ?> &bull; <?php echo date('d M Y, H:i', strtotime($order['tanggal'])); ?></p>
                        </div>
                    </div>
                    <div class="order-body">
                        <h5>Detail Pesanan:</h5>
                        <ul><?php foreach($items as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?></ul>
                        <h5>Kontrol Status Pesanan:</h5>
                        
                        <!-- PERUBAHAN DI SINI: Tombol menjadi form -->
                        <div class="status-controls">
                            <form action="update_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="pending">
                                <button type="submit" class="status-btn pending <?php if($order['status'] == 'pending') echo 'active'; ?>">Menunggu</button>
                            </form>
                             <form action="update_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="processing">
                                <button type="submit" class="status-btn processing <?php if($order['status'] == 'processing') echo 'active'; ?>">Diproses</button>
                            </form>
                            <form action="update_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="shipped">
                                <button type="submit" class="status-btn shipped <?php if($order['status'] == 'shipped') echo 'active'; ?>">Dikirim</button>
                            </form>
                             <form action="update_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="completed">
                                <button type="submit" class="status-btn completed <?php if($order['status'] == 'completed') echo 'active'; ?>">Selesai</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; else: ?>
                    <p>Belum ada pesanan yang masuk.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
