<?php
session_start();
require_once 'koneksi.php';

// Pastikan yang login adalah kurir
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'kurir') {
    header("Location: login.php");
    exit();
}
$courier_id = $_SESSION['user_id'];
include 'header.php';
?>
<title>Dasbor Kurir - Toko Digital</title>
<main class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <h1 style="margin-top: 0;">Dasbor Pengantaran</h1>
    
    <!-- Bagian untuk Tugas yang Sedang Diantar oleh Kurir Ini -->
    <section class="task-section" style="margin-bottom: 50px;">
        <h2><i class="fas fa-motorcycle" style="margin-right: 10px; color: var(--green);"></i>Tugas Saya Saat Ini</h2>
        <div class="task-list" style="display: flex; flex-direction: column; gap: 20px;">
            <?php
            // Ambil tugas yang sedang diantar oleh kurir yang login
            $query_my_tasks = "SELECT o.*, ct.id as task_id FROM orders o JOIN courier_tasks ct ON o.id = ct.order_id WHERE ct.courier_id = $courier_id AND o.status = 'shipped'";
            $result_my_tasks = mysqli_query($koneksi, $query_my_tasks);

            if ($result_my_tasks && mysqli_num_rows($result_my_tasks) > 0):
                while($task = mysqli_fetch_assoc($result_my_tasks)):
            ?>
            <div class="task-card" style="background: #e8f5e9; border-left: 5px solid var(--green);">
                <div class="task-header"><h3 style="margin:0;">Pesanan #<?php echo htmlspecialchars($task['no_transaksi']); ?></h3></div>
                <div class="task-body">
                    <p><strong>Nama Pemesan:</strong> <?php echo htmlspecialchars($task['customer_name']); ?></p>
                    <p><strong>Alamat Tujuan:</strong> <?php echo htmlspecialchars($task['customer_address']); ?></p>
                </div>
                <div class="task-actions" style="text-align:right;">
                    <!-- Tombol ini akan mengirim data ke complete_task.php -->
                    <form action="complete_task.php" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $task['id']; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                        <button type="submit" class="btn btn-primary">Selesai Diantar</button>
                    </form>
                </div>
            </div>
            <?php endwhile; else: ?>
            <p>Anda sedang tidak memiliki tugas pengantaran.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Bagian untuk Tugas yang Tersedia untuk Diambil -->
    <section class="task-section">
        <h2><i class="fas fa-tasks" style="margin-right: 10px; color: var(--primary-blue);"></i>Tugas Tersedia Untuk Diambil</h2>
        <div class="task-list" style="display: flex; flex-direction: column; gap: 20px;">
             <?php
            // Ambil semua tugas yang statusnya 'waiting' (belum diambil kurir manapun)
            $query_available_tasks = "SELECT o.*, ct.id as task_id FROM orders o JOIN courier_tasks ct ON o.id = ct.order_id WHERE ct.status = 'waiting'";
            $result_available_tasks = mysqli_query($koneksi, $query_available_tasks);
            if ($result_available_tasks && mysqli_num_rows($result_available_tasks) > 0):
                while($task = mysqli_fetch_assoc($result_available_tasks)):
            ?>
            <div class="task-card">
                <div class="task-header"><h3 style="margin:0;">Pesanan #<?php echo htmlspecialchars($task['no_transaksi']); ?></h3></div>
                <div class="task-body">
                    <p><strong>Nama Pemesan:</strong> <?php echo htmlspecialchars($task['customer_name']); ?></p>
                    <p><strong>Alamat Tujuan:</strong> <?php echo htmlspecialchars($task['customer_address']); ?></p>
                </div>
                <div class="task-actions" style="text-align:right;">
                    <!-- Tombol ini mengirim data ke accept_task.php -->
                    <form action="accept_task.php" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $task['id']; ?>">
                        <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                        <button type="submit" class="btn btn-secondary">Ambil Tugas Ini</button>
                    </form>
                </div>
            </div>
            <?php endwhile; else: ?>
            <p>Tidak ada tugas baru yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
