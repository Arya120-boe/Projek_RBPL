<?php require_once 'products.php'; // Menggunakan pusat data produk ?>
<?php include 'header.php'; // Menggunakan header terpusat ?>
<title>Toko Digital - Beranda</title>
<style>
    /* CSS Khusus untuk Promo Slider */
    .promo-section { padding: 0; background-color: var(--light-yellow); }
    .promo-slider-container { max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 12px; }
    .promo-slider-track { display: flex; transition: transform 0.5s ease-in-out; }
    .promo-slide { min-width: 100%; box-sizing: border-box; }
    .promo-slide img { width: 100%; display: block; max-height: 400px; object-fit: cover; }
    .slider-arrow { position: absolute; top: 50%; transform: translateY(-50%); background-color: rgba(255, 255, 255, 0.7); border: none; border-radius: 50%; width: 45px; height: 45px; font-size: 1.5rem; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.15); }
    .slider-arrow:hover { background-color: white; }
    .slider-arrow.left-arrow { left: 15px; }
    .slider-arrow.right-arrow { right: 15px; }
</style>

<main style="margin-top: 30px;">
    <?php
    // --- Mengambil data dari products.php ---
    $featured_products = array_slice(get_all_products(), 0, 8); // Ambil 8 produk pertama
    $categories = get_categories();
    $promo_images = [
        'https://placehold.co/1200x400/ffc107/333?text=Promo+Spesial+Makanan',
        'https://placehold.co/1200x400/3498db/ffffff?text=Diskon+Produk+Kebersihan',
        'https://placehold.co/1200x400/2ecc71/ffffff?text=Gratis+Ongkir+Minggu+Ini',
    ];
    ?>
    <!-- Promo Section -->
    <section class="promo-section">
        <div class="promo-slider-container">
            <div class="promo-slider-track">
                <?php foreach ($promo_images as $image): ?>
                <div class="promo-slide">
                    <img src="<?php echo $image; ?>" alt="Gambar Promo">
                </div>
                <?php endforeach; ?>
            </div>
            <button class="slider-arrow left-arrow" aria-label="Previous Slide">&lt;</button>
            <button class="slider-arrow right-arrow" aria-label="Next Slide">&gt;</button>
        </div>
    </section>

    <!-- Product Category Section -->
    <section class="category-section">
        <div class="container">
            <h2>Product Category</h2>
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
            <div class="pagination-dots">
                <span class="dot active"></span><span class="dot"></span><span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- Product List Section -->
    <section class="product-section">
        <div class="container">
            <h2>Product</h2>
            <div class="product-grid">
                <?php foreach ($featured_products as $product): ?>
                <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo $product['price']; ?>" data-image="<?php echo htmlspecialchars($product['image']); ?>">
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
            </div>
            <div class="pagination-dots">
                <span class="dot active"></span><span class="dot"></span><span class="dot"></span>
            </div>
        </div>
    </section>
</main>

<!-- Footer Section -->
<?php include 'footer.php'; ?>

<script>
    // --- JavaScript untuk halaman ini ---
    document.addEventListener('DOMContentLoaded', () => {
        // Logika untuk Slider Promo
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
    });
</script>
</body>
</html>
