<?php include 'header.php'; ?>
<title>Daftar Admin Baru - Toko Digital</title>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Daftarkan Admin Baru</h1>
        <p class="auth-subtext">Gunakan halaman ini untuk membuat akun admin baru.</p>
        
        <form action="admin_register_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="fullname">Nama Lengkap Admin</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email Admin</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">DAFTARKAN ADMIN</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>
