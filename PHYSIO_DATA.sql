-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2023 at 08:11 PM
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
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(3, 'admin1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(33, 24, 1, 'QUADRICEPS – TANNAC', 2000, 1, 'GNC14-1 image3.png'),
(34, 24, 4, 'Chattanooga Intelect Mobile 2 Combo Unit', 3000, 1, 'intelect-01.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(100) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Exercise', 'exercise.png'),
(2, 'Electrotherapy', 'electrotherapy.png'),
(3, 'Heat and cold therapy', 'Heat-cold-therapy.png'),
(4, 'Balance and stability', 'Balance-stability.png'),
(5, 'Mobility aids', 'Mobility-Aids.png'),
(6, 'Massage and manual therapy', 'massage-therapy.png'),
(7, 'Others', 'Others.png');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `product_id` int(100) NOT NULL,
  `stock_quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`product_id`, `stock_quantity`) VALUES
(22, 10),
(23, 20),
(24, 21),
(1, 20),
(2, 25);

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
(1, 0, 'ali', NULL, 'ali@gmail.com', '5', 'therapy', 'This is a good therapy machine'),
(2, 13, 'ane ahmed', 'manager.png', 'aaaa@test.com', '5', 'therapy', 'I like this therapy machine.'),
(3, 0, 'James', NULL, 'james@gmail.com', '4', 'product', 'Here is a perfect products.'),
(4, 21, 'ahmed ali', 'admin.png', 'ahmed@ahmed.com', '5', 'therapy', 'The therapy machine is helpful.'),
(5, 0, 'Kamel', NULL, 'Kamel@gmail.com', '3', 'Table product', 'Tables are not new model.'),
(48, 0, 'james', NULL, 'james@test.com', '4', 'product', 'I found a perfect product but I cannot register. how I can do it'),
(49, 0, 'ali', NULL, 'ali@test.com', '5', 'Product', 'Actually, I want buy a some machine from this site.'),
(50, 0, 'Zahid', NULL, 'zahid@test.com', '5', 'Product', 'I like these products.'),
(51, 24, 'Zahid', 'admin.png', 'zahid@test.com', '4', 'Product', 'Do you have a table massage.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `order`
-- (See below for the actual view)
--
CREATE TABLE `order` (
`order_id` int(100)
,`product_id` int(100)
,`quantity` int(100)
);

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
(8, 13, 'Ahmed hocine', '2345433456', 'aaaa@test.com', 'cash on delivery', 'flat no. 1, main street, Brooklyn, NY, US - 23454', 'QUADRICEPS – TANNAC (2000 x 1) - SEMI-REPLATED ERGOCYCLE – CARDIO 650 (1500 x 1) - ', 3500, '2023-12-12', 'completed'),
(9, 13, 'Ahmed hocine', '2345433456', 'aaaa@test.com', 'cash on delivery', 'flat no. 1, main street, Brooklyn, NY, US - 23443', 'ARM ERGOCYCLE – CARDIO 720 (1500 x 1) - Chattanooga Intelect Mobile 2 Combo Unit (3000 x 1) - ', 4500, '2023-12-12', 'completed'),
(10, 23, 'ali', '2345435678', 'ali@test.com', 'cash on delivery', 'flat no. 1, main street, Brooklyn, NY, US - 23123', 'SEMI-REPLATED ERGOCYCLE – CARDIO 650 (1500 x 1) - Breg Polar Care Wave Cold Compression System (225 x 1) - ', 1725, '2023-12-13', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`) VALUES
(5, 0, 0),
(6, 0, 0),
(6, 0, 0),
(6, 0, 0),
(6, 0, 0),
(6, 0, 0),
(6, 0, 0),
(7, 0, 0),
(7, 0, 0),
(8, 1, 1),
(8, 2, 1),
(9, 3, 1),
(9, 4, 1),
(10, 2, 1),
(10, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` varchar(1500) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) DEFAULT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `quantity`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'QUADRICEPS – TANNAC', 'Exercise', 'Kinesitherapie, Rééducation Fonctionnelle, renforcement musculaire, tannac. Length: 53.15 inches. Width: 39.37 inches. Maximum user weight: 330.69 pounds.', 2000, 15, 'GNC14-1 image3.png', 'GNC14-5 image1.png', 'GNC14-9 image2.png'),
(2, 'SEMI-REPLATED ERGOCYCLE – CARDIO 650', 'Exercise', 'Cardio, ergocycle, Cardiac Rehabilitation, Bariatric Care, techmed. Length: 102.36 inches. Width: 41.34 inches. Maximum user weight: 551.16 pounds. Display: Power developed (watts), braking setpoint (watts), speed (rpm and km/h), distance (km), time (min:sec).', 1500, 20, 'car650-4 image2.png', 'car650-3 image3.png', 'car650-5 image1.png'),
(3, 'ARM ERGOCYCLE – CARDIO 720', 'Exercise', 'Cardio, ergocycle, Cardiac Rehabilitation, techmed. Length: 24.41 inches.\r\nWidth: 19.69 inches.\r\nMaximum user weight: 551.16 pounds.\r\nDisplay: Power developed (watts), braking setpoint (watts), speed (km/h and rpm), time (min:sec).', 1500, 25, 'cardio720-9 image1.png', 'cardio720-4 image3.png', 'cardio720-12 image2.png'),
(4, 'Chattanooga Intelect Mobile 2 Combo Unit', 'Electrotherapy', 'Chattanooga Intelect Mobile Combo is a dual frequency ultrasound device combined with 2 channel stimulation.\r\n\r\nFeatures\r\n• 1 and 3 MHz ultrasound frequencies\r\n• Variable duty cycle outputs of 16 Hz, 48 Hz, or 100 Hz for ultrasound\r\n• 15 user-defined memory positions\r\n• Backlit LCD display for better visibility in low light settings.\r\n\r\nTechnical\r\n• Mains Power: 120-240VAC, 50-60Hz\r\n• Weight: 3kg\r\n• Dimensions: (L x W x H) 33 x 29 x 17.3cm.', 3000, 12, 'intelect-01.png', 'intelect-02.png', 'intelect-03.png'),
(5, 'Pressotherapy device PRESS 4 Winelec 2', 'Electrotherapy', 'PRESS 4 from Winelec is a portable lymphatic drainage device designed for home use.\r\nFeatures:\r\nReference: PRESS4\r\nDimensions: 14 x 20 x 20 cm\r\nDistinction: Accessibility for visual impairments\r\nMaintenance: Clean with a damp cloth\r\nMaterial: Accessories 100% nylon\r\nTimer From 5 to 30 minutes\r\nMode: Sequential\r\nNumber of cells: 4 cells\r\nStandard: CE Medical Class IIa\r\nNumber of outputs: 1\r\nWeight: 2.41 kg (compressor weight)\r\nPressure setting: 20 to 200 mm Hg\r\nDecompression time: 2 minutes.', 500, 50, 'pressotherapy-01.png', 'pressotherapy-02.png', 'pressotherapy-03.png'),
(6, 'Breg Polar Care Wave Cold Compression System', 'Heat and cold therapy', 'Breg Polar Care Wave combines motorized cold compression with active compression in a simple and compact system, making it ideal for facility and home use.\r\n\r\nADJUSTABLE COMPRESSION THERAPY SETTINGS: REGULAR, LOW AND OFF\r\nRegular = 50 mmHg average peak compression\r\nLow = 25 mmHg average peak compression\r\n\r\nADJUSTABLE COLD THERAPY SETTINGS: REGULAR, LOW AND OFF\r\nColder ≥ 45°F average operating temperature of the pad\r\nCold ≥ 50°F average operating temperature of the pad', 225, 17, 'POLAR-CARE-WAVE-UNIT-01.png', 'POLAR-CARE-WAVE-UNIT-02.png', 'POLAR-CARE-WAVE-UNIT-03.png'),
(7, 'Biotronix Dual Probe Pain Relief LASER Therapy', 'Heat and cold therapy', 'Digital LCD Pain Physiotherapy Rehabilitation LASER.\r\nProduct Specifications\r\n\r\nType: Handheld\r\nModel Name/Number: Dual Probe Laser System for Physiotherapy.\r\nBrand: Biotronix Solution Forever\r\nCluster Probe: Dual Probe Laser\r\nMaterial: ABS Plastic\r\nFrequency: 10 Hz to 5KHz\r\nRed Light Laser Therapy: 750mW Laser\r\nWarranty Details: 2 Year Warranty\r\nCountry of Origin: Made in India.\r\n\r\nProduct Description:\r\nBiotronix Dual Probe Pain Relief LASER Therapy Digital LCD Pain Physiotherapy Rehabilitation LASER.\r\n\r\nKey Features:\r\n1. Dual Probe Laser Therapy.\r\n2. Digital LCD Display.\r\n3. Pain Relief and Rehabilitation.\r\n4. Customizable Settings.\r\n5. Physiotherapy at Your Fingertips.\r\n6. Lightweight and Portable.\r\n7. Proven Laser Technology.\r\n8. User-Friendly Operation.\r\n9. Rechargeable.\r\n10. Durable Build.', 2800, 23, 'biotronix-lasertherapy-01.png', 'biotronix-lasertherapy-02.png', 'biotronix-lasertherapy-03.png'),
(8, 'Shuttle Balance Senior', 'Balance and stability', 'FEATURES:\r\nDynamic Platform - Develops necessary proprioception in the elderly to the stabilizers in the elite athlete. Simulates a slip through motion in all horizontal planes. Provides secure footing and supports up to 500 pounds.\r\n\r\nAdjustable Suspension Chains - Adjustable Balance Platform height, degree of stability and tilt sensitivity. Perturbates in both standing and seated positions for therapeutic and sport-specific treatments.\r\n\r\nSafely Train Balance - Convenient bars provide security and increased confidence during all phases of training. Can be used with your favorite balance accessory ie: Foam pad, DynaDisc®, & BOSU® Ball.\r\n\r\nAvailable Shuttle Accessories - Safety Step & Wheel Assembly.\r\n\r\nSPECS:\r\nPlatform Dimensions - 24&#34; x 30&#34;\r\n\r\nBalance Footprint - 42&#34; x 50&#34;\r\n\r\nLoad Capacity - 400 lbs\r\n\r\nRail Height - 41&#34;', 1400, 8, 'ShuttleBalanceSenior1.png', 'ShuttleBalanceSenior2.png', 'ShuttleBalanceSenior3.png'),
(9, 'Shuttle TNT Leg Press', 'Balance and stability', 'Description:\r\nThe Introducing the all-new Shuttle TNT Leg Press, an affordable, high-performance, Training &#39;n&#39; Therapy machine. Provides a range of exercises from light rehab to explosive plyometrics and leg press.\r\n\r\nTraining &#39;n&#39; Therapy\r\n\r\n24&#34; Seat Height\r\nTwo Position Adjustable Backrest - Supine and 45°\r\nAdjustable Hand Grips\r\nPNF Towers & Pulley System Available\r\nAll Aluminum Construction\r\nCarriage Capacity: 350lbs.\r\n', 8380, 6, 'shuttleclinicaldeluxe_900x1.png', 'shuttleclinicaldeluxe_900x2.png', 'shuttleclinicaldeluxe_900x3.png'),
(10, 'Knee Walker', 'Mobility aids', 'DESCRIPTION:\r\nThe height adjustable knee walker with hand brakes has rubber handles and folds flat for easy storage and transportation. The leg pad with integrated channel provides stability and comfort. The knee walker is designed to be a better option than crutches for some users. It is far easier to operate than crutches, requires less effort and reduces the risk of falling. The knee walker provides safe and effective outdoor mobility for users who cannot bear weight on their foot or ankle, yet want to remain active and mobile.\r\nADDITIONAL INFORMATION:\r\nWEIGHT CAPACITY: 130kg\r\nWARRANTY: 12 Months–Parts&Labour\r\nHEIGHT-KNEE: Min 430mm Max 585mm\r\nHEIGHT-HANDLE: 790mm–1000mm\r\nWEIGHT: 12kg', 320, 30, 'KneeWalker1.png', 'KneeWalker2.png', 'KneeWalker3.png'),
(11, '4 in 1 Folding', 'Mobility aids', '4 in 1 Folding Walker with Detachable Seat by Health Line Massage Products, Width Adjustable Folding Walkers with 5” Wheels and Extra 2 Skis, Compact Adults Walker for Seniors Support Up to 350lbs.\r\n\r\nAbout the item\r\nWidth Adjustable : Different to normal 2 wheels walker. Adjust the width of standard walker from 18.1 inches to 21.7 inches.\r\n4-in-1 Stand Assist: This folding walker with seat is designed as R-shape rising auxiliary. Seated users can gradually progress from the lower to the top level of handles.\r\nReliable Mobility Aid: Lightweight folding walker is constructed with a sturdy aluminum frame. The aluminum frame offers exceptional durability, providing a solid and stable structure that can withstand daily use and support users up to 350 pounds.\r\n2 Skis & 1 Seat for Option: With 2 pcs skis. User can sit on this walker.\r\nOne Hand Folding: Health line massage products front wheel walker features a convenient folding mechanism.', 355, 27, '4in1FoldingWalker1.png', '4in1FoldingWalker2.png', '4in1FoldingWalker3.png'),
(12, 'PhysioRoom Muscle Resistance Workout', 'Massage and manual therapy', 'If the thought of having to invest in expensive exercise equipment is something that has put you off working out at home we have the perfect solution for you. The Resistance Workout system is compact and cost-effective and can be used by beginners and more experienced exercisers, allowing you to get more out of your time spent working out at home.\r\nSKU: FR7\r\nTone up abdominal, glutes, calves, back, biceps and shoulders.\r\nBidirectional power for stand-up and floor exercises.\r\nCompact and lightweight and easy to store away.\r\nOffers 6 training levels.\r\n\r\nKey Features.\r\nRegular Use: Use on a daily basis.\r\nLightweight: Very light to carry for easy transportation.\r\nStrength: Strengthen your core area.\r\nExercise: 44 different types of exercise.', 15, 60, 'PhysioRoomMuscleResistance1.png', 'PhysioRoomMuscleResistance2.png', 'PhysioRoomMuscleResistance3.png'),
(13, 'Foam Handle Resistance Tubes', 'Massage and manual therapy', 'n today’s fast-paced world it’s not always so easy to find the time to get to the gym. But what about if you could bring the gym to you, wherever you are? This set of 3 resistance tubes offers just that, giving you the flexibility to workout wherever you need so you are always in control of where and when you exercise.\r\nSKU: FTA-02\r\nFeatures two soft foam handles for comfort.\r\nStrong flexibility designed to withstand vigorous workouts.\r\nWork out your muscles without the strain of lifting weights.\r\nChoose the resistance level that suits your needs.\r\n\r\nKey Features.\r\nDurable: Long lasting as it is made from premium rubber latex.\r\nResistance: Different resistance levels available.\r\nMuscles: Gain muscle-building benefits.\r\nRegular Use: Use on a daily basis.', 10, 250, 'FoamHandleResistanceTubes1.png', 'FoamHandleResistanceTubes2.png', 'FoamHandleResistanceTubes3.png'),
(14, 'AerosoLess FILTERED SafetyNeb Mask', 'Others', 'KEEPING FRONTLINE WORKERS SAFER WITH OUR INNOVATIVE AEROSOLESS™ MASKS.\r\nOUR MASKS PROTECT FRONTLINE WORKERS FROM EXPOSURE TO PATIENTS’ POTENTIALLY DANGEROUS AEROSOLS.\r\nSAFER THAN EVER BEFORE\r\nThe COVID-19 pandemic has forever changed the paradigms of how to safely and effectively treat patients with shortness of breath. AerosoLess™ Medical has developed masks which seals tightly to the patient’s face and filters out potentially dangerous bioaerosols before they can be released into the atmosphere.\r\n\r\nThese masks more safely allow medical personnel to optimally treat bronchospasm with medications targeted to the lungs.\r\nTHE EVOLUTION FOR BETTER SAFETY\r\nThe AerosoLess™ Mask finally allows us to treat patients with shortness of breath while keeping our healthcare workers safer.', 13, 1500, 'AEROSOLESSMASKS1.png', 'AEROSOLESSMASKS2.png', 'AEROSOLESSMASKS3.png'),
(15, 'Intraoral 3D Scanner S6500 – Fussen', 'Others', 'User-friendly software\r\nCalibration-Free\r\nNo Yearly Fees\r\nAutoclavable Scanning Heads\r\nOpen-source software\r\n\r\nDescription:\r\n3D Intraoral scanner S6500\r\nAssists dental professionals with accuracy and efficiency in all prosthetic scenarios such as crown & bridge, orthodontics, etc..\r\n\r\nFussen Scanners Comparison:\r\nWEIGHT 350 kg\r\nDIMENSIONS N/A\r\nMODEL Stand alone, Cart.', 9000, 7, 'Fussen-Imaging1.png', 'Fussen-Imaging2.png', 'Fussen-Imaging3.png'),
(17, 'Clinton Cabinet Style Space Saver Treatment Table with Step Stool.', 'Others', 'body.dark-mode .show-products .box-container .box .category', 980, 10, 'treatment-table-with-step-stool1.png', 'treatment-table-with-step-stool2.png', 'treatment-table-with-step-stool3.png');

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
(21, 'ahmed ali', 'ahmed@ahmed.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin.png'),
(22, 'james jack', 'james@test.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin.png'),
(23, 'ali', 'ali@test.com', '8cb2237d0679ca88db6464eac60da96345513964', 'user.png'),
(24, 'Zahid', 'zahid@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin.png');

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

-- --------------------------------------------------------

--
-- Structure for view `order`
--
DROP TABLE IF EXISTS `order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `physio_data`.`order`  AS SELECT `physio_data`.`order_details`.`order_id` AS `order_id`, `physio_data`.`order_details`.`product_id` AS `product_id`, `physio_data`.`order_details`.`quantity` AS `quantity` FROM `physio_data`.`order_details` ORDER BY `physio_data`.`order_details`.`product_id` ASC ;

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
