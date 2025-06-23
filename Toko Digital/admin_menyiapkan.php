<?php 
require_once 'koneksi.php';
// Memanggil header admin yang baru
include 'admin_header.php'; 
?>
<title>Menyiapkan Pesanan - Admin Dashboard</title>
<script>
    // Script untuk menandai menu sidebar yang aktif
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sidebar-nav li').forEach(item => {
            item.classList.remove('active');
        });
        const activeMenu = document.querySelector('.sidebar-nav a[href="admin_menyiapkan.php"]');
        if (activeMenu) {
            activeMenu.parentElement.classList.add('active');
        }
    });
</script>

<!-- Konten utama halaman -->
<main class="main-content">
    <header class="main-header">
        <h1>Menyiapkan Pesanan</h1>
         <div class="admin-profile">
            <span>ADMIN ONLY</span>
            <i class="fas fa-user-shield"></i>
        </div>
    </header>

    <div class="prepare-order-layout">
        <div class="prepare-top-section">
            <!-- Daftar Pesanan yang Perlu Disiapkan -->
            <div class="orders-to-prepare">
                <h4>Pesanan Masuk (Status: Diproses)</h4>
                <div class="order-to-prepare-grid">
                    <?php
                    // Ambil pesanan yang statusnya 'processing' untuk ditampilkan sebagai preview
                    $query_processing = "SELECT * FROM orders WHERE status = 'processing' LIMIT 3";
                    $result_processing = mysqli_query($koneksi, $query_processing);
                    if(mysqli_num_rows($result_processing) > 0):
                        while($order = mysqli_fetch_assoc($result_processing)):
                    ?>
                    <div class="order-to-prepare-card">
                        <p>#<?php echo htmlspecialchars($order['no_transaksi']); ?></p>
                        <span><?php echo htmlspecialchars($order['customer_name']); ?></span>
                    </div>
                    <?php 
                        endwhile;
                    else:
                        echo "<p>Tidak ada pesanan yang perlu disiapkan.</p>";
                    endif;
                    ?>
                </div>
            </div>

            <!-- Notifikasi Driver -->
            <div class="driver-notification-panel">
                <h4>Aktivitas Driver Terbaru</h4>
                <div class="driver-notif-item">
                    <p><strong>Driver Ojol-01</strong> menerima batch pengantaran baru.</p>
                    <span>1 menit yang lalu</span>
                </div>
                 <div class="driver-notif-item">
                    <p><strong>Driver Ojol-03</strong> menyelesaikan pengantaran.</p>
                    <span>5 menit yang lalu</span>
                </div>
            </div>
        </div>

        <!-- Area Aksi -->
        <div class="preparation-area">
            <!-- Tombol ini sekarang menjadi link ke halaman pembuatan batch -->
            <a href="admin_create_batch.php" class="add-preparation-batch">
                <i class="fas fa-plus"></i>
                <p>Siapkan Batch Pengantaran Baru</p>
            </a>
        </div>
    </div>
</main>
<?php 
// Memanggil footer admin yang baru
include 'admin_footer.php'; 
?>
