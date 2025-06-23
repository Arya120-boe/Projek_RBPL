<?php 
require_once 'koneksi.php';
include 'admin_header.php'; 
?>
<title>Pantau Pengantaran - Admin Dashboard</title>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sidebar-nav li').forEach(item => {
            item.classList.remove('active');
        });
        const activeMenu = document.querySelector('.sidebar-nav a[href="admin_mengantar.php"]');
        if (activeMenu) {
            activeMenu.parentElement.classList.add('active');
        }
    });
</script>

<main class="main-content">
    <header class="main-header">
        <h1>Pantau Pengantaran</h1>
        <div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div>
    </header>
    <section class="delivery-grid">
        <?php
        // Mengambil data kurir yang sedang aktif mengantar pesanan
        $query_delivery = "
            SELECT 
                u.fullname as courier_name,
                o.customer_name as customer_name
            FROM courier_tasks ct
            JOIN users u ON ct.courier_id = u.id
            JOIN orders o ON ct.order_id = o.id
            WHERE ct.status = 'accepted' AND o.status = 'shipped'
        ";
        $result_delivery = mysqli_query($koneksi, $query_delivery);
        if ($result_delivery && mysqli_num_rows($result_delivery) > 0):
            while($delivery = mysqli_fetch_assoc($result_delivery)):
        ?>
        <div class="delivery-card">
            <div class="delivery-driver"><?php echo htmlspecialchars($delivery['courier_name']); ?></div>
            <div class="delivery-customer"><?php echo htmlspecialchars($delivery['customer_name']); ?></div>
        </div>
        <?php endwhile; else: ?>
            <p>Tidak ada kurir yang sedang mengantar pesanan saat ini.</p>
        <?php endif; ?>

        <!-- Kartu Tambah statis -->
        <div class="delivery-card add-new">
            <i class="fas fa-plus"></i>
        </div>
        <div class="delivery-card add-new">
            <i class="fas fa-plus"></i>
        </div>
    </section>
</main>
<?php include 'admin_footer.php'; ?>
