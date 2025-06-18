<?php include 'header.php'; ?>
<title>Pembayaran - Toko Digital</title>

<main class="container">
    <div class="checkout-page">
        <h1 class="checkout-title">Checkout</h1>
        <div id="checkout-content">
            <!-- Konten checkout akan dirender oleh JavaScript -->
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutContent = document.getElementById('checkout-content');
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const shippingCost = 15000;

    const formatRupiah = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);

    function renderCheckout() {
        if (cart.length === 0) {
            checkoutContent.innerHTML = `
                <div class="checkout-section">
                    <div class="cart-empty-message">
                        <i class="fa fa-shopping-cart"></i>
                        <p>Anda belum memiliki item untuk dibayar.</p>
                        <a href="index.php" class="btn btn-primary">Kembali Belanja</a>
                    </div>
                </div>`;
            return;
        }

        let itemsHTML = '';
        let subtotal = 0;

        cart.forEach(item => {
            const itemSubtotal = item.price * item.quantity;
            subtotal += itemSubtotal;
            itemsHTML += `
                <div class="order-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="item-details">
                        <p class="item-name">${item.name}</p>
                        <p class="item-subprice">${item.quantity} x ${formatRupiah(item.price)}</p>
                    </div>
                    <p class="item-price">${formatRupiah(itemSubtotal)}</p>
                </div>
            `;
        });

        const total = subtotal + shippingCost;

        checkoutContent.innerHTML = `
            <div class="checkout-layout">
                <div class="checkout-left">
                    <div class="checkout-section">
                        <h2 class="section-title"><i class="fa fa-map-marker-alt"></i> Alamat Pengiriman</h2>
                        <form class="address-form">
                            <div class="form-group"><label for="name">Nama Penerima</label><input type="text" id="name" required></div>
                            <div class="form-group"><label for="phone">Nomor Telepon</label><input type="tel" id="phone" required></div>
                            <div class="form-group"><label for="address">Alamat Lengkap</label><textarea id="address" rows="3" required></textarea></div>
                        </form>
                    </div>
                    <div class="checkout-section">
                        <h2 class="section-title"><i class="fa fa-box-open"></i> Produk Dipesan</h2>
                        <div class="order-item-list">${itemsHTML}</div>
                    </div>
                </div>

                <div class="checkout-right">
                    <div class="checkout-section order-summary">
                        <h2 class="section-title">Ringkasan Pesanan</h2>
                        <div class="summary-line"><span>Subtotal</span><span>${formatRupiah(subtotal)}</span></div>
                        <div class="summary-line"><span>Biaya Pengiriman</span><span>${formatRupiah(shippingCost)}</span></div>
                        <hr>
                        <div class="summary-line total"><span>Total Pembayaran</span><span>${formatRupiah(total)}</span></div>
                    </div>
                    <div class="checkout-section">
                        <h2 class="section-title"><i class="fa fa-credit-card"></i> Metode Pembayaran</h2>
                        <div class="payment-options">
                            <div class="payment-method"><input type="radio" id="ewallet" name="payment" checked><label for="ewallet">E-Wallet</label></div>
                            <div class="payment-method"><input type="radio" id="va" name="payment"><label for="va">Virtual Account</label></div>
                            <div class="payment-method"><input type="radio" id="cc" name="payment"><label for="cc">Kartu Kredit/Debit</label></div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-full" id="place-order-btn"><i class="fa fa-shield-alt"></i> Buat Pesanan</button>
                </div>
            </div>`;
    }
    
    document.body.addEventListener('click', e => {
        if(e.target.id === 'place-order-btn') {
            alert('Pesanan berhasil dibuat! (Simulasi)');
            sessionStorage.removeItem('cart'); // Kosongkan keranjang
            window.location.href = 'index.php'; // Kembali ke beranda
        }
    });

    renderCheckout();
});
</script>

<?php include 'footer.php'; ?>
