<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
    $new_status = isset($_POST['new_status']) ? mysqli_real_escape_string($koneksi, $_POST['new_status']) : '';

    if ($order_id > 0 && !empty($new_status)) {
        $query = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
        mysqli_query($koneksi, $query);

        // Jika status diubah menjadi 'siap diantar', buat tugas untuk kurir
        if ($new_status === 'ready_for_delivery') {
             $insert_task_query = "INSERT INTO courier_tasks (order_id, status) VALUES ($order_id, 'waiting') ON DUPLICATE KEY UPDATE status='waiting'";
             mysqli_query($koneksi, $insert_task_query);
        }
    }
}

// Kembalikan admin ke halaman sebelumnya
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
