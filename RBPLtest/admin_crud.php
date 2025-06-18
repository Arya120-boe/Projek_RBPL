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
        <aside class="sidebar">
            <div class="sidebar-header"><h2>TOKO DIGITAL</h2><span>ADMIN PANEL</span></div>
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
        <main class="main-content">
            <header class="main-header"><h1>Manajemen Barang</h1><div class="admin-profile"><span>ADMIN ONLY</span><i class="fas fa-user-shield"></i></div></header>
            <div class="crud-layout">
                <div class="product-list-section">
                    <div class="list-header"><h3>Daftar Produk</h3><div class="search-bar-admin"><input type="text" placeholder="Cari produk..."><i class="fas fa-search"></i></div></div>
                    <div class="product-grid-admin">
                         <?php
                        $admin_products = [['name' => 'Sunlight', 'price' => '25000', 'stock' => 50, 'image' => 'https://placehold.co/150x150/e8f5e9/333?text=Sunlight'],['name' => 'Chitato', 'price' => '33000', 'stock' => 30, 'image' => 'https://placehold.co/150x150/fff3e0/333?text=Chitato'],['name' => 'Rinso', 'price' => '21000', 'stock' => 100, 'image' => 'https://placehold.co/150x150/e0e0e0/333?text=Rinso'],['name' => 'Kapal Api', 'price' => '8000', 'stock' => 250, 'image' => 'https://placehold.co/150x150/e0e0e0/333?text=Kapal+Api']];
                        foreach ($admin_products as $product): ?>
                        <div class="product-card-admin"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"><div class="product-details-admin"><h4><?php echo $product['name']; ?></h4><p>Harga: Rp <?php echo number_format($product['price']); ?></p><p>Stok: <?php echo $product['stock']; ?></p></div><div class="product-actions-admin"><button class="btn-admin edit"><i class="fas fa-edit"></i></button><button class="btn-admin delete"><i class="fas fa-trash"></i></button></div></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="product-form-section">
                    <h3>Form CRUD Barang</h3>
                    <form class="form-crud"><div class="form-group-crud"><label for="product_name">Nama Produk</label><input type="text" id="product_name" required></div><div class="form-group-crud"><label for="product_price">Harga</label><input type="number" id="product_price" required></div><div class="form-group-crud"><label for="product_stock">Stok</label><input type="number" id="product_stock" required></div><div class="form-group-crud"><label for="product_desc">Deskripsi</label><textarea id="product_desc" rows="4"></textarea></div><div class="form-group-crud"><label for="product_image">Gambar</label><div class="image-uploader"><input type="file" id="product_image" class="file-input"><div class="image-preview"><i class="fas fa-cloud-upload-alt"></i><p>Pilih gambar</p></div></div></div><div class="form-actions-crud"><button type="submit" class="btn-form add">ADD</button><button type="button" class="btn-form delete">HAPUS</button><button type="button" class="btn-form done">DONE</button><button type="reset" class="btn-form clear">CLEAR ALL</button></div></form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
