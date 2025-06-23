<?php include 'header.php'; ?>
<title>Daftar Kurir Baru - Toko Digital</title>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Daftarkan Kurir Baru</h1>
        <p class="auth-subtext">Gunakan halaman ini untuk membuat akun kurir baru.</p>
        
        <form action="courier_register_process.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="fullname">Nama Lengkap Kurir</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email Kurir</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">DAFTARKAN KURIR</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>
