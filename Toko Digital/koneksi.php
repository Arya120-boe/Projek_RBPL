<?php
// --- Pengaturan Koneksi Database ---
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko_digital_db";

// --- Membuat Koneksi ---
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// --- Cek Koneksi dengan Pesan Error yang Jelas ---
if (mysqli_connect_errno()) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan error.
    die("FATAL ERROR: Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
