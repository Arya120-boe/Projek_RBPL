<?php require_once 'products.php'; ?>
<?php include 'header.php'; ?>
<?php
// Ambil nama produk dari URL.
$product_name_from_url = isset($_GET['product']) ? htmlspecialchars($_GET['product']) : '';
$current_product = find_product_by_name($product_name_from_url);

// Jika produk tidak ditemukan, default ke produk pertama sebagai fallback.
if (!$current_product) {
    $all_products_for_fallback = get_all_products();
    $current_product = !empty($all_products_for_fallback) ? $all_products_for_fallback[0] : null;
}
$all_products = get_all_products();
?>

<title>Detail: <?php echo $current_product ? $current_product['name'] : 'Produk Tidak Ditemukan'; ?> - Toko Digital</title>
<style>
    /* CSS Khusus untuk Halaman Detail Produk */
    main.container {
        padding: 40px 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .product-detail-layout {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 50px;
        align-items: flex-start;
    }
    .product-images { display: flex; flex-direction: column; gap: 15px; }
    .main-product-image { width: 100%; height: auto; border-radius: 12px; border: 1px solid var(--border-color); }
    .thumbnail-images { display: flex; gap: 10px; justify-content: flex-start; }
    .thumbnail { width: 80px; height: 80px; border-radius: 8px; border: 2px solid var(--border-color); cursor: pointer; object-fit: cover; }
    .thumbnail:hover, .thumbnail.active { border-color: var(--primary-yellow); }

    .product-details h1 { font-size: 2.5rem; margin: 0 0 10px 0; }
    .product-price-detail { font-size: 2rem; font-weight: 700; color: #f39c12; margin-bottom: 25px; }
    .quantity-selector .qty-btn { border: 1px solid var(--border-color); background-color: white; width: 35px; height: 35px; font-size: 1.5rem; cursor: pointer; }
    .quantity-selector .qty-input { width: 50px; height: 35px; text-align: center; border: 1px solid var(--border-color); border-left: none; border-right: none; font-size: 1.2rem; padding: 0; }
    
    .action-buttons { display: grid; grid-template-columns: 1fr; gap: 10px; margin-bottom: 25px; }
    .action-buttons .btn { padding: 15px; font-size: 1.1rem; }

    .product-description { line-height: 1.8; color: var(--light-text); margin-bottom: 20px; border-top: 1px solid var(--border-color); padding-top: 20px; }
    .social-share span { font-weight: 600; margin-right: 10px; }
    .social-share a { color: var(--light-text); margin-right: 15px; font-size: 1.2rem; }
    
    /* Store Info Section */
    .store-info-section { background-color: #fff; padding: 40px 0; margin-top: 40px; }
    .store-card { background-color: var(--bg-gray); border-radius: 12px; padding: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; border: 1px solid var(--border-color); }
    .store-profile { display: flex; align-items: center; gap: 20px; }
    .store-profile img { border-radius: 50%; }
    .store-name h3 { margin: 0; font-size: 1.2rem; }
    .store-name h3 i { color: var(--green-check); font-size: 1rem; }
    .store-stats { display: flex; gap: 20px; flex-wrap: wrap; border-left: 1px solid var(--border-color); padding-left: 20px; margin-left: 20px; }
    .stat-item { text-align: center; color: var(--light-text); line-height: 1.2; }
    .stat-item strong { color: var(--dark-text); display: block; font-size: 1.2rem; }

    /* Recommendations Carousel */
    .recommendations-section { margin-top: 40px; background-color: var(--bg-gray); padding: 40px; margin: 40px -40px -20px -40px; }
    .recommendation-carousel { position: relative; margin-bottom: 20px; }
    .carousel-viewport { overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none; }
    .carousel-viewport::-webkit-scrollbar { display: none; }
    .recommendation-carousel .product-grid { display: flex; gap: 20px; width: max-content; }
    .recommendation-carousel .product-card { flex: 0 0 220px; }
    .recommendation-carousel .product-card-buttons { display: grid; grid-template-columns: 1fr; gap: 8px; margin-top: 10px; }

    .carousel-arrow { position: absolute; top: 40%; transform: translateY(-50%); z-index: 10; background-color: white; border: 1px solid var(--border-color); border-radius: 50%; width: 45px; height: 45px; cursor: pointer; }
    .carousel-arrow.prev-arrow { left: 0; }
    .carousel-arrow.next-arrow { right: 0; }

    /* Page Specific Footer */
    .page-specific-footer { background-color: var(--light-yellow); padding: 40px 20px 20px 20px; margin: 60px -40px -40px -40px; }
    .footer-content-wrapper { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
    .rating-review-section h4, .footer-about-section h4 { font-size: 1.2rem; color: var(--dark-text); margin: 0 0 15px 0; }
    .rating-review-section .stars { color: var(--primary-yellow); font-size: 1.5rem; margin-bottom: 20px; }
    .rating-review-section textarea { width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Poppins', sans-serif; }
    .footer-about-section ul { list-style: none; padding: 0; margin: 0; }
    .footer-about-section li { display: flex; align-items: flex-start; margin-bottom: 15px; }
    .footer-about-section li i { margin-right: 15px; width: 20px; color: var(--dark-text); }
    .copyright { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color); color: var(--text-muted); }

</style>

<main class="container">
    <?php if ($current_product): ?>
    <section class="product-detail-section">
        <div class="product-detail-layout">
            <div class="product-images">
                <img src="<?php echo $current_product['image']; ?>" alt="<?php echo $current_product['name']; ?>" class="main-product-image">
                <div class="thumbnail-images">
                    <?php if (!empty($current_product['thumbnails'])): foreach($current_product['thumbnails'] as $thumb): ?><img src="<?php echo $thumb; ?>" alt="thumbnail" class="thumbnail"><?php endforeach; else: ?><img src="<?php echo str_replace('400x400', '100x100', $current_product['image']); ?>" alt="thumbnail" class="thumbnail active"><?php endif; ?>
                </div>
            </div>
            <div class="product-details" data-id="<?php echo htmlspecialchars($current_product['id']); ?>" data-name="<?php echo htmlspecialchars($current_product['name']); ?>" data-price="<?php echo $current_product['price']; ?>" data-image="<?php echo htmlspecialchars($current_product['image']); ?>">
                <h1><?php echo $current_product['name']; ?></h1>
                <p class="product-price-detail">Rp <?php echo number_format((float)$current_product['price'], 0, ',', '.'); ?></p>
                <div class="quantity-selector"><button class="qty-btn minus" aria-label="Kurangi jumlah">-</button><input type="number" class="qty-input" value="1" min="1" aria-label="Jumlah"><button class="qty-btn plus" aria-label="Tambah jumlah">+</button></div>
                
                <div class="action-buttons">
                    <button class="btn btn-secondary add-to-cart-btn"><i class="fas fa-cart-plus"></i> MASUKKAN KERANJANG</button>
                    <button class="btn btn-primary buy-now-btn">BELI</button>
                </div>
                
                <div class="product-description"><p><?php echo $current_product['desc']; ?></p></div>
                <div class="social-share"><span>Bagikan:</span><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
            </div>
        </div>
    </section>

    <section class="store-info-section">
        <div class="store-card">
            <div class="store-profile"><img src="https://placehold.co/80x80/e0e0e0/333?text=Toko" alt="Logo Toko"><div class="store-name"><h3>Toko Pak Mar <i class="fa fa-check-circle"></i></h3><p>Sleman, DI Yogyakarta</p></div></div>
            <div class="store-stats"><div class="stat-item"><strong>4.9/5.0</strong><span>rating</span></div><div class="stat-item"><strong>25rb</strong><span>pengikut</span></div><div class="stat-item"><strong>172</strong><span>produk</span></div><div class="stat-item"><strong>30 bln</strong><span>lama gabung</span></div></div>
        </div>
    </section>
    
    <section class="recommendations-section">
        <h2 style="text-align:left; margin-bottom:20px;">Produk Lainnya</h2>
        <?php
            function render_recommendation_carousel($products_list) {
                echo '<div class="recommendation-carousel"><button class="carousel-arrow prev-arrow">&lt;</button><div class="carousel-viewport"><div class="product-grid">';
                foreach ($products_list as $product) {
                    echo '<div class="product-card" data-id="'.htmlspecialchars($product['id']).'" data-name="'.htmlspecialchars($product['name']).'" data-price="'.$product['price'].'" data-image="'.htmlspecialchars($product['image']).'"><a href="product-detail.php?product='.urlencode($product['name']).'" class="product-link"><div class="product-image" style="background-image: url(\''.$product['image'].'\');"></div></a><div class="product-info"><h3>'.htmlspecialchars($product['name']).'</h3><p class="price">Rp '.number_format((float)$product['price'], 0, ',', '.').'</p><div class="quantity-selector"><button class="qty-btn minus">-</button><input class="qty-input" type="number" value="1" min="1"><button class="qty-btn plus">+</button></div><div class="product-card-buttons"><button class="btn btn-secondary add-to-cart-btn">KERANJANG</button><button class="btn btn-primary buy-now-btn">BELI</button></div></div></div>';
                }
                echo '</div></div><button class="carousel-arrow next-arrow">&gt;</button></div>';
            }
            render_recommendation_carousel(array_slice($all_products, 0, 5));
            render_recommendation_carousel(array_slice($all_products, 5, 5));
            render_recommendation_carousel(array_slice($all_products, 10, 5));
        ?>
    </section>
    <?php else: ?><p>Produk yang Anda cari tidak ditemukan.</p><?php endif; ?>
</main>

<footer class="page-specific-footer">
    <div class="footer-content-wrapper">
        <div class="rating-review-section">
            <h4>rating</h4>
            <div class="stars"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
            <h4>Ulasan :</h4>
            <textarea rows="4"></textarea>
        </div>
        <div class="footer-about-section">
            <h4>Tentang Toko</h4>
            <ul>
                <li><i class="fa fa-phone"></i> 132-789-4560</li>
                <li><i class="fa fa-envelope"></i> tokodigital@gmail.com</li>
                <li><i class="fa fa-clock"></i> Waktu Operasi Toko<br>Jam 06:00 - 24:00</li>
            </ul>
        </div>
    </div>
    <div class="copyright">Copyright 2025</div>
</footer>

<script>
// Logika ini sekarang akan menangani semua tombol di halaman
// Pastikan file header.php memuat #toast-notification dan footer.php memuat logika keranjang utama
document.addEventListener('DOMContentLoaded', () => {
    // Fungsi addToCart dan lainnya diasumsikan ada di footer.php atau file JS global
    // Jika tidak, kita harus mendefinisikannya di sini.
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const showToast = (message) => { const el = document.getElementById('toast-notification'); if(el){ el.textContent = message; el.classList.add('show'); setTimeout(() => el.classList.remove('show'), 3000);} };
    const updateCartUI = () => { const itemCountEl = document.querySelector('.cart-item-count'); if(itemCountEl){ itemCountEl.textContent = cart.reduce((s, i) => s + i.quantity, 0); } };
    const addToCart = (product) => {
        const existingItem = cart.find(item => item.id === product.id);
        if (existingItem) { existingItem.quantity += product.quantity; } else { cart.push(product); }
        sessionStorage.setItem('cart', JSON.stringify(cart));
        showToast(`${product.name} ditambahkan!`);
        updateCartUI();
    };

    document.body.addEventListener('click', (e) => {
        const qtyContainer = e.target.closest('.quantity-selector');
        const addToCartBtn = e.target.closest('.add-to-cart-btn');
        const buyBtn = e.target.closest('.buy-now-btn');

        if (qtyContainer && e.target.matches('.qty-btn')) {
            e.preventDefault();
            const qtyInput = qtyContainer.querySelector('.qty-input');
            let val = parseInt(qtyInput.value);
            if (e.target.classList.contains('plus')) val++;
            else if (e.target.classList.contains('minus')) val--;
            if (val < 1) val = 1;
            qtyInput.value = val;
        }

        if (addToCartBtn) {
            e.preventDefault();
            const card = addToCartBtn.closest('[data-id]');
            const qtyInput = card.querySelector('.qty-input') || { value: 1 };
            const productData = { id: card.dataset.id, name: card.dataset.name, price: parseFloat(card.dataset.price), image: card.dataset.image, quantity: parseInt(qtyInput.value) };
            addToCart(productData);
        }

        if (buyBtn) {
            e.preventDefault();
            const card = buyBtn.closest('[data-id]');
            const qtyInput = card.querySelector('.qty-input') || { value: 1 };
            const productData = { id: card.dataset.id, name: card.dataset.name, price: parseFloat(card.dataset.price), image: card.dataset.image, quantity: parseInt(qtyInput.value) };
            sessionStorage.setItem('cart', JSON.stringify([productData]));
            window.location.href = 'checkout.php';
        }
    });

    document.querySelectorAll('.recommendation-carousel').forEach(carousel => {
        const track = carousel.querySelector('.product-grid');
        const prevBtn = carousel.querySelector('.prev-arrow');
        const nextBtn = carousel.querySelector('.next-arrow');
        if (!track || !track.querySelector('.product-card')) return;
        const itemWidth = track.querySelector('.product-card').offsetWidth + 20;
        nextBtn.addEventListener('click', () => { track.scrollBy({ left: itemWidth * 2, behavior: 'smooth' }); });
        prevBtn.addEventListener('click', () => { track.scrollBy({ left: -itemWidth * 2, behavior: 'smooth' }); });
    });
});
</script>
</body>
</html>
