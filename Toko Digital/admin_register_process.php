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

    // Query untuk memasukkan admin baru dengan peran 'admin'
    $query = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$hashed_password', 'admin')";

    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, arahkan ke halaman login admin dengan pesan sukses
        $_SESSION['success'] = "Admin baru berhasil dibuat! Silakan login.";
        header("Location: admin_login.php");
        exit();
    } else {
        // Jika gagal
        $_SESSION['error'] = "Gagal membuat admin: " . mysqli_error($koneksi);
        header("Location: admin_register.php");
        exit();
    }
}
?>
