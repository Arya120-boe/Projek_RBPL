<?php include 'header.php'; ?>
<title>Login - Toko Digital</title>
<style>
    /* CSS Khusus untuk Halaman Login & Register */
    .auth-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
        background-color: var(--bg-gray);
        flex-grow: 1;
    }
    .auth-container {
        width: 100%;
        max-width: 450px;
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
    }
    .auth-container h1 {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .auth-container .auth-subtext {
        color: var(--light-text);
        margin-bottom: 30px;
    }
    .auth-form .form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .auth-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }
    .auth-form input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    .auth-form .btn {
        margin-top: 10px;
    }
    .auth-footer-link {
        margin-top: 25px;
        font-size: 0.9rem;
    }
    .auth-footer-link a {
        color: var(--primary-yellow);
        font-weight: 600;
        text-decoration: none;
    }
    .auth-footer-link a:hover {
        text-decoration: underline;
    }
</style>
<main class="auth-wrapper">
    <div class="auth-container">
        <h1>Selamat Datang Kembali!</h1>
        <p class="auth-subtext">Masuk untuk melanjutkan belanja.</p>
        <form action="#" method="POST" class="auth-form">
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
        <p class="auth-footer-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>
    </div>
</main>
<?php include 'footer.php'; ?>
