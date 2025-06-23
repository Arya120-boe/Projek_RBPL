<?php
session_start();
require_once 'koneksi.php';

// Pastikan data dikirim dari form checkout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_data'])) {

    // Ambil data dari formulir
    $customer_name = mysqli_real_escape_string($koneksi, $_POST['customer_name']);
    $customer_address = mysqli_real_escape_string($koneksi, $_POST['customer_address']);
    $payment_method = mysqli_real_escape_string($koneksi, $_POST['payment_method']);
    
    // Ambil data keranjang dari input tersembunyi
    $cart = json_decode($_POST['cart_data'], true);
    if (json_last_error() !== JSON_ERROR_NONE || empty($cart)) {
        die("Error: Data keranjang tidak valid.");
    }

    // Hitung total
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping_cost = 15000;
    $total_bayar = $subtotal + $shipping_cost;

    // Buat data untuk tabel 'orders'
    $no_transaksi = 'INV/' . date('Ymd') . '/' . rand(1000, 9999);
    $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 'NULL';

    // 1. Masukkan data ke tabel 'orders'
    $query_order = "INSERT INTO orders (no_transaksi, user_id, customer_name, customer_address, total_bayar, kode_bayar, status) 
                    VALUES ('$no_transaksi', $user_id, '$customer_name', '$customer_address', '$total_bayar', '$payment_method', 'pending')";

    if (mysqli_query($koneksi, $query_order)) {
        // Ambil ID dari order yang baru saja dibuat
        $order_id = mysqli_insert_id($koneksi);

        // 2. Masukkan setiap item ke tabel 'order_items'
        foreach ($cart as $item) {
            $product_id = mysqli_real_escape_string($koneksi, $item['id']);
            $product_name = mysqli_real_escape_string($koneksi, $item['name']);
            $quantity = (int)$item['quantity'];
            $price = (int)$item['price'];

            $query_item = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) 
                           VALUES ('$order_id', '$product_id', '$product_name', '$quantity', '$price')";
            mysqli_query($koneksi, $query_item);
        }

        // 3. Arahkan ke halaman nota dengan ID order
        header("Location: nota.php?order_id=" . $order_id);
        exit();

    } else {
        echo "Error saat menyimpan pesanan: " . mysqli_error($koneksi);
    }
} else {
    // Jika diakses langsung, kembalikan ke halaman utama
    header("Location: index.php");
    exit();
}
?>
