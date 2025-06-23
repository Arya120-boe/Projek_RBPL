<?php 
// Selalu mulai session untuk memeriksa status login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Memanggil header standar untuk halaman pengguna
include 'header.php'; 
?>
<title>Notifikasi - Toko Digital</title>
<style>
    /* Gaya CSS khusus untuk halaman notifikasi */
    .notification-page {
        max-width: 800px;
        margin: 40px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .notification-page h1 {
        font-size: 2.2rem;
        margin-top: 0;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 20px;
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
        background-color: var(--bg-gray);
    }
    .notification-item.unread {
        background-color: var(--light-yellow);
        font-weight: 500;
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
        flex-shrink: 0;
    }
    /* Warna ikon baru */
    .icon-pesanan { background-color: var(--primary-blue); }
    .icon-promo { background-color: var(--orange); }
    .icon-info { background-color: var(--green); }

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
            // --- Logika untuk menampilkan notifikasi ---
            $is_logged_in = isset($_SESSION['user_id']);
            
            // Simulasi Data Notifikasi dari database
            $all_notifications = [
                // Notifikasi Pribadi (hanya untuk pengguna yang login)
                ['type' => 'pesanan', 'icon' => 'fa-box', 'title' => 'Pesanan Dikirim', 'desc' => 'Pesanan Anda #INV/123 dengan produk Sunlight telah dikirim dan sedang dalam perjalanan.', 'time' => '5 menit yang lalu', 'read' => false, 'user_specific' => true],
                ['type' => 'pesanan', 'icon' => 'fa-check-circle', 'title' => 'Pesanan Selesai', 'desc' => 'Pesanan Anda #INV/122 telah sampai di tujuan. Jangan lupa beri rating!', 'time' => '2 jam yang lalu', 'read' => true, 'user_specific' => true],
                
                // Notifikasi Umum (untuk semua orang)
                ['type' => 'promo', 'icon' => 'fa-tags', 'title' => 'Promo Spesial Akhir Pekan!', 'desc' => 'Nikmati diskon hingga 30% untuk semua produk makanan dan minuman.', 'time' => '3 jam yang lalu', 'read' => false, 'user_specific' => false],
                ['type' => 'info', 'icon' => 'fa-info-circle', 'title' => 'Pembaruan Kebijakan Privasi', 'desc' => 'Kami telah memperbarui kebijakan privasi kami untuk meningkatkan keamanan data Anda.', 'time' => '1 hari yang lalu', 'read' => true, 'user_specific' => false],
                ['type' => 'promo', 'icon' => 'fa-truck', 'title' => 'Gratis Ongkir!', 'desc' => 'Dapatkan gratis ongkir tanpa minimum pembelian hingga akhir bulan ini.', 'time' => '2 hari yang lalu', 'read' => true, 'user_specific' => false],
            ];
            
            $notifications_to_display = [];
            foreach ($all_notifications as $notif) {
                // Jika pengguna sudah login, tampilkan semua notifikasi
                if ($is_logged_in) {
                    $notifications_to_display[] = $notif;
                } 
                // Jika belum login, hanya tampilkan notifikasi umum
                else if (!$notif['user_specific']) {
                    $notifications_to_display[] = $notif;
                }
            }

            if (empty($notifications_to_display)) {
                echo "<p>Tidak ada notifikasi untuk Anda saat ini.</p>";
            } else {
                foreach ($notifications_to_display as $notif): ?>
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
                <?php endforeach; 
            }
            ?>
        </ul>
    </div>
</main>

<?php include 'footer.php'; ?>
