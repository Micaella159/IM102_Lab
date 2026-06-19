-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 12:48 PM
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
-- Database: `bacalso-2`
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
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`, `created_at`) VALUES
(1, 'Acoustic Guitar', '6-string beginner guitar', 5500.00, 22, 1, 1, '2026-06-15 02:07:54'),
(2, 'Keyboard Piano', '61-key electronic piano', 8500.00, 25, 1, 1, '2026-06-15 02:07:54'),
(3, 'Violin', 'Full-size violin set', 4200.00, 8, 1, 2, '2026-06-15 02:07:54'),
(4, 'DSLR Camera', '24MP professional camera', 35000.00, 30, 2, 2, '2026-06-15 02:07:54'),
(5, 'Tripod Stand', 'Adjustable aluminum tripod', 1200.00, 90, 2, 2, '2026-06-15 02:07:54'),
(6, 'Camera Lens', '50mm prime lens', 7500.00, 7, 2, 3, '2026-06-15 02:07:54'),
(7, 'Acrylic Paint Set', '24-color paint set', 650.00, 20, 3, 3, '2026-06-15 02:07:54'),
(8, 'Canvas Board', '16x20 inch canvas', 180.00, 30, 3, 3, '2026-06-15 02:07:54'),
(9, 'Gaming Mouse', 'RGB gaming mouse', 950.00, 25, 4, 1, '2026-06-15 02:07:54'),
(10, 'Mechanical Keyboard', 'Blue switch keyboard', 1800.00, 20, 4, 1, '2026-06-15 02:07:54'),
(11, 'Harry Potter Book Set', 'Complete 7-book collection', 2500.00, 50, 5, 2, '2026-06-15 02:07:54'),
(12, 'The Hobbit', 'Fantasy novel by J.R.R. Tolkien', 450.00, 20, 5, 2, '2026-06-15 02:07:54'),
(13, 'Drum', 'version22', 6000.00, 20, 3, 1, '2026-06-19 10:17:04');

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
(3, 'ADvance', 'Mark ruz', '09991234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
