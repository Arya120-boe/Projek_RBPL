<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data - Admin Dashboard</title>
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
                    <li class="active"><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h1>Rekap & Laporan Penjualan</h1>
                <div class="header-info"><button class="btn-print" onclick="window.print()"><i class="fas fa-print"></i> Cetak Laporan</button></div>
            </header>
            <section class="report-section">
                <div class="report-filters"><div class="form-group-report"><label for="start_date">Dari Tanggal</label><input type="date" id="start_date"></div><div class="form-group-report"><label for="end_date">Sampai Tanggal</label><input type="date" id="end_date"></div><button class="btn-filter">Terapkan</button></div>
                <div class="report-content">
                    <div class="report-header"><h2>Laporan Penjualan</h2><p>Periode: 1 Juni 2025 - 14 Juni 2025</p></div>
                    <table class="report-table">
                        <thead><tr><th>ID Pesanan</th><th>Pelanggan</th><th>Tanggal</th><th>Jumlah</th><th>Status</th></tr></thead>
                        <tbody>
                             <?php
                            $report_data = [['id' => 'INV/001', 'customer' => 'Budi Santoso', 'date' => '13/06/2025', 'amount' => 50000, 'status' => 'Selesai'],['id' => 'INV/002', 'customer' => 'Ani Yudhoyono', 'date' => '12/06/2025', 'amount' => 21000, 'status' => 'Selesai'],['id' => 'INV/003', 'customer' => 'Joko Widodo', 'date' => '12/06/2025', 'amount' => 128500, 'status' => 'Selesai'],['id' => 'INV/004', 'customer' => 'Prabowo S.', 'date' => '11/06/2025', 'amount' => 63500, 'status' => 'Selesai']];
                            $total_sales = 0;
                            foreach ($report_data as $data): $total_sales += $data['amount']; ?>
                            <tr><td><?php echo $data['id']; ?></td><td><?php echo $data['customer']; ?></td><td><?php echo $data['date']; ?></td><td>Rp <?php echo number_format($data['amount']); ?></td><td><span class="status-badge status-completed"><?php echo $data['status']; ?></span></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="report-summary"><div class="summary-item"><h4>Total Penjualan</h4><p>Rp <?php echo number_format($total_sales); ?></p></div><div class="summary-item"><h4>Total Pesanan</h4><p><?php echo count($report_data); ?> Pesanan</p></div></div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
