-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 13, 2023 at 04:27 AM
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
-- Database: `PHYSIO_DATA`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT 'Unknown',
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `image`, `email`, `number`, `subject`, `message`) VALUES
(7, 13, 'ane ahmed', 'manager.png', 'aaaa@test.com', '4', 'product', 'Hello. in this website I got what I need.'),
(24, 21, 'ahmed ali', ' admin.png ', 'ahmed@ahmed.com', '1', 'product', 'I don\'t like this product.'),
(38, 0, 'ahmed', NULL, 'ahmed@ahmed.com', '5', 'product', 'Good product.'),
(39, 13, 'ane ahmed', 'manager.png', 'aaaa@test.com', '4', 'therapy', 'Nice therapy machine.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 13, 'ane ahmed', '4', 'test@gmail.com', 'cash on delivery', 'flat no. 111, main st, NYC, NY, USA - 111111', 'SEMI-REPLATED ERGOCYCLE – CARDIO 650 (1500 x 1) - ARM ERGOCYCLE – CARDIO 720 (1500 x 2) - QUADRICEPS – TANNAC (2000 x 3) - ', 10500, '2023-11-06', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'QUADRICEPS – TANNAC', 'Exercise', 'Kinesitherapie, Rééducation Fonctionnelle, renforcement musculaire, tannac. Length: 53.15 inches. Width: 39.37 inches. Maximum user weight: 330.69 pounds.', 2000, 'GNC14-1 image3.png', 'GNC14-5 image1.png', 'GNC14-9 image2.png'),
(2, 'SEMI-REPLATED ERGOCYCLE – CARDIO 650', 'Exercise', 'Cardio, ergocycle, Cardiac Rehabilitation, Bariatric Care, techmed. Length: 102.36 inches. Width: 41.34 inches. Maximum user weight: 551.16 pounds. Display: Power developed (watts), braking setpoint (watts), speed (rpm and km/h), distance (km), time (min:sec).', 1500, 'car650-4 image2.png', 'car650-3 image3.png', 'car650-5 image1.png'),
(3, 'ARM ERGOCYCLE – CARDIO 720', 'Exercise', 'Cardio, ergocycle, Cardiac Rehabilitation, techmed. Length: 24.41 inches.\r\nWidth: 19.69 inches.\r\nMaximum user weight: 551.16 pounds.\r\nDisplay: Power developed (watts), braking setpoint (watts), speed (km/h and rpm), time (min:sec).', 1500, 'cardio720-9 image1.png', 'cardio720-4 image3.png', 'cardio720-12 image2.png'),
(4, 'Chattanooga Intelect Mobile 2 Combo Unit', 'Electrotherapy', 'Chattanooga Intelect Mobile Combo is a dual frequency ultrasound device combined with 2 channel stimulation.\r\n\r\nFeatures\r\n• 1 and 3 MHz ultrasound frequencies\r\n• Variable duty cycle outputs of 16 Hz, 48 Hz, or 100 Hz for ultrasound\r\n• 15 user-defined memory positions\r\n• Backlit LCD display for better visibility in low light settings.\r\n\r\nTechnical\r\n• Mains Power: 120-240VAC, 50-60Hz\r\n• Weight: 3kg\r\n• Dimensions: (L x W x H) 33 x 29 x 17.3cm.', 3000, 'intelect-01.png', 'intelect-02.png', 'intelect-03.png'),
(5, 'Pressotherapy device PRESS 4 Winelec 2', 'Electrotherapy', 'PRESS 4 from Winelec is a portable lymphatic drainage device designed for home use.\r\nFeatures:\r\nReference: PRESS4\r\nDimensions: 14 x 20 x 20 cm\r\nDistinction: Accessibility for visual impairments\r\nMaintenance: Clean with a damp cloth\r\nMaterial: Accessories 100% nylon\r\nTimer From 5 to 30 minutes\r\nMode: Sequential\r\nNumber of cells: 4 cells\r\nStandard: CE Medical Class IIa\r\nNumber of outputs: 1\r\nWeight: 2.41 kg (compressor weight)\r\nPressure setting: 20 to 200 mm Hg\r\nDecompression time: 2 minutes.', 500, 'pressotherapy-01.png', 'pressotherapy-02.png', 'pressotherapy-03.png'),
(6, 'Breg Polar Care Wave Cold Compression System', 'Heat and cold therapy', 'Breg Polar Care Wave combines motorized cold compression with active compression in a simple and compact system, making it ideal for facility and home use.\r\n\r\nADJUSTABLE COMPRESSION THERAPY SETTINGS: REGULAR, LOW AND OFF\r\nRegular = 50 mmHg average peak compression\r\nLow = 25 mmHg average peak compression\r\n\r\nADJUSTABLE COLD THERAPY SETTINGS: REGULAR, LOW AND OFF\r\nColder ≥ 45°F average operating temperature of the pad\r\nCold ≥ 50°F average operating temperature of the pad', 225, 'POLAR-CARE-WAVE-UNIT-01.png', 'POLAR-CARE-WAVE-UNIT-02.png', 'POLAR-CARE-WAVE-UNIT-03.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
(13, 'ane ahmed', 'aaaa@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'manager.png'),
(21, 'ahmed ali', 'ahmed@ahmed.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
