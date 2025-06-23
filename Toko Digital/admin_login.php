<?php 
// Mulai session di paling atas untuk menampilkan pesan error
session_start(); 

// Jika admin sudah login, langsung arahkan ke dasbor admin
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
    header("Location: admin.php");
    exit();
}

include 'header.php'; 
?>
<title>Login Admin - Toko Digital</title>
<style>
    /* Gaya baru untuk pesan error */
    .auth-feedback-message {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
    }
    .auth-feedback-message.error {
        color: #721c24; /* Warna teks merah tua */
        background-color: #f8d7da; /* Latar belakang merah muda */
        border: 1px solid #f5c6cb; /* Border merah */
    }
    .auth-feedback-message i {
        font-size: 1.2rem;
    }
</style>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Login Admin</h1>
        <p class="auth-subtext">Hanya untuk staf yang berwenang.</p>

        <!-- PERBAIKAN DI SINI: Menampilkan pesan error jika ada -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="auth-feedback-message error">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); // Hapus pesan setelah ditampilkan ?>
        <?php endif; ?>

        <form action="login_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Login sebagai Admin</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>
