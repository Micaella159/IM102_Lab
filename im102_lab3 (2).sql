-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 01:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im102_lab3`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Instrument'),
(2, 'Photography'),
(3, 'Art'),
(4, 'Gaming'),
(5, 'Books');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `quantity`, `added_by`, `description`, `category_id`, `supplier_id`, `created_at`) VALUES
(1, 'Acoustic Guitar', 5500.00, 25, 1, '6-string beginner guitar', 1, 1, '2026-06-25 11:03:31'),
(2, 'Keyboard Piano', 8500.00, 15, 1, '61-key electronic piano', 1, 1, '2026-06-25 11:03:31'),
(3, 'Violin', 4200.00, 8, 1, 'Full-size violin set', 1, 2, '2026-06-25 11:03:31'),
(4, 'Drum Set', 12000.00, 10, 1, '5-piece drum set', 1, 1, '2026-06-25 11:03:31'),
(5, 'DSLR Camera', 35000.00, 10, 1, '24MP professional camera', 2, 2, '2026-06-25 11:03:31'),
(6, 'Tripod Stand', 1200.00, 50, 1, 'Adjustable aluminum tripod', 2, 2, '2026-06-25 11:03:31'),
(7, 'Camera Lens', 7500.00, 12, 1, '50mm prime lens', 2, 3, '2026-06-25 11:03:31'),
(8, 'Photography Light', 2800.00, 18, 1, 'LED studio lighting kit', 2, 2, '2026-06-25 11:03:31'),
(9, 'Acrylic Paint Set', 650.00, 20, 1, '24-color paint set', 3, 3, '2026-06-25 11:03:31'),
(10, 'Canvas Board', 180.00, 40, 1, '16x20 inch canvas board', 3, 3, '2026-06-25 11:03:31'),
(11, 'Sketch Pad', 120.00, 35, 1, 'A4 drawing sketchbook', 3, 3, '2026-06-25 11:03:31'),
(12, 'Paint Brush Set', 250.00, 25, 1, '10-piece brush set', 3, 3, '2026-06-25 11:03:31'),
(13, 'Gaming Mouse', 950.00, 25, 1, 'RGB gaming mouse', 4, 1, '2026-06-25 11:03:31'),
(14, 'Mechanical Keyboard', 1800.00, 20, 1, 'Blue switch mechanical keyboard', 4, 1, '2026-06-25 11:03:31'),
(15, 'Gaming Headset', 2200.00, 15, 1, 'Surround sound headset', 4, 1, '2026-06-25 11:03:31'),
(16, 'Gaming Chair', 6500.00, 8, 1, 'Ergonomic gaming chair', 4, 1, '2026-06-25 11:03:31'),
(17, 'Harry Potter Book Set', 2500.00, 50, 1, 'Complete 7-book collection', 5, 2, '2026-06-25 11:03:31'),
(18, 'The Hobbit', 450.00, 30, 1, 'Fantasy novel by J.R.R. Tolkien', 5, 2, '2026-06-25 11:03:31'),
(19, 'Atomic Habits', 600.00, 22, 1, 'Self-improvement bestseller', 5, 2, '2026-06-25 11:03:31'),
(20, 'Rich Dad Poor Dad', 550.00, 18, 1, 'Personal finance classic', 5, 2, '2026-06-25 11:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`) VALUES
(1, 'Musika', 'Jon Ryes', '09123456789'),
(2, 'PhotoGrapics', 'Aria Saos', '09187654321'),
(3, 'ADvance', 'Mark Ruz', '09991234567');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', '12345', 'admin', '2026-06-23 08:49:17'),
(2, 'ellla', 'micaellabacalso.202400826@gmail.com', '$2y$10$36I6boHHO5TKj6S6no7q0OCGRyOoFeUi5fUcipy5.MjAIex6qsXCa', 'staff', '2026-06-23 08:56:42'),
(3, 'Weeeeeeee', 're@gmail.com', '$2y$10$8AAolyEmxdKLlDXjzn89zOjlZ3lNRCvI6a4IRa.hmPU3yXlUrAMCy', 'admin', '2026-06-23 09:02:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_added_by` (`added_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_added_by` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
