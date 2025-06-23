-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 05:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_digital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courier_tasks`
--

CREATE TABLE `courier_tasks` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `status` enum('waiting','accepted','delivered') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `accepted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier_tasks`
--

INSERT INTO `courier_tasks` (`id`, `order_id`, `courier_id`, `status`, `created_at`, `accepted_at`) VALUES
(1, 1, 12, 'delivered', '2025-06-23 12:44:47', '2025-06-23 21:24:49'),
(2, 2, 12, 'delivered', '2025-06-23 12:48:33', '2025-06-23 21:25:13'),
(3, 3, 12, 'delivered', '2025-06-23 12:48:35', '2025-06-23 21:25:15'),
(4, 4, 12, 'delivered', '2025-06-23 12:48:36', '2025-06-23 22:55:21'),
(5, 6, 12, 'delivered', '2025-06-23 13:27:46', '2025-06-23 21:30:02'),
(7, 7, 12, 'accepted', '2025-06-23 13:28:39', '2025-06-23 22:56:44'),
(10, 5, 12, 'delivered', '2025-06-23 13:29:52', '2025-06-23 21:30:04'),
(13, 8, 12, 'accepted', '2025-06-23 14:54:24', '2025-06-23 22:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kode_bayar` varchar(100) NOT NULL,
  `status` enum('pending','processing','ready_for_delivery','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `no_transaksi`, `user_id`, `customer_name`, `customer_address`, `total_bayar`, `kode_bayar`, `status`, `tanggal`) VALUES
(1, 'INV/20250623/9834', NULL, 'Arjuna Mustofa', 'Pc6/80b PT BADAK BONTANG', 231000, 'E-Wallet', 'completed', '2025-06-23 11:28:11'),
(2, 'INV/20250623/9899', NULL, 'gundam', 'jakarta', 37500, 'COD', 'completed', '2025-06-23 11:32:41'),
(3, 'INV/20250623/1074', NULL, 'mamat', 'surabaya', 49000, 'Virtual-Account', 'completed', '2025-06-23 11:33:40'),
(4, 'INV/20250623/6845', NULL, 'nabil', 'bandung', 110000, 'COD', 'completed', '2025-06-23 11:41:48'),
(5, 'INV/20250623/6977', NULL, 'Daffa Ulhaq', 'PC 6A NO 76A Komplek PT BADAK', 86000, 'Virtual-Account', 'completed', '2025-06-23 12:50:25'),
(6, 'INV/20250623/7834', 12, 'dika', 'PC 6A NO 76A Komplek PT BADAK', 23500, 'E-Wallet', 'processing', '2025-06-23 13:25:40'),
(7, 'INV/20250623/1210', 12, 'JOKOOO', 'PC 6A NO 76A Komplek PT BADAK', 61000, 'Virtual-Account', 'shipped', '2025-06-23 13:28:18'),
(8, 'INV/20250623/2299', 7, 'Daffa Ulhaq', 'PC 6A NO 76A Komplek PT BADAK', 77000, 'E-Wallet', 'shipped', '2025-06-23 14:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'prod_005', 'Fruit Tea', 2, 5500),
(2, 1, 'prod_004', 'Beras Tawon', 2, 63500),
(3, 1, 'prod_003', 'Pop Mie', 3, 5000),
(4, 1, 'prod_006', 'Susu UHT Full Cream', 1, 17000),
(5, 1, 'prod_010', 'Rinso Anti Noda', 1, 21000),
(6, 1, 'prod_009', 'Sunlight Jeruk Nipis', 1, 25000),
(7, 2, 'prod_005', 'Fruit Tea Botol', 1, 5500),
(8, 2, 'prod_006', 'Susu UHT Full Cream', 1, 17000),
(9, 3, 'prod_002', 'Indomie Goreng', 1, 3000),
(10, 3, 'prod_003', 'Oreo Original', 1, 8500),
(11, 3, 'prod_005', 'Fruit Tea Botol', 1, 5500),
(12, 3, 'prod_006', 'Susu UHT Full Cream', 1, 17000),
(13, 4, 'prod_007', 'Pocari Sweat 500ml', 1, 7000),
(14, 4, 'prod_012', 'Lifebuoy Cair', 1, 35000),
(15, 4, 'prod_013', 'Gula Pasir 1kg', 1, 18000),
(16, 4, 'prod_1750257785', 'joko', 1, 35000),
(17, 5, 'prod_005', 'Fruit Tea Botol', 1, 5500),
(18, 5, 'prod_007', 'Pocari Sweat 500ml', 1, 7000),
(19, 5, 'prod_009', 'Sunlight Jeruk Nipis', 1, 25000),
(20, 5, 'prod_010', 'Rinso Anti Noda', 1, 21000),
(21, 5, 'prod_011', 'Pepsodent Herbal', 1, 12500),
(22, 6, 'prod_003', 'Oreo Original', 1, 8500),
(23, 7, 'prod_009', 'Sunlight Jeruk Nipis', 1, 25000),
(24, 7, 'prod_010', 'Rinso Anti Noda', 1, 21000),
(25, 8, 'prod_003', 'Oreo Original', 2, 8500),
(26, 8, 'prod_005', 'Fruit Tea Botol', 2, 5500),
(27, 8, 'prod_006', 'Susu UHT Full Cream', 2, 17000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `thumbnails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `description`, `thumbnails`) VALUES
('prod_002', 'Indomie Goreng', 300000, 'https://placehold.co/300x200/e0e0e0/333?text=Indomie', 'Makanan', 'Mi instan goreng legendaris dengan cita rasa khas Indonesia yang tak tertandingi.', NULL),
('prod_003', 'Oreo Original', 8500, 'https://placehold.co/300x200/1a1a1a/ffffff?text=Oreo', 'Makanan', 'Biskuit sandwich coklat dengan krim vanila yang lezat. Diputar, dijilat, dicelupin!', NULL),
('prod_006', 'Susu UHT Full Cream', 17000, 'https://placehold.co/300x200/e0e5f5/333?text=Susu+UHT', 'Minuman', 'Susu segar UHT 1 liter, kaya akan kalsium dan nutrisi penting lainnya.', NULL),
('prod_007', 'Pocari Sweat 500ml', 7000, 'https://placehold.co/300x200/e0f0f5/333?text=Pocari', 'Minuman', 'Minuman isotonik pengganti cairan tubuh yang hilang setelah beraktivitas.', NULL),
('prod_009', 'Sunlight Jeruk Nipis', 25000, 'https://placehold.co/300x200/e8f5e9/333?text=Sunlight', 'Sabun & Kebersihan', '[\"https://placehold.co/100x100/e8f5e9/333?text=1\",\"https://placehold.co/100x100/e8f5e9/333?text=2\",\"https://placehold.co/100x100/e8f5e9/333?text=3\"]', 'Sabun cuci piring dengan ekstrak jeruk nipis, ampuh angkat lemak membandel.'),
('prod_010', 'Rinso Anti Noda', 21000, 'https://placehold.co/300x200/f0e0f5/333?text=Rinso', 'Sabun & Kebersihan', 'Deterjen bubuk anti noda, menjaga pakaian tetap bersih cemerlang.', NULL),
('prod_011', 'Pepsodent Herbal', 12500, 'https://placehold.co/300x200/d5f5e3/333?text=Pepsodent', 'Sabun & Kebersihan', 'Pasta gigi dengan kandungan herbal untuk nafas lebih segar dan gigi lebih kuat.', NULL),
('prod_012', 'Lifebuoy Cair', 35000, 'https://placehold.co/300x200/f5e5e0/333?text=Lifebuoy', 'Sabun & Kebersihan', 'Sabun mandi cair keluarga dengan formula anti-kuman yang terpercaya.', NULL),
('prod_015', 'Telur Ayam 1kg', 28000, 'https://placehold.co/300x200/f5f0e5/333?text=Telur', 'Bahan Kue', 'Telur ayam negeri segar pilihan, harga per kilogram.', NULL),
('prod_1750257785', 'joko', 35000, 'https://placehold.co/300x200/e0e0e0/333?text=joko', 'makanan', 'wecbwoeunowue', NULL),
('prod_1750690661', 'fanta', 100000, 'https://placehold.co/300x200/e0e0e0/333?text=fanta', 'minuman', 'wecwecwec', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'pengguna',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Budi Santoso', 'budi.santoso@example.com', '$2y$10$E.g76s2.gP1qgqZpYx8aBu2n.Vb.H/5f/j.Fm.lTz7.r.z/x.lT6O', 'pengguna', '2025-06-22 10:38:41'),
(2, 'Admin Toko', 'admin@tokodigital.com', '$2y$10$E.g76s2.gP1qgqZpYx8aBu2n.Vb.H/5f/j.Fm.lTz7.r.z/x.lT6O', 'admin', '2025-06-22 10:38:58'),
(3, 'dafa', 'arjunamustofa05@gmail.com', '$2y$10$lM.pwsUtzyLs8Sd16oyW5ebHmANM61SzP3hgbPVbSQEY8gyXDGM0.', 'pengguna', '2025-06-22 17:12:17'),
(4, 'masi', 'almasganteng15@gmail.com', '$2y$10$uRnQ8fMZf7t4gB31HKJxPOwYwRPmXhJEtNTNV5sYg6NFogBVyduaG', 'pengguna', '2025-06-22 18:53:51'),
(5, 'Tokodigital', 'tokodigital@gmail.com', '123456', 'admin', '2025-06-23 08:03:03'),
(6, 'daffa', 'daffa@gmail.com', '123456', 'pengguna', '2025-06-23 08:07:54'),
(7, 'Daffa Ulhaq', 'daffaulhaq506@gmail.com', '$2y$10$tNvmwxbHNQ3zQkCsHTTy2ef9wQgNxIP0wOM7AHIEVTJmsWBlJhGFm', 'pengguna', '2025-06-23 08:12:53'),
(8, 'arya', 'arya@gmail.com', '$2y$10$22XwvIVim6dd4VNKE6evFOu3AKHDEJsrwPhbpRY.mRde9rhAVazZG', 'pengguna', '2025-06-23 08:48:51'),
(9, 'Daffa Ulhaq', 'daf@gmail.com', '$2y$10$OxXARPG214q9mpIn.qRyIeerXCzrRNdrKToj2bvMHLAE7gs8Z4o1S', 'admin', '2025-06-23 10:07:58'),
(10, 'arya mahmuda', 'mahmuda@gmail.com', '$2y$10$b5bg7BGPe04n0Eg8/hR0m.fc6UOHpsPJUyVF.KbRFm20j2A5SbqSO', 'kurir', '2025-06-23 10:12:48'),
(11, 'jamal', 'jamal@gmail.com', '$2y$10$65RZR16a3h58MUpktryvIuLk4r.U3jlfluYXjdB9G3QRP.eFkWOna', 'pengguna', '2025-06-23 10:30:54'),
(12, 'dika', 'dika@gmail.com', '$2y$10$mpCgpo0HLYs.pQBcvh1dVugBgLXwYIc2QveA4ahVcOuV8FxKccwui', 'kurir', '2025-06-23 11:46:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courier_tasks`
--
ALTER TABLE `courier_tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `courier_id` (`courier_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courier_tasks`
--
ALTER TABLE `courier_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier_tasks`
--
ALTER TABLE `courier_tasks`
  ADD CONSTRAINT `courier_tasks_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
