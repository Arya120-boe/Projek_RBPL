<?php
// Hubungkan ke database
require_once 'koneksi.php';

// --- FUNGSI UNTUK MENG-HANDLE UPLOAD GAMBAR ---
function upload_image() {
    // Periksa apakah ada file yang diunggah dan tidak ada error
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $target_dir = "uploads/"; // PENTING: Buat folder bernama 'uploads' di direktori Anda

        // Buat folder 'uploads' jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Buat nama file yang unik untuk menghindari penimpaan file
        $file_extension = pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
        $unique_file_name = uniqid('product_', true) . '.' . $file_extension;
        $target_file = $target_dir . $unique_file_name;
        
        // Pindahkan file dari lokasi sementara ke folder tujuan
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            return $target_file; // Kembalikan path gambar jika berhasil
        }
    }
    return null; // Kembalikan null jika gagal atau tidak ada gambar
}


// --- LOGIKA UNTUK MENAMBAH PRODUK (CREATE) ---
if (isset($_POST['add_product'])) {
    $id = 'prod_' . time(); // Membuat ID unik
    $name = mysqli_real_escape_string($koneksi, $_POST['product_name']);
    $price = (int)$_POST['product_price'];
    $category = mysqli_real_escape_string($koneksi, $_POST['product_category']);
    $description = mysqli_real_escape_string($koneksi, $_POST['product_desc']);
    
    // Handle upload gambar
    $image_path = upload_image();
    if ($image_path === null) {
        // Gunakan placeholder jika tidak ada gambar yang diunggah
        $image_path = "https://placehold.co/300x200/e0e0e0/333?text=" . urlencode($name);
    }

    $query = "INSERT INTO products (id, name, price, category, description, image) VALUES ('$id', '$name', '$price', '$category', '$description', '$image_path')";
    
    mysqli_query($koneksi, $query);
}

// --- LOGIKA UNTUK MENGUBAH PRODUK (UPDATE) ---
if (isset($_POST['update_product'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['product_id']);
    $name = mysqli_real_escape_string($koneksi, $_POST['product_name']);
    $price = (int)$_POST['product_price'];
    $category = mysqli_real_escape_string($koneksi, $_POST['product_category']);
    $description = mysqli_real_escape_string($koneksi, $_POST['product_desc']);

    $image_path = upload_image();
    
    if ($image_path) {
        // Jika ada gambar baru, perbarui path gambar
        $query = "UPDATE products SET name='$name', price='$price', category='$category', description='$description', image='$image_path' WHERE id='$id'";
    } else {
        // Jika tidak ada gambar baru, jangan perbarui path gambar
        $query = "UPDATE products SET name='$name', price='$price', category='$category', description='$description' WHERE id='$id'";
    }

    mysqli_query($koneksi, $query);
}

// --- LOGIKA UNTUK MENGHAPUS PRODUK (DELETE) ---
if (isset($_POST['delete_product'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['product_id']);
    $query = "DELETE FROM products WHERE id='$id'";
    
    mysqli_query($koneksi, $query);
}


// Setelah selesai memproses, kembalikan ke halaman CRUD
header("Location: admin_crud.php");
exit();

?>
