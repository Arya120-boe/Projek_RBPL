<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    if (empty($fullname) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua kolom harus diisi.";
        header("Location: register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$hashed_password', 'pengguna')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        // Cek jika error karena email sudah ada
        if(mysqli_errno($koneksi) == 1062){
            $_SESSION['error'] = "Email sudah terdaftar. Silakan gunakan email lain.";
        } else {
            $_SESSION['error'] = "Terjadi kesalahan. Silakan coba lagi. " . mysqli_error($koneksi);
        }
        header("Location: register.php");
        exit();
    }
}
?>
