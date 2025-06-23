<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-column"><h4>TOKO DIGITAL</h4><p>Belanja kebutuhan harian jadi lebih mudah, cepat, dan hemat.</p></div>
            <div class="footer-column"><h4>Tautan Cepat</h4><ul class="footer-links"><li><a href="index.php">Beranda</a></li><li><a href="#">Kategori</a></li></ul></div>
            <div class="footer-column"><h4>Hubungi Kami</h4><ul class="footer-links"><li>Jl. Digital No. 123</li><li>kontak@tokodigital.com</li></ul></div>
        </div>
    </div>
    <div class="footer-bottom"><p>&copy; <?php echo date("Y"); ?> Toko Digital. Semua Hak Cipta Dilindungi.</p></div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const getElement = (selector) => document.querySelector(selector);
    const formatRupiah = (n) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n);
    const showToast = (message) => { const el = getElement('#toast-notification'); if(el){ el.textContent = message; el.classList.add('show'); setTimeout(() => el.classList.remove('show'), 3000);} };

    // --- CART LOGIC ---
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const cartIcon = getElement('.cart-icon-wrapper');
    const closeCartBtn = getElement('.close-cart-btn');
    const cartOverlay = getElement('.cart-overlay');
    const cartItemsContainer = getElement('.cart-items');
    const cartSubtotalEl = getElement('#cart-subtotal-value');
    const cartItemCountEl = getElement('.cart-item-count');
    const checkoutLink = getElement('#checkout-link');

    const updateCart = () => {
        renderCartItems();
        if(cartSubtotalEl) updateCartSubtotal();
        if(cartItemCountEl) updateCartIcon();
        sessionStorage.setItem('cart', JSON.stringify(cart));
    };

    const renderCartItems = () => {
        if (!cartItemsContainer) return;
        cartItemsContainer.innerHTML = '';
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `<div class="cart-empty-message"><i class="fa fa-shopping-basket"></i><p>Keranjang Anda masih kosong.</p></div>`;
        } else {
            cart.forEach(item => {
                const itemEl = document.createElement('div');
                itemEl.classList.add('cart-item');
                itemEl.innerHTML = `<img src="${item.image}" alt="${item.name}" class="cart-item-image"><div class="cart-item-details"><div class="cart-item-info"><p class="cart-item-name">${item.name}</p><p class="cart-item-price">${formatRupiah(item.price)}</p></div><div class="cart-item-actions"><div class="quantity-selector"><button class="qty-btn" data-id="${item.id}" data-action="decrease">-</button><input type="text" value="${item.quantity}" class="qty-input" readonly><button class="qty-btn" data-id="${item.id}" data-action="increase">+</button></div><button class="cart-item-remove-btn" data-id="${item.id}">Hapus</button></div></div>`;
                cartItemsContainer.appendChild(itemEl);
            });
        }
    };

    const updateCartSubtotal = () => {
        const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        cartSubtotalEl.textContent = formatRupiah(subtotal);
        if(checkoutLink) checkoutLink.style.display = cart.length > 0 ? 'inline-flex' : 'none';
    };

    const updateCartIcon = () => {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartItemCountEl.textContent = totalItems;
    };

    const addToCart = (product) => {
        const existingItem = cart.find(item => item.id === product.id);
        if (existingItem) { existingItem.quantity += product.quantity; } else { cart.push(product); }
        showToast(`${product.name} ditambahkan!`);
        updateCart();
    };
    
    const adjustQuantityInCart = (productId, action) => {
        const itemIndex = cart.findIndex(item => item.id === productId);
        if (itemIndex === -1) return;
        if (action === 'increase') { cart[itemIndex].quantity++; } 
        else if (action === 'decrease') {
            cart[itemIndex].quantity--;
            if (cart[itemIndex].quantity <= 0) cart.splice(itemIndex, 1);
        }
        updateCart();
    };

    if (cartIcon) cartIcon.addEventListener('click', () => document.body.classList.toggle('cart-open'));
    if (closeCartBtn) closeCartBtn.addEventListener('click', () => document.body.classList.toggle('cart-open'));
    if (cartOverlay) cartOverlay.addEventListener('click', () => document.body.classList.toggle('cart-open'));

    // --- PROFILE DROPDOWN LOGIC ---
    const profileDropdown = getElement('.profile-dropdown');
    if (profileDropdown) {
        const profileIcon = profileDropdown.querySelector('.profile-icon-link');
        const dropdownMenu = profileDropdown.querySelector('.dropdown-menu');
        profileIcon.addEventListener('click', (event) => {
            event.preventDefault();
            dropdownMenu.classList.toggle('show');
        });
        window.addEventListener('click', (event) => {
            if (!profileDropdown.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // --- GLOBAL EVENT DELEGATION FOR PAGE INTERACTIONS ---
    document.body.addEventListener('click', (e) => {
        const target = e.target;
        const addToCartBtn = target.closest('.add-to-cart-btn');
        if (addToCartBtn) {
            e.preventDefault();
            const card = addToCartBtn.closest('[data-id]');
            const qtyInput = card.querySelector('.qty-input');
            const product = { id: card.dataset.id, name: card.dataset.name, price: parseFloat(card.dataset.price), image: card.dataset.image, quantity: qtyInput ? parseInt(qtyInput.value) : 1 };
            addToCart(product);
        }
        
        if (target.matches('.qty-btn') && target.closest('.cart-item-actions')) {
            adjustQuantityInCart(target.dataset.id, target.dataset.action);
        }

        if (target.matches('.cart-item-remove-btn')) {
            const itemIndex = cart.findIndex(item => item.id === target.dataset.id);
            if(itemIndex > -1) cart.splice(itemIndex, 1);
            updateCart();
        }
    });
    
    updateCart(); // Initial cart load
});
</script>
</body>
</html>
