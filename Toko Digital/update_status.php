<?php
require_once 'koneksi.php';

// Pastikan data dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
    $new_status = isset($_POST['new_status']) ? mysqli_real_escape_string($koneksi, $_POST['new_status']) : '';

    if ($order_id > 0 && !empty($new_status)) {
        
        // 1. Update status pesanan di tabel 'orders'
        $query_update_order = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
        mysqli_query($koneksi, $query_update_order);

        // 2. Jika statusnya "shipped", buat tugas baru untuk kurir
        if ($new_status === 'shipped') {
            // Periksa dulu apakah tugas sudah ada, jika belum, buat baru.
            // ON DUPLICATE KEY UPDATE akan memperbarui jika sudah ada, atau membuat baru jika belum.
            $query_create_task = "INSERT INTO courier_tasks (order_id, status) VALUES ($order_id, 'waiting') ON DUPLICATE KEY UPDATE status='waiting', courier_id=NULL, accepted_at=NULL";
            mysqli_query($koneksi, $query_create_task);
        }
    }
}

// Setelah selesai, kembalikan admin ke halaman notifikasi
header("Location: admin_notifikasi.php");
exit();
?>
