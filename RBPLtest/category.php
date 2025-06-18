<?php include 'header.php'; ?>
<?php
// --- Daftar Produk Lengkap (Langsung di dalam file ini) ---
$all_products = [
    // Makanan
    ['id' => 'prod_001', 'name' => 'Chitato Sapi Panggang', 'price' => '11000', 'image' => 'https://placehold.co/300x200/fff3e0/333?text=Chitato', 'category' => 'Makanan', 'desc' => 'Keripik kentang Chitato dengan bumbu sapi panggang yang legendaris dan menggugah selera.'],
    ['id' => 'prod_002', 'name' => 'Indomie Goreng', 'price' => '3000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Indomie', 'category' => 'Makanan', 'desc' => 'Mi instan goreng legendaris dengan cita rasa khas Indonesia yang tak tertandingi.'],
    ['id' => 'prod_003', 'name' => 'Oreo Original', 'price' => '8500', 'image' => 'https://placehold.co/300x200/1a1a1a/ffffff?text=Oreo', 'category' => 'Makanan', 'desc' => 'Biskuit sandwich coklat dengan krim vanila yang lezat. Diputar, dijilat, dicelupin!'],
    ['id' => 'prod_004', 'name' => 'Beras Tawon 5kg', 'price' => '63500', 'image' => 'https://placehold.co/300x200/f5f5f5/333?text=Beras+Tawon', 'category' => 'Makanan', 'desc' => 'Beras pulen berkualitas super, pilihan terbaik untuk nasi keluarga Anda.'],
    
    // Minuman
    ['id' => 'prod_005', 'name' => 'Fruit Tea Botol', 'price' => '5500', 'image' => 'https://placehold.co/300x200/f5e0e0/333?text=Fruit+Tea', 'category' => 'Minuman', 'desc' => 'Minuman teh dengan sensasi rasa buah apel yang menyegarkan dahaga.'],
    ['id' => 'prod_006', 'name' => 'Susu UHT Full Cream', 'price' => '17000', 'image' => 'https://placehold.co/300x200/e0e5f5/333?text=Susu+UHT', 'category' => 'Minuman', 'desc' => 'Susu segar UHT 1 liter, kaya akan kalsium dan nutrisi penting lainnya.'],
    ['id' => 'prod_007', 'name' => 'Pocari Sweat 500ml', 'price' => '7000', 'image' => 'https://placehold.co/300x200/e0f0f5/333?text=Pocari', 'category' => 'Minuman', 'desc' => 'Minuman isotonik pengganti cairan tubuh yang hilang setelah beraktivitas.'],
    ['id' => 'prod_008', 'name' => 'Coca-Cola Kaleng', 'price' => '6000', 'image' => 'https://placehold.co/300x200/c50000/ffffff?text=Coca-Cola', 'category' => 'Minuman', 'desc' => 'Minuman soda berkarbonasi dengan rasa kola yang klasik dan menyegarkan.'],

    // Sabun & Kebersihan
    ['id' => 'prod_009', 'name' => 'Sunlight Jeruk Nipis', 'price' => '25000', 'image' => 'https://placehold.co/300x200/e8f5e9/333?text=Sunlight', 'category' => 'Sabun & Kebersihan', 'thumbnails' => ['https://placehold.co/100x100/e8f5e9/333?text=1', 'https://placehold.co/100x100/e8f5e9/333?text=2', 'https://placehold.co/100x100/e8f5e9/333?text=3'], 'desc' => 'Sabun cuci piring dengan ekstrak jeruk nipis, ampuh angkat lemak membandel.'],
    ['id' => 'prod_010', 'name' => 'Rinso Anti Noda', 'price' => '21000', 'image' => 'https://placehold.co/300x200/f0e0f5/333?text=Rinso', 'category' => 'Sabun & Kebersihan', 'desc' => 'Deterjen bubuk anti noda, menjaga pakaian tetap bersih cemerlang.'],
    ['id' => 'prod_011', 'name' => 'Pepsodent Herbal', 'price' => '12500', 'image' => 'https://placehold.co/300x200/d5f5e3/333?text=Pepsodent', 'category' => 'Sabun & Kebersihan', 'desc' => 'Pasta gigi dengan kandungan herbal untuk nafas lebih segar dan gigi lebih kuat.'],
    ['id' => 'prod_012', 'name' => 'Lifebuoy Cair', 'price' => '35000', 'image' => 'https://placehold.co/300x200/f5e5e0/333?text=Lifebuoy', 'category' => 'Sabun & Kebersihan', 'desc' => 'Sabun mandi cair keluarga dengan formula anti-kuman yang terpercaya.'],
    
    // Bahan Kue
    ['id' => 'prod_013', 'name' => 'Gula Pasir 1kg', 'price' => '18000', 'image' => 'https://placehold.co/300x200/f5f5f5/333?text=Gula+Pasir', 'category' => 'Bahan Kue', 'desc' => 'Gula pasir putih bersih dari tebu pilihan untuk segala kebutuhan Anda.'],
    ['id' => 'prod_014', 'name' => 'Tepung Terigu 1kg', 'price' => '12000', 'image' => 'https://placehold.co/300x200/f0f0e0/333?text=Terigu', 'category' => 'Bahan Kue', 'desc' => 'Tepung terigu serbaguna protein sedang, cocok untuk aneka kue dan masakan.'],
    ['id' => 'prod_015', 'name' => 'Telur Ayam 1kg', 'price' => '28000', 'image' => 'https://placehold.co/300x200/f5f0e5/333?text=Telur', 'category' => 'Bahan Kue', 'desc' => 'Telur ayam negeri segar pilihan, harga per kilogram.'],
];

// Ambil nama kategori dari URL
$category_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Semua';

// Filter produk berdasarkan kategori yang dipilih
$filtered_products = array_filter($all_products, function($product) use ($category_name) {
    if ($category_name === 'Semua') {
        return true;
    }
    return $product['category'] === $category_name;
});
?>

<title>Kategori: <?php echo $category_name; ?> - Toko Digital</title>
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
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
        gap: 30px; 
    }
    .product-card {
        display: flex;
        flex-direction: column;
    }
</style>

<main>
    <div class="category-page-header">
        <h1>Kategori: <span><?php echo $category_name; ?></span></h1>
    </div>

    <!-- Bagian Daftar Produk -->
    <div class="container">
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
                        <button class="btn btn-secondary add-to-cart-btn">
                           <i class="fa fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada produk dalam kategori ini.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
