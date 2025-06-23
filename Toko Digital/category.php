<?php 
// 1. Hubungkan ke database dan sertakan header
require_once 'koneksi.php'; 
include 'header.php'; 
?>
<?php
// 2. Ambil nama kategori dari URL, pastikan aman
$category_name = '';
if (isset($_GET['name'])) {
    $category_name = mysqli_real_escape_string($koneksi, $_GET['name']);
}

// 3. Siapkan query untuk mengambil produk berdasarkan kategori
$filtered_products = [];
if (!empty($category_name)) {
    $query = "SELECT * FROM products WHERE category = '$category_name'";
    $result = mysqli_query($koneksi, $query);

    // 4. Periksa apakah query berhasil dan ambil datanya
    if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $filtered_products[] = $row;
        }
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<title>Kategori: <?php echo htmlspecialchars($category_name); ?> - Toko Digital</title>
<style>
    /* CSS Khusus untuk Halaman Kategori */
    .category-page-header {
        padding: 40px 20px;
        background-color: #fff;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 40px;
    }
    .category-page-header h1 {
        font-size: 2.5rem;
        color: var(--dark-text);
        margin: 0;
    }
    .product-section {
        background-color: var(--bg-gray);
    }
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
        gap: 30px; 
    }
</style>

<main>
    <div class="category-page-header">
        <h1>Kategori: <span><?php echo htmlspecialchars($category_name); ?></span></h1>
    </div>

    <div class="container" style="padding: 0 20px 60px 20px;">
        <div class="product-grid">
            <?php if (!empty($filtered_products)): ?>
                <?php foreach ($filtered_products as $product): ?>
                <div class="product-card" 
                     data-id="<?php echo htmlspecialchars($product['id']); ?>" 
                     data-name="<?php echo htmlspecialchars($product['name']); ?>"
                     data-price="<?php echo $product['price']; ?>"
                     data-image="<?php echo htmlspecialchars($product['image']); ?>">
                    
                    <a href="product-detail.php?product=<?php echo urlencode($product['name']); ?>" class="product-link">
                        <div class="product-image" style="background-image: url('<?php echo $product['image']; ?>');"></div>
                    </a>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="price">Rp <?php echo number_format((float)$product['price'], 0, ',', '.'); ?></p>
                        <div class="quantity-selector">
                            <button class="qty-btn minus" aria-label="Kurangi jumlah">-</button>
                            <input type="number" class="qty-input" value="1" min="1" aria-label="Jumlah">
                            <button class="qty-btn plus" aria-label="Tambah jumlah">+</button>
                        </div>
                        <div class="product-card-buttons">
                           <button class="btn btn-secondary add-to-cart-btn">MASUKKAN KERANJANG</button>
                           <button class="btn btn-primary buy-now-btn">BELI</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="grid-column: 1 / -1; text-align: center; color: var(--light-text); font-size: 1.1rem;">
                    Tidak ada produk yang ditemukan dalam kategori "<?php echo htmlspecialchars($category_name); ?>".<br>
                    <small>Pastikan nama kategori di database sama persis.</small>
                </p>
            <?php endif; ?>
        </div>
    </div>
</main>
<script>
// Logika ini spesifik untuk halaman kategori
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product-card').forEach(card => {
        const plusBtn = card.querySelector('.qty-btn.plus');
        const minusBtn = card.querySelector('.qty-btn.minus');
        const qtyInput = card.querySelector('.qty-input');
        const buyBtn = card.querySelector('.buy-now-btn');

        const updateQty = (amount) => {
            let currentValue = parseInt(qtyInput.value);
            let newValue = currentValue + amount;
            if (newValue < 1) newValue = 1;
            qtyInput.value = newValue;
        };

        if (plusBtn) plusBtn.addEventListener('click', (e) => { e.preventDefault(); updateQty(1); });
        if (minusBtn) minusBtn.addEventListener('click', (e) => { e.preventDefault(); updateQty(-1); });

        if (buyBtn) {
            buyBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const productData = {
                    id: card.dataset.id, name: card.dataset.name, price: parseFloat(card.dataset.price), image: card.dataset.image,
                    quantity: parseInt(qtyInput.value)
                };
                sessionStorage.setItem('cart', JSON.stringify([productData]));
                window.location.href = 'checkout.php';
            });
        }
    });
});
</script>
<?php include 'footer.php'; ?>
