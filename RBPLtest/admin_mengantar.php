<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengantar Pesanan - Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header"><h2>TOKO DIGITAL</h2><span>ADMIN PANEL</span></div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li class="active"><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h1>Mengantar Pesanan</h1>
                <div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div>
            </header>
            <section class="delivery-grid">
                <div class="delivery-card"><div class="delivery-driver">Driver Ojol-01</div><div class="delivery-customer">Budi Santoso</div></div>
                <div class="delivery-card"><div class="delivery-driver">Driver Ojol-02</div><div class="delivery-customer">Ani Yudhoyono</div></div>
                <div class="delivery-card"><div class="delivery-driver">Driver Ojol-03</div><div class="delivery-customer">Joko Widodo</div></div>
                 <div class="delivery-card"><div class="delivery-driver">Driver Ojol-04</div><div class="delivery-customer">Prabowo S.</div></div>
                 <div class="delivery-card"><div class="delivery-driver">Driver Ojol-05</div><div class="delivery-customer">Citra Lestari</div></div>
                <div class="delivery-card add-new"><i class="fas fa-plus"></i></div>
            </section>
        </main>
    </div>
</body>
</html>
