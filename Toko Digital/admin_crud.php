<?php
// Hubungkan ke database untuk mengambil data
require_once 'koneksi.php';

// Ambil semua produk dari database untuk ditampilkan di daftar
$query = "SELECT * FROM products ORDER BY name ASC";
$result = mysqli_query($koneksi, $query);
$admin_products = [];
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $admin_products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang - Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TOKO DIGITAL</h2>
                <span>ADMIN PANEL</span>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="admin_notifikasi.php"><i class="fas fa-bell"></i> <span>Notifikasi</span></a></li>
                    <li class="active"><a href="admin_crud.php"><i class="fas fa-box-open"></i> <span>CRUD Barang</span></a></li>
                    <li><a href="admin_rekap.php"><i class="fas fa-file-invoice-dollar"></i> <span>Rekap Data</span></a></li>
                    <li><a href="admin_menyiapkan.php"><i class="fas fa-tasks"></i> <span>Menyiapkan Pesanan</span></a></li>
                    <li><a href="admin_mengantar.php"><i class="fas fa-truck"></i> <span>Mengantar Pesanan</span></a></li>
                    <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Manajemen Barang</h1>
                 <div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div>
            </header>
            <div class="crud-layout">
                <!-- Kolom Kiri: Daftar Produk dari Database -->
                <div class="product-list-section">
                    <div class="list-header"><h3>Daftar Produk (<?php echo count($admin_products); ?>)</h3></div>
                    <div class="product-grid-admin">
                         <?php foreach ($admin_products as $product): ?>
                        <div class="product-card-admin"
                             data-id="<?php echo htmlspecialchars($product['id']); ?>"
                             data-name="<?php echo htmlspecialchars($product['name']); ?>"
                             data-price="<?php echo htmlspecialchars($product['price']); ?>"
                             data-category="<?php echo htmlspecialchars($product['category']); ?>"
                             data-description="<?php echo htmlspecialchars($product['description']); ?>"
                             data-image="<?php echo htmlspecialchars($product['image']); ?>">
                            
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" onerror="this.src='https://placehold.co/60x60/e0e0e0/333?text=Error'">
                            <div class="product-details-admin">
                                <h4><?php echo $product['name']; ?></h4>
                                <p>Rp <?php echo number_format($product['price']); ?> | Kategori: <?php echo $product['category']; ?></p>
                            </div>
                            <div class="product-actions-admin">
                                <button class="btn-admin edit"><i class="fas fa-edit"></i></button>
                                <!-- Form kecil untuk tombol hapus agar aman -->
                                <form action="crud_process.php" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" name="delete_product" class="btn-admin delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Kolom Kanan: Form CRUD Fungsional -->
                <div class="product-form-section">
                    <h3 id="form-title">Tambah Produk Baru</h3>
                    <form id="crud-form" action="crud_process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="product_id" name="product_id">
                        <input type="hidden" id="form_action" name="add_product" value="1">

                        <div class="form-group-crud">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group-crud">
                            <label for="product_price">Harga</label>
                            <input type="number" id="product_price" name="product_price" required>
                        </div>
                        <div class="form-group-crud">
                            <label for="product_category">Kategori</label>
                            <input type="text" id="product_category" name="product_category" required>
                        </div>
                        <div class="form-group-crud">
                            <label for="product_desc">Deskripsi Produk</label>
                            <textarea id="product_desc" name="product_desc" rows="4"></textarea>
                        </div>
                        <div class="form-group-crud">
                            <label for="product_image">Gambar Produk (Opsional)</label>
                            <div class="image-uploader">
                                <input type="file" id="product_image" name="product_image" class="file-input" accept="image/*">
                                <div class="image-preview">
                                    <img src="" alt="Image Preview" id="preview-img" style="display:none; width:100px; height:100px; object-fit: cover; border-radius: 8px;">
                                    <span id="preview-text"><i class="fas fa-cloud-upload-alt"></i><p>Pilih atau seret gambar</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions-crud">
                            <button type="submit" class="btn-form add" id="submit-btn">TAMBAH PRODUK</button>
                            <button type="button" class="btn-form clear" id="clear-btn">BERSIHKAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('crud-form');
    const formTitle = document.getElementById('form-title');
    const productIdInput = document.getElementById('product_id');
    const productNameInput = document.getElementById('product_name');
    const productPriceInput = document.getElementById('product_price');
    const productCategoryInput = document.getElementById('product_category');
    const productDescInput = document.getElementById('product_desc');
    const formActionInput = document.getElementById('form_action');
    const submitBtn = document.getElementById('submit-btn');
    const clearBtn = document.getElementById('clear-btn');
    const previewImg = document.getElementById('preview-img');
    const previewText = document.getElementById('preview-text');
    
    // Fungsi untuk mengisi form saat tombol "Edit" diklik
    function fillForm(data) {
        formTitle.textContent = 'Ubah Produk';
        productIdInput.value = data.id;
        productNameInput.value = data.name;
        productPriceInput.value = data.price;
        productCategoryInput.value = data.category;
        productDescInput.value = data.description;
        
        previewImg.src = data.image;
        previewImg.style.display = 'block';
        previewText.style.display = 'none';

        // Mengubah aksi form menjadi 'update'
        formActionInput.name = 'update_product';
        submitBtn.textContent = 'UPDATE PRODUK';
        submitBtn.classList.remove('add');
        submitBtn.classList.add('edit'); // Untuk styling jika ada
    }
    
    // Fungsi untuk membersihkan form
    function clearForm() {
        form.reset();
        formTitle.textContent = 'Tambah Produk Baru';
        productIdInput.value = '';
        formActionInput.name = 'add_product';
        submitBtn.textContent = 'TAMBAH PRODUK';
        submitBtn.classList.remove('edit');
        submitBtn.classList.add('add');
        previewImg.src = '';
        previewImg.style.display = 'none';
        previewText.style.display = 'block';
    }

    // Event listener untuk tombol edit
    document.querySelectorAll('.btn-admin.edit').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.product-card-admin');
            const data = {
                id: card.dataset.id,
                name: card.dataset.name,
                price: card.dataset.price,
                category: card.dataset.category,
                description: card.dataset.description,
                image: card.querySelector('img').src
            };
            fillForm(data);
            window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
        });
    });

    // Event listener untuk tombol clear
    clearBtn.addEventListener('click', clearForm);

    // Preview gambar saat dipilih
    document.getElementById('product_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                previewText.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
</body>
</html>
