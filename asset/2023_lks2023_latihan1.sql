-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 08:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2023_lks2023_latihan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `link` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `title`, `caption`, `link`) VALUES
(1, 'banner-09042023203702-wallpaperflare.com_wallpaper (1).jpg', 'One Piece', 'One Piece', 'https://www.youtube.com/'),
(2, 'banner-09042023203958-wallhaven-396m6v_2560x1440.png', 'Red Umbrella', 'Red Umbrella', 'https://www.ovo.com'),
(3, 'banner-09042023205755-wallhaven-9do3lk_2560x1440.png', 'Lost in rainfall', 'Little human try to escape the world', 'https://github.com/akmalrafidiara/');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Lebaran', 'Kue khas lebaran Mantap POLLL!'),
(3, 'Kue Kering', 'Renyah asik dimakan pas lagi santai'),
(4, 'Kue Bolu', 'Lembut cocok untuk memberi ke orang tersayang'),
(5, 'Kue Basah', 'Lembut enak bergizi');

-- --------------------------------------------------------

--
-- Table structure for table `like_item`
--

CREATE TABLE `like_item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_item`
--

INSERT INTO `like_item` (`id`, `user_id`, `product_id`) VALUES
(3, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `category_id`) VALUES
(1, 'Nastar', 'Kue selai nanas bertabur keju', 'img.png', 1),
(3, 'Putri Salju', 'Lembut cocok untuk memberi ke orang tersayang', '09042023110700-image_2023-04-06_235342280.png', 1),
(4, 'Ongol ongol', 'Lembut kenyal bikin ga berhenti makan', '11042023074912-museum macan.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(4, 'admin', '$2y$10$g8att.2ypgJ52Z4A9RJFv.qJkwmjpMhX7TqLEpfudGRwvUx9h0yn6', 'admin'),
(5, 'akmalrafidiara', '$2y$10$kbXJGZVOgDprDyAydi3B.eAYnPgcX3xt.rq2P71bRC45.vlj9V2dC', 'user'),
(6, 'take', '$2y$10$5D.lRbEIu.XwX4D/K5bMJec3Ko/gNsNqwMP1vUKphgEKpf5S4epPK', 'admin'),
(7, 'apip', '$2y$10$Dyfrdoi29cOKPEPnrfechObr87LeHexM/xcJMkJHWGSBQv8wdPvVe', 'user'),
(10, 'kresna', '$2y$10$gA6piuAOb6PcT7lIWvmeo.tmW.3MLdVISrZrsJoJNP19ZUia4vVWO', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_item`
--
ALTER TABLE `like_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_like` (`user_id`),
  ADD KEY `product_like` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `like_item`
--
ALTER TABLE `like_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `like_item`
--
ALTER TABLE `like_item`
  ADD CONSTRAINT `product_like` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
