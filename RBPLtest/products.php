<?php

function get_all_products() {
    return [
        // Makanan
        ['id' => 'prod_001', 'name' => 'Chitato', 'price' => '11000', 'image' => 'https://placehold.co/300x200/fff3e0/333?text=Chitato', 'category' => 'Makanan', 'desc' => 'Keripik kentang Chitato dengan bumbu sapi panggang yang legendaris dan menggugah selera.'],
        ['id' => 'prod_002', 'name' => 'Indomie Goreng', 'price' => '3000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Indomie', 'category' => 'Makanan', 'desc' => 'Mi instan goreng legendaris dengan cita rasa khas Indonesia yang tak tertandingi.'],
        ['id' => 'prod_003', 'name' => 'Pop Mie', 'price' => '5000', 'image' => 'https://placehold.co/300x200/f5e0e0/333?text=Pop+Mie', 'category' => 'Makanan', 'desc' => 'Solusi mi instan praktis dalam cup, siap seduh kapan saja dan di mana saja.'],
        ['id' => 'prod_004', 'name' => 'Beras Tawon', 'price' => '63500', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Beras+Tawon', 'category' => 'Makanan', 'desc' => 'Beras pulen berkualitas super, pilihan terbaik untuk keluarga Anda.'],
        
        // Minuman
        ['id' => 'prod_005', 'name' => 'Fruit Tea', 'price' => '5500', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Fruit+Tea', 'category' => 'Minuman', 'desc' => 'Minuman teh dengan sensasi rasa buah yang menyegarkan dahaga.'],
        ['id' => 'prod_006', 'name' => 'Susu UHT', 'price' => '17000', 'image' => 'https://placehold.co/300x200/e0e5f5/333?text=Susu+UHT', 'category' => 'Minuman', 'desc' => 'Susu segar UHT 1 liter, kaya akan kalsium dan nutrisi penting lainnya.'],
        ['id' => 'prod_007', 'name' => 'Pocari Sweat', 'price' => '7000', 'image' => 'https://placehold.co/300x200/e0f0f5/333?text=Pocari', 'category' => 'Minuman', 'desc' => 'Minuman isotonik pengganti cairan tubuh yang hilang setelah beraktivitas.'],
        ['id' => 'prod_008', 'name' => 'Kapal Api', 'price' => '8000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Kapal+Api', 'category' => 'Minuman', 'desc' => 'Kopi Kapal Api Special Mix, perpaduan pas antara kopi, gula, dan krimer.'],

        // Sabun & Kebersihan
        ['id' => 'prod_009', 'name' => 'Sunlight', 'price' => '25000', 'image' => 'https://placehold.co/300x200/e8f5e9/333?text=Sunlight', 'category' => 'Sabun & Kebersihan', 'thumbnails' => ['https://placehold.co/100x100/e8f5e9/333?text=1', 'https://placehold.co/100x100/e8f5e9/333?text=2', 'https://placehold.co/100x100/e8f5e9/333?text=3'], 'desc' => 'Sabun cuci piring dengan ekstrak jeruk nipis, ampuh angkat lemak membandel.'],
        ['id' => 'prod_010', 'name' => 'Rinso', 'price' => '21000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Rinso', 'category' => 'Sabun & Kebersihan', 'desc' => 'Deterjen bubuk anti noda, menjaga pakaian tetap bersih cemerlang.'],
        ['id' => 'prod_011', 'name' => 'Vixal', 'price' => '15000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Vixal', 'category' => 'Sabun & Kebersihan', 'desc' => 'Pembersih porselen dan keramik kamar mandi yang ekstra kuat.'],
        ['id' => 'prod_012', 'name' => 'Lifebuoy', 'price' => '35000', 'image' => 'https://placehold.co/300x200/f5e5e0/333?text=Lifebuoy', 'category' => 'Sabun & Kebersihan', 'desc' => 'Sabun mandi cair keluarga dengan formula anti-kuman yang terpercaya.'],
        
        // Bahan Kue
        ['id' => 'prod_013', 'name' => 'Gula Pasir', 'price' => '18000', 'image' => 'https://placehold.co/300x200/e0e0e0/333?text=Gula+Pasir', 'category' => 'Bahan Kue', 'desc' => 'Gula pasir putih bersih dari tebu pilihan untuk segala kebutuhan Anda.'],
        ['id' => 'prod_014', 'name' => 'Tepung Terigu', 'price' => '12000', 'image' => 'https://placehold.co/300x200/f0f0e0/333?text=Terigu', 'category' => 'Bahan Kue', 'desc' => 'Tepung terigu serbaguna protein sedang, cocok untuk aneka kue dan masakan.'],
        ['id' => 'prod_015', 'name' => 'Telur Ayam', 'price' => '28000', 'image' => 'https://placehold.co/300x200/f5f0e5/333?text=Telur', 'category' => 'Bahan Kue', 'desc' => 'Telur ayam negeri segar pilihan, harga per kilogram.'],
    ];
}

function get_categories() {
     return [['name' => 'Bahan Kue', 'image' => 'https://placehold.co/400x300/f0f0e0/333?text=Bahan+Kue'], ['name' => 'Sabun & Kebersihan', 'image' => 'https://placehold.co/400x300/e8f5e9/333?text=Sabun'], ['name' => 'Makanan', 'image' => 'https://placehold.co/400x300/fff3e0/333?text=Makanan'], ['name' => 'Minuman', 'image' => 'https://placehold.co/400x300/e0f0f5/333?text=Minuman']];
}

function find_product_by_name($name) {
    $products = get_all_products();
    foreach ($products as $product) {
        if ($product['name'] === $name) {
            return $product;
        }
    }
    return null;
}

?>
