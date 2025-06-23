<?php
// 1. Hubungkan ke database
require_once 'koneksi.php';

// 2. Mulai session
session_start();

// 3. Pastikan data dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Amankan input dari form
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    // 4. Cari pengguna di database berdasarkan email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    // 5. Periksa apakah pengguna ditemukan
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // 6. Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika password benar, simpan informasi ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_fullname'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];
            
            // 7. Arahkan pengguna ke halaman yang sesuai
            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else if ($user['role'] === 'kurir') {
                header("Location: courier_dashboard.php");
            } else {
                header("Location: index.php"); 
            }
            exit();
        }
    }

    // --- PERBAIKAN UTAMA DI SINI ---
    // Jika email tidak ditemukan atau password salah
    $_SESSION['error'] = "Email atau password yang Anda masukkan salah.";
    // Kembalikan ke halaman login tempat user mencoba login
    header("Location: " . $_SERVER['HTTP_REFERER']); 
    exit();
}
?>
