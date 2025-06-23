<?php
session_start();
require_once 'koneksi.php';

// Pastikan kurir sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'kurir') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID dari form
    $task_id = (int)$_POST['task_id'];
    $order_id = (int)$_POST['order_id'];
    $courier_id = (int)$_SESSION['user_id'];

    // 1. Update status pesanan di tabel 'orders' menjadi 'completed'
    $query_order = "UPDATE orders SET status = 'completed' WHERE id = $order_id";
    mysqli_query($koneksi, $query_order);

    // 2. Update status tugas di tabel 'courier_tasks' menjadi 'delivered'
    // Pastikan hanya kurir yang bersangkutan yang bisa menyelesaikan tugasnya
    $query_task = "UPDATE courier_tasks SET status = 'delivered' WHERE id = $task_id AND courier_id = $courier_id";
    mysqli_query($koneksi, $query_task);

    // (Di aplikasi nyata, di sini Anda bisa menambahkan logika untuk memberi rating, dll.)
}

// Kembalikan kurir ke dasbornya setelah selesai
header("Location: courier_dashboard.php");
exit();
?>
