<?php include 'header.php'; ?>
<title>Daftar - Toko Digital</title>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Buat Akun Baru</h1>
        <p class="auth-subtext">Daftar sekarang untuk mulai berbelanja.</p>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form sekarang mengirim data ke register_process.php -->
        <form action="register_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Daftar</button>
        </form>
        <p class="auth-footer-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
    </div>
</main>
<?php include 'footer.php'; ?>
