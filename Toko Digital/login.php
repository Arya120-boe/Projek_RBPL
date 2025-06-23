<?php 
// Mulai session di paling atas untuk menampilkan pesan notifikasi
session_start(); 

// Jika pengguna sudah login, langsung arahkan ke halaman utama
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'pengguna') {
    header("Location: index.php");
    exit();
}

include 'header.php'; 
?>
<title>Login Pengguna - Toko Digital</title>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Login Pengguna</h1>
        <p class="auth-subtext">Masuk untuk melanjutkan belanja Anda.</p>

        <!-- Bagian untuk menampilkan pesan error jika login gagal -->
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red; background: #fbe9e7; padding: 10px; border-radius: 8px; border: 1px solid red; margin-bottom: 20px;">
                <?php echo $_SESSION['error']; ?>
            </p>
            <?php unset($_SESSION['error']); // Hapus pesan setelah ditampilkan ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green; background: #e8f5e9; padding: 10px; border-radius: 8px; border: 1px solid green; margin-bottom: 20px;">
                <?php echo $_SESSION['success']; ?>
            </p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Form login yang mengirim data ke login_process.php -->
        <form action="login_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Login</button>
        </form>
        <p class="auth-footer-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>
