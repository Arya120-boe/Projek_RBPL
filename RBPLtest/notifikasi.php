<?php include 'header.php'; ?>
<title>Notifikasi - Toko Digital</title>
<style>
    .notification-page {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .notification-page h1 {
        font-size: 2rem;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
    }
    .notification-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .notification-item {
        display: flex;
        gap: 20px;
        padding: 20px 10px;
        border-bottom: 1px solid var(--border-color);
        transition: background-color 0.3s ease;
    }
    .notification-item:last-child {
        border-bottom: none;
    }
    .notification-item:hover {
        background-color: #f9f9f9;
    }
    .notification-item.unread {
        background-color: var(--light-yellow);
        border-left: 4px solid var(--primary-yellow);
        padding-left: 16px;
    }
    .notification-icon {
        font-size: 1.8rem;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
    }
    .icon-pesanan { background-color: #3498db; }
    .icon-promo { background-color: #e67e22; }
    .icon-info { background-color: #2ecc71; }

    .notification-content {
        flex-grow: 1;
    }
    .notification-content p {
        margin: 0;
        line-height: 1.6;
    }
    .notification-content strong {
        color: var(--dark-text);
    }
    .notification-time {
        font-size: 0.85rem;
        color: var(--light-text);
        margin-top: 5px;
    }
</style>

<main class="container">
    <div class="notification-page">
        <h1>Notifikasi</h1>
        <ul class="notification-list">
            <?php
            // Simulasi Data Notifikasi
            $notifications = [
                ['type' => 'pesanan', 'icon' => 'fa-box', 'title' => 'Pesanan Dikirim', 'desc' => 'Pesananmu <strong>INV/2025/06/13/001</strong> dengan produk Sunlight telah dikirim.', 'time' => '5 menit yang lalu', 'read' => false],
                ['type' => 'promo', 'icon' => 'fa-tags', 'title' => 'Promo Spesial Untukmu!', 'desc' => 'Diskon 50% untuk semua produk sabun. Jangan sampai kehabisan!', 'time' => '1 jam yang lalu', 'read' => false],
                ['type' => 'pesanan', 'icon' => 'fa-check-circle', 'title' => 'Pesanan Selesai', 'desc' => 'Pesanan <strong>INV/2025/06/12/089</strong> telah selesai. Beri rating untuk toko?', 'time' => 'Kemarin, 19:30', 'read' => true],
                ['type' => 'info', 'icon' => 'fa-wallet', 'title' => 'Top Up Berhasil', 'desc' => 'Saldo GoPay kamu berhasil diisi sebesar Rp 100.000.', 'time' => '11 Juni 2025, 08:15', 'read' => true],
                 ['type' => 'pesanan', 'icon' => 'fa-receipt', 'title' => 'Menunggu Pembayaran', 'desc' => 'Segera selesaikan pembayaran untuk pesanan <strong>INV/2025/06/13/001</strong> sebelum dibatalkan.', 'time' => '2 jam yang lalu', 'read' => true],
            ];
            
            foreach ($notifications as $notif): ?>
                <li class="notification-item <?php echo !$notif['read'] ? 'unread' : ''; ?>">
                    <div class="notification-icon icon-<?php echo $notif['type']; ?>">
                        <i class="fas <?php echo $notif['icon']; ?>"></i>
                    </div>
                    <div class="notification-content">
                        <p><strong><?php echo $notif['title']; ?></strong></p>
                        <p><?php echo $notif['desc']; ?></p>
                        <p class="notification-time"><?php echo $notif['time']; ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php include 'footer.php'; ?>
