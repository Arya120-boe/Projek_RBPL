<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toko Digital</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TOKO DIGITAL</h2>
                <span>ADMIN PANEL</span>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="admin.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="#"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Dashboard</h1>
                <div class="header-info">
                    <div class="date-info">
                        <i class="fas fa-calendar-alt"></i>
                        <span><?php echo date("l, j F Y"); ?></span>
                    </div>
                    <div class="admin-profile">
                        <span>ADMIN ONLY</span>
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </header>

            <!-- Summary Cards -->
            <section class="summary-cards">
                <div class="card"><div class="card-icon blue"><i class="fas fa-dollar-sign"></i></div><div class="card-content"><h4>Total Keuntungan</h4><p>Rp 15.750.000</p></div></div>
                <div class="card"><div class="card-icon green"><i class="fas fa-plus-circle"></i></div><div class="card-content"><h4>Barang Masuk (Bulan Ini)</h4><p>150 Unit</p></div></div>
                <div class="card"><div class="card-icon orange"><i class="fas fa-check-circle"></i></div><div class="card-content"><h4>Barang Terjual (Bulan Ini)</h4><p>124 Unit</p></div></div>
                <div class="card"><div class="card-icon red"><i class="fas fa-box"></i></div><div class="card-content"><h4>Status Barang (Stok)</h4><p>789 Tersedia</p></div></div>
            </section>

            <!-- Sales Chart -->
            <section class="chart-section">
                <div class="chart-container">
                    <h3>Grafik Penjualan Bulanan</h3>
                    <canvas id="salesChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, { type: 'bar', data: { labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'], datasets: [{ label: 'Pendapatan (dalam Juta Rp)', data: [12.5, 19.3, 15.2, 21.8, 18.5, 25.4], backgroundColor: 'rgba(52, 152, 219, 0.7)', borderColor: 'rgba(52, 152, 219, 1)', borderWidth: 1, borderRadius: 5 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } } });
    </script>
</body>
</html>
