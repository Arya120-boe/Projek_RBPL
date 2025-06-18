<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Kolom-kolom footer (sama seperti sebelumnya) -->
            <div class="footer-column">
                <h4 class="footer-heading">TOKO DIGITAL</h4>
                <p>Belanja kebutuhan harian jadi lebih mudah, cepat, dan hemat. Temukan berbagai produk berkualitas dengan harga terbaik hanya di Toko Digital.</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h4 class="footer-heading">Tautan Cepat</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="#">Kategori Produk</a></li>
                    <li><a href="#">Promo Hari Ini</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4 class="footer-heading">Hubungi Kami</h4>
                <ul class="footer-contact">
                    <li><i class="fa fa-map-marker-alt"></i> Jl. Digital No. 123, Yogyakarta</li>
                    <li><i class="fa fa-phone"></i> 132-789-4560</li>
                    <li><i class="fa fa-envelope"></i> tokodigital@gmail.com</li>
                    <li><i class="fa fa-clock"></i> Senin - Minggu: 06:00 - 24:00</li>
                </ul>
            </div>
            <div class="footer-column">
                <h4 class="footer-heading">Langganan Newsletter</h4>
                <p>Dapatkan info promo dan produk terbaru langsung di email Anda.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Masukkan email Anda" required>
                    <button type="submit" aria-label="Kirim">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Toko Digital. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- CART LOGIC ---
    const cartIcon = document.querySelector('.cart-icon-wrapper');
    const closeCartBtn = document.querySelector('.close-cart-btn');
    const cartOverlay = document.querySelector('.cart-overlay');
    const cartItemsContainer = document.querySelector('.cart-items');
    const cartSubtotalEl = document.getElementById('cart-subtotal-value');
    const cartItemCountEl = document.querySelector('.cart-item-count');
    const checkoutLink = document.getElementById('checkout-link');
    const emptyCartMsg = document.querySelector('.cart-empty-message');

    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    const toggleCart = () => document.body.classList.toggle('cart-open');

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }
    
    const showToast = (message) => {
        const toast = document.getElementById('toast-notification');
        toast.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
    
    const updateCart = () => {
        renderCartItems();
        updateCartSubtotal();
        updateCartIcon();
        sessionStorage.setItem('cart', JSON.stringify(cart));
    }

    const renderCartItems = () => {
        cartItemsContainer.innerHTML = ''; // Kosongkan kontainer
        if (cart.length === 0) {
            cartItemsContainer.appendChild(emptyCartMsg);
            emptyCartMsg.style.display = 'block';
        } else {
            emptyCartMsg.style.display = 'none';
            cart.forEach(item => {
                const itemEl = document.createElement('div');
                itemEl.classList.add('cart-item');
                itemEl.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-info">
                            <p class="cart-item-name">${item.name}</p>
                            <p class="cart-item-price">${formatRupiah(item.price)}</p>
                        </div>
                        <div class="cart-item-actions">
                             <div class="quantity-selector">
                                <button class="qty-btn" data-id="${item.id}" data-action="decrease">-</button>
                                <input type="text" value="${item.quantity}" class="qty-input" readonly>
                                <button class="qty-btn" data-id="${item.id}" data-action="increase">+</button>
                            </div>
                            <button class="cart-item-remove-btn" data-id="${item.id}">Hapus</button>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(itemEl);
            });
        }
    }

    const updateCartSubtotal = () => {
        const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        cartSubtotalEl.textContent = formatRupiah(subtotal);
    }

    const updateCartIcon = () => {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartItemCountEl.textContent = totalItems;
        cartItemCountEl.classList.add('updated');
        setTimeout(() => cartItemCountEl.classList.remove('updated'), 200);
    }

    const addToCart = (product) => {
        const existingItem = cart.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity += product.quantity;
        } else {
            cart.push(product);
        }
        showToast(`${product.name} ditambahkan ke keranjang!`);
        updateCart();
    }
    
    const adjustQuantity = (productId, action) => {
        const item = cart.find(item => item.id === productId);
        if (!item) return;

        if (action === 'increase') {
            item.quantity++;
        } else if (action === 'decrease') {
            item.quantity--;
            if (item.quantity <= 0) {
                removeFromCart(productId);
                return;
            }
        }
        updateCart();
    }

    const removeFromCart = (productId) => {
        cart = cart.filter(item => item.id !== productId);
        showToast(`Item dihapus dari keranjang.`);
        updateCart();
    }

    // --- EVENT LISTENERS ---
    cartIcon.addEventListener('click', toggleCart);
    closeCartBtn.addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);
    
    document.body.addEventListener('click', (e) => {
        // Untuk tombol 'Masukkan Keranjang'
        if (e.target.closest('.add-to-cart-btn')) {
            e.preventDefault();
            const card = e.target.closest('.product-card') || e.target.closest('.product-details');
            const product = {
                id: card.dataset.id,
                name: card.dataset.name,
                price: parseFloat(card.dataset.price),
                image: card.dataset.image,
                quantity: 1
            };
            addToCart(product);
        }
        
        // Untuk tombol di dalam keranjang
        if (e.target.matches('.cart-item-remove-btn')) {
            removeFromCart(e.target.dataset.id);
        }
        
        if (e.target.matches('.qty-btn')) {
            if (e.target.closest('.cart-item-actions')) {
                 adjustQuantity(e.target.dataset.id, e.target.dataset.action);
            }
        }
    });

    // Inisialisasi keranjang saat halaman dimuat
    updateCart();
});
</script>
