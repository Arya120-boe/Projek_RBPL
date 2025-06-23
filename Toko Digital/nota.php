<?php 
session_start();
require_once 'koneksi.php'; // Hubungkan ke database
include 'header.php'; 
?>
<?php
// 1. Ambil ID order dari URL dan pastikan itu adalah angka
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
$transaction = null;
$items = [];

if ($order_id > 0) {
    // 2. Ambil data transaksi utama dari tabel 'orders'
    $query_order = "SELECT * FROM orders WHERE id = $order_id";
    $result_order = mysqli_query($koneksi, $query_order);
    if ($result_order && mysqli_num_rows($result_order) > 0) {
        $transaction = mysqli_fetch_assoc($result_order);

        // 3. Ambil detail item dari tabel 'order_items'
        $query_items = "SELECT * FROM order_items WHERE order_id = $order_id";
        $result_items = mysqli_query($koneksi, $query_items);
        while ($row = mysqli_fetch_assoc($result_items)) {
            $items[] = $row;
        }
    }
}

// Ekstrak data ke variabel agar lebih mudah dibaca
$no_transaksi = $transaction['no_transaksi'] ?? 'N/A';
$tanggal = isset($transaction['tanggal']) ? date('d F Y, H:i', strtotime($transaction['tanggal'])) : 'N/A';
$customer_name = $transaction['customer_name'] ?? 'Pelanggan';
$alamat = $transaction['customer_address'] ?? 'N/A';
$kode_bayar = $transaction['kode_bayar'] ?? 'N/A';
$total_bayar = $transaction['total_bayar'] ?? 0;
$subtotal = 0; // Akan dihitung ulang dari item
?>

<title>Nota Transaksi <?php echo $no_transaksi; ?> - Toko Digital</title>
<style>
    /* CSS Khusus untuk Halaman Nota */
    .receipt-wrapper { padding: 60px 0; }
    .receipt-container { max-width: 800px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.08); border: 1px solid var(--border-color); }
    .receipt-header { text-align: center; border-bottom: 2px dashed var(--border-color); padding-bottom: 20px; margin-bottom: 20px; }
    .receipt-header h1 { margin: 0; font-size: 2.5rem; color: var(--dark-text); }
    .receipt-header p { margin: 5px 0 0 0; color: var(--light-text); }
    .receipt-details { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; font-size: 0.9rem; }
    .receipt-details div p { margin: 4px 0; }
    .receipt-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 0.9rem; }
    .receipt-table thead th { text-align: left; padding: 10px; border-bottom: 2px solid var(--dark-text); color: var(--text-muted); font-weight: 600; }
    .receipt-table tbody td { padding: 10px; border-bottom: 1px solid var(--border-color); }
    .receipt-table .align-right { text-align: right; }
    .receipt-summary { margin-left: auto; width: 60%; max-width: 350px; }
    .summary-line { display: flex; justify-content: space-between; padding: 8px 0; }
    .summary-line.total { font-weight: 700; font-size: 1.2rem; border-top: 2px solid var(--dark-text); padding-top: 10px; margin-top: 10px; }
    .receipt-footer { text-align: center; margin-top: 40px; color: var(--light-text); font-size: 0.9rem; }
    .receipt-actions { text-align: center; margin-top: 30px; }
    .btn-print { padding: 10px 30px; }
    @media print { body, .receipt-container { background-color: #fff; } header, footer, .receipt-actions { display: none; } main.container, .receipt-wrapper { padding: 0; } .receipt-container { box-shadow: none; border: none; } }
</style>

<main class="container">
    <div class="receipt-wrapper">
        <?php if ($transaction): ?>
        <div class="receipt-container">
            <div class="receipt-header">
                <h1>Nota Transaksi</h1>
                <p>Terima kasih atas pesanan Anda!</p>
            </div>

            <div class="receipt-details">
                <div>
                    <p><strong>No. Transaksi:</strong> <?php echo htmlspecialchars($no_transaksi); ?></p>
                    <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($tanggal); ?></p>
                    <p><strong>Alamat:</strong> <?php echo htmlspecialchars($alamat); ?></p>
                </div>
                <div style="text-align: right;">
                    <p><strong>Ditagih Kepada:</strong></p>
                    <p><?php echo htmlspecialchars($customer_name); ?></p>
                </div>
            </div>

            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th class="align-right">Jumlah</th>
                        <th class="align-right">Harga</th>
                        <th class="align-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): 
                        $item_total = $item['price'] * $item['quantity'];
                        $subtotal += $item_total;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td class="align-right"><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td class="align-right">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td class="align-right">Rp <?php echo number_format($item_total, 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="receipt-summary">
                 <div class="summary-line">
                    <span>Subtotal</span>
                    <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                </div>
                 <div class="summary-line">
                    <span>Pengiriman</span>
                    <span>Rp <?php echo number_format($total_bayar - $subtotal, 0, ',', '.'); ?></span>
                </div>
                <div class="summary-line total">
                    <span>TOTAL BAYAR</span>
                    <span>Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></span>
                </div>
            </div>

            <div class="receipt-footer">
                <p>Pembayaran melalui <?php echo htmlspecialchars($kode_bayar); ?>.</p>
                <p>Simpan nota ini sebagai bukti pembayaran yang sah.</p>
            </div>
            
            <div class="receipt-actions">
                <button class="btn btn-primary btn-print" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak Nota
                </button>
            </div>
        </div>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <h2>Transaksi Tidak Ditemukan</h2>
                <p>Maaf, kami tidak dapat menemukan detail transaksi yang Anda cari.</p>
                <a href="index.php" class="btn btn-primary" style="width: auto; padding: 10px 30px;">Kembali ke Beranda</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
