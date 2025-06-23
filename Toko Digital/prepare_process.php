<?php
require_once 'koneksi.php';

// Pastikan data dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['prepare_order'])) {

    $order_id = (int)$_POST['order_id'];

    if ($order_id > 0) {
        // 1. Ubah status pesanan di tabel 'orders' menjadi 'siap diantar'
        $update_query = "UPDATE orders SET status = 'ready_for_delivery' WHERE id = $order_id";
        mysqli_query($koneksi, $update_query);

        // 2. Buat notifikasi tugas baru untuk kurir di tabel 'courier_tasks'
        // Ini akan membuat pesanan muncul di dasbor semua kurir
        $insert_query = "INSERT INTO courier_tasks (order_id, status) VALUES ($order_id, 'waiting') ON DUPLICATE KEY UPDATE status='waiting'";
        mysqli_query($koneksi, $insert_query);
    }
}

// Setelah selesai, kembalikan admin ke halaman "Menyiapkan Pesanan"
header("Location: admin_menyiapkan.php");
exit();
?>
