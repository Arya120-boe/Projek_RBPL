<?php 
session_start();
include 'header.php'; 
?>
<title>Checkout - Toko Digital</title>
<main class="container">
    <div class="checkout-page">
        <h1 class="checkout-title">Checkout</h1>
        <!-- Form utama yang akan mengirim semua data ke checkout_process.php -->
        <form action="checkout_process.php" method="POST" id="checkout-form">
            <div id="checkout-content">
                <!-- Konten dinamis (form alamat, daftar produk, ringkasan) akan dirender di sini oleh JavaScript -->
                <p>Memuat keranjang Anda...</p>
            </div>
            <!-- Input tersembunyi ini akan diisi oleh JavaScript dengan data keranjang -->
            <input type="hidden" name="cart_data" id="cart-data-input">
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutContent = document.getElementById('checkout-content');
    const cartDataInput = document.getElementById('cart-data-input');
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    
    // Simpan data keranjang ke input tersembunyi agar bisa dikirim dengan form
    cartDataInput.value = JSON.stringify(cart);
    
    const shippingCost = 15000;
    const formatRupiah = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);

    function renderCheckout() {
        if (cart.length === 0) {
            checkoutContent.innerHTML = `
                <div class="checkout-section" style="text-align:center;">
                    <p>Keranjang Anda kosong. Silakan kembali berbelanja.</p>
                    <br>
                    <a href="index.php" class="btn btn-primary" style="width: auto; padding: 10px 30px;">Kembali ke Beranda</a>
                </div>`;
            return;
        }

        let itemsHTML = '';
        let subtotal = 0;
        cart.forEach(item => {
            const itemSubtotal = item.price * item.quantity;
            subtotal += itemSubtotal;
            itemsHTML += `<div class="order-item"><img src="${item.image}" alt="${item.name}"><div class="item-details"><p class="item-name">${item.name}</p><p class="item-subprice">${item.quantity} x ${formatRupiah(item.price)}</p></div><p class="item-price">${formatRupiah(itemSubtotal)}</p></div>`;
        });

        const total = subtotal + shippingCost;
        const customerName = "<?php echo isset($_SESSION['user_fullname']) ? htmlspecialchars($_SESSION['user_fullname']) : ''; ?>";

        checkoutContent.innerHTML = `
            <div class="checkout-layout">
                <div class="checkout-left">
                    <div class="checkout-section">
                        <h2 class="section-title"><i class="fa fa-map-marker-alt"></i> Alamat Pengiriman</h2>
                        <div class="address-form">
                            <div class="form-group"><label for="name">Nama Penerima</label><input type="text" id="name" name="customer_name" value="${customerName}" required></div>
                            <div class="form-group"><label for="phone">Nomor Telepon</label><input type="tel" id="phone" name="customer_phone" required></div>
                            <div class="form-group"><label for="address">Alamat Lengkap</label><textarea id="address" name="customer_address" rows="3" required></textarea></div>
                        </div>
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
                        <div class="summary-line"><span>Pengiriman</span><span>${formatRupiah(shippingCost)}</span></div>
                        <hr>
                        <div class="summary-line total"><span>Total</span><span>${formatRupiah(total)}</span></div>
                    </div>
                    <div class="checkout-section">
                        <h2 class="section-title"><i class="fa fa-credit-card"></i> Metode Pembayaran</h2>
                        <div class="payment-options">
                            <div class="payment-method"><input type="radio" id="ewallet" name="payment_method" value="E-Wallet" checked><label for="ewallet">E-Wallet</label></div>
                            <div class="payment-method"><input type="radio" id="va" name="payment_method" value="Virtual-Account"><label for="va">Virtual Account</label></div>
                             <div class="payment-method"><input type="radio" id="cod" name="payment_method" value="COD"><label for="cod">Bayar di Tempat (COD)</label></div>
                        </div>
                    </div>
                    <button type="submit" form="checkout-form" class="btn btn-primary btn-full" id="place-order-btn"><i class="fa fa-shield-alt"></i> Buat Pesanan & Bayar</button>
                </div>
            </div>`;
    }
    
    // Menjalankan render saat halaman dimuat
    renderCheckout();

    // Menangani submit form
    const checkoutForm = document.getElementById('checkout-form');
    checkoutForm.addEventListener('submit', function(e) {
        // Validasi form manual jika diperlukan sebelum submit
        const requiredFields = checkoutForm.querySelectorAll('[required]');
        let allValid = true;
        requiredFields.forEach(field => {
            if (!field.value) {
                allValid = false;
            }
        });

        if (!allValid) {
            e.preventDefault();
            alert('Harap isi semua kolom alamat pengiriman terlebih dahulu.');
        } else {
             // Membersihkan keranjang setelah form disubmit
            sessionStorage.removeItem('cart');
        }
    });
});
</script>

<?php include 'footer.php'; ?>
