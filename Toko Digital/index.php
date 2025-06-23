<?php 
require_once 'koneksi.php'; // Hubungkan ke database
include 'header.php'; // Sertakan header
?>
<title>Toko Digital - Beranda</title>
<style>
    /* CSS Tambahan untuk Halaman Index */
    .promo-section { padding: 0; background-color: var(--light-yellow); }
    .promo-slider-container { max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 12px; }
    .promo-slider-track { display: flex; transition: transform 0.5s ease-in-out; }
    .promo-slide { min-width: 100%; box-sizing: border-box; }
    .promo-slide img { width: 100%; display: block; max-height: 400px; object-fit: cover; }
    .slider-arrow { position: absolute; top: 50%; transform: translateY(-50%); background-color: rgba(255, 255, 255, 0.7); border: none; border-radius: 50%; width: 45px; height: 45px; font-size: 1.5rem; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.15); }
    .slider-arrow:hover { background-color: white; }
    .slider-arrow.left-arrow { left: 15px; }
    .slider-arrow.right-arrow { right: 15px; }
    .product-card-buttons { display: grid; grid-template-columns: 1fr; gap: 10px; margin-top: 15px; }
    .pagination-dots a.dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ccc;
        margin: 0 5px;
        text-decoration: none;
    }
    .pagination-dots a.dot.active {
        background-color: var(--dark-text);
    }
</style>

<main style="margin-top: 30px;">
    <?php
    // --- Logika Paginasi ---
    $products_per_page = 8;

    // Hitung total produk
    $count_result = mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM products");
    $total_products = mysqli_fetch_assoc($count_result)['total'];
    $total_pages = ceil($total_products / $products_per_page);

    // Tentukan halaman saat ini
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }
    if ($current_page < 1) {
        $current_page = 1;
    }

    // Hitung offset untuk query database
    $offset = ($current_page - 1) * $products_per_page;

    // Ambil data produk untuk halaman saat ini
    $query_products = "SELECT * FROM products LIMIT $products_per_page OFFSET $offset";
    $result_products = mysqli_query($koneksi, $query_products);
    $page_products = [];
    if ($result_products) {
        while($row = mysqli_fetch_assoc($result_products)) {
            $page_products[] = $row;
        }
    }

    // --- Data untuk Kategori & Promo (Bisa juga dari database) ---
    $categories = [['name' => 'Bahan Kue', 'image' => 'https://placehold.co/400x300/f0f0e0/333?text=Bahan+Kue'], ['name' => 'Sabun & Kebersihan', 'image' => 'https://placehold.co/400x300/e8f5e9/333?text=Sabun'], ['name' => 'Makanan', 'image' => 'https://placehold.co/400x300/fff3e0/333?text=Makanan'], ['name' => 'Minuman', 'image' => 'https://placehold.co/400x300/e0f0f5/333?text=Minuman']];
    $promo_images = [
        'https://placehold.co/1200x400/ffc107/333?text=Promo+Spesial+Makanan',
        'https://placehold.co/1200x400/3498db/ffffff?text=Diskon+Produk+Kebersihan',
        'https://placehold.co/1200x400/2ecc71/ffffff?text=Gratis+Ongkir+Minggu+Ini',
    ];
    ?>
    
    <section class="promo-section">
        <div class="promo-slider-container">
            <div class="promo-slider-track">
                <?php foreach ($promo_images as $image): ?>
                <div class="promo-slide"><img src="<?php echo $image; ?>" alt="Gambar Promo"></div>
                <?php endforeach; ?>
            </div>
            <button class="slider-arrow left-arrow" aria-label="Previous Slide">&lt;</button>
            <button class="slider-arrow right-arrow" aria-label="Next Slide">&gt;</button>
        </div>
    </section>

    <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
        <section class="category-section">
            <h2>Kategori Produk</h2>
            <div class="category-grid">
                <?php foreach ($categories as $category): ?>
                <a href="category.php?name=<?php echo urlencode($category['name']); ?>">
                    <div class="category-card">
                        <div class="category-image" style="background-image: url('<?php echo $category['image']; ?>');"></div>
                        <h3><?php echo $category['name']; ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="product-section">
            <h2>Produk Pilihan</h2>
            <div class="product-grid">
                <?php foreach ($page_products as $product): ?>
                <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo $product['price']; ?>" data-image="<?php echo htmlspecialchars($product['image']); ?>">
                    <a href="product-detail.php?product=<?php echo urlencode($product['name']); ?>" class="product-link"><div class="product-image" style="background-image: url('<?php echo $product['image']; ?>');"></div></a>
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
            </div>
            <div class="pagination-dots">
                <?php if ($total_pages > 1): ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="index.php?page=<?php echo $i; ?>" class="dot <?php if ($i == $current_page) echo 'active'; ?>"></a>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Promo Slider Logic
    const track = document.querySelector('.promo-slider-track');
    if (track) {
        const slides = Array.from(track.children);
        const nextButton = document.querySelector('.right-arrow');
        const prevButton = document.querySelector('.left-arrow');
        if (slides.length > 0) {
            const slideWidth = slides[0].getBoundingClientRect().width;
            let currentIndex = 0;
            const moveToSlide = (targetIndex) => {
                track.style.transform = 'translateX(-' + slideWidth * targetIndex + 'px)';
                currentIndex = targetIndex;
            };
            prevButton.addEventListener('click', () => {
                const prevIndex = currentIndex === 0 ? slides.length - 1 : currentIndex - 1;
                moveToSlide(prevIndex);
            });
            nextButton.addEventListener('click', () => {
                const nextIndex = currentIndex === slides.length - 1 ? 0 : currentIndex + 1;
                moveToSlide(nextIndex);
            });
            setInterval(() => { nextButton.click(); }, 5000);
        }
    }
    
    // Product Card Logic (Quantity & Buttons)
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
