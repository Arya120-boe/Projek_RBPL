<?php 
// Mulai session untuk menampilkan pesan error
session_start(); 

include 'header.php'; 
?>
<title>Login Kurir - Toko Digital</title>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Login Kurir</h1>
        <p class="auth-subtext">Masukkan kredensial kurir Anda untuk memulai.</p>

        <!-- Bagian untuk menampilkan pesan error jika login gagal -->
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red; background: #fbe9e7; padding: 10px; border-radius: 8px; border: 1px solid red; margin-bottom: 20px;">
                <?php echo $_SESSION['error']; ?>
            </p>
            <?php unset($_SESSION['error']); // Hapus pesan setelah ditampilkan ?>
        <?php endif; ?>

        <!-- Form ini mengirim data ke login_process.php -->
        <form action="login_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required value="kurir@example.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required value="password123">
            </div>
            <button type="submit" class="btn btn-primary btn-full">Login sebagai Kurir</button>
        </form>
         <p class="auth-footer-link">
            Belum punya akun kurir? <a href="courier_register.php">Daftar di sini</a>
        </p>
    </div>
</main>
<?php include 'footer.php'; ?>
