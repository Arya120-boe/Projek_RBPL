<?php
session_start();
require_once 'koneksi.php';

// Pastikan kurir sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'kurir') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = (int)$_POST['task_id'];
    $order_id = (int)$_POST['order_id'];
    $courier_id = (int)$_SESSION['user_id'];

    // 1. Update tabel courier_tasks: set courier_id dan ubah status menjadi 'accepted'
    $query_task = "UPDATE courier_tasks SET courier_id = $courier_id, status = 'accepted', accepted_at = NOW() WHERE id = $task_id AND status = 'waiting'";
    mysqli_query($koneksi, $query_task);

    // 2. Update tabel orders: ubah status menjadi 'shipped'
    $query_order = "UPDATE orders SET status = 'shipped' WHERE id = $order_id";
    mysqli_query($koneksi, $query_order);
}

// Kembalikan kurir ke dasbornya
header("Location: courier_dashboard.php");
exit();
?>
