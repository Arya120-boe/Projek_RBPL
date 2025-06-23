<?php
// Hubungkan ke database
require_once 'koneksi.php';

// Mulai session untuk menyimpan pesan notifikasi
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    // Enkripsi password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan pengguna baru dengan peran 'kurir'
    $query = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$hashed_password', 'kurir')";

    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, arahkan ke halaman login kurir dengan pesan sukses
        $_SESSION['success'] = "Kurir baru berhasil dibuat! Silakan login.";
        header("Location: courier_login.php");
        exit();
    } else {
        // Jika gagal
        $_SESSION['error'] = "Gagal membuat kurir: " . mysqli_error($koneksi);
        header("Location: courier_register.php");
        exit();
    }
}
?>
