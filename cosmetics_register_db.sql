-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: Jun 26, 2024 at 10:25 AM
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
-- Database: `cosmetics_register_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `C_ID` int(11) NOT NULL,
  `C_name` varchar(100) NOT NULL,
  `C_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`C_ID`, `C_name`, `C_location`) VALUES
(5, 'Luscious Cosmetics ', 'Lahore'),
(7, 'J. (Junaid Jamshed)', 'karachi'),
(10, 'Beauty Buzz', 'Islamabad'),
(12, 'huda cosmetics', 'Dubai'),
(14, 'Radiance Beauty Co. ', 'Paris, France'),
(15, 'LuxeSkin Essentials', 'Tokyo, Japan'),
(16, 'Radiant Beauty Co.', 'Los Angeles, California, USA'),
(17, 'GlamourGlow Cosmetics ', 'New York City, New York, USA'),
(18, 'Flawless Skincare Solutions ', ' Paris, France'),
(19, 'Belle Cosmetics', 'Tokyo, Japan'),
(20, 'Dior', 'France'),
(21, 'GlamourGlow Cosmetics ', 'Los Angeles, California, USA');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im abdulahad again and again\r\n\r\n', '2024-06-13 17:39:16'),
(3, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi heelo', '2024-06-13 18:03:03'),
(4, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im ahad', '2024-06-14 15:50:13'),
(5, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im ahad thanx', '2024-06-14 15:53:52'),
(6, 'abdul ahad', '03414796631', 'ahadghanchi2003@gmail.com', 'hi ahad', '2024-06-14 15:58:25'),
(7, 'abdul ahad', '03414796631', 'ahadghanchi2003@gmail.com', 'hi ahad', '2024-06-14 16:07:57'),
(8, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im ahad thanx', '2024-06-14 16:10:32'),
(9, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im ahad thanx', '2024-06-14 16:10:55'),
(10, 'abdulahad', '0215424', 'ahadghanchi2003@gmail.com', 'hi im ahad thanx', '2024-06-14 16:13:44'),
(11, 'abdulahad', '0215424', 'maviaahad54@gmail.com', 'hi mavia im abdulahad', '2024-06-14 16:15:21'),
(12, 'abdulahad', '0215424', 'syedmohib1724@gmail.com', 'mohib me abdulahad contact wala kam hogaya alhamdulillah', '2024-06-14 16:16:22'),
(13, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad', '2024-06-22 19:22:55'),
(14, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad', '2024-06-22 19:24:48'),
(15, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad i am mavia', '2024-06-22 19:25:08'),
(16, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad i am mavia', '2024-06-22 19:25:28'),
(17, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad\r\n', '2024-06-22 19:25:43'),
(18, 'AbdulAhad', '03404796631', 'bhaiahad54@gmail.com', 'hi', '2024-06-23 16:42:16'),
(19, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi 123\r\n', '2024-06-23 16:43:08'),
(20, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi 123\r\n', '2024-06-23 16:43:10'),
(21, 'abdulahad', '0215424', 'maviaahad54@gmail.com', 'hi im ahad', '2024-06-24 08:46:20'),
(22, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi ahad', '2024-06-24 17:09:03'),
(23, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi mavia', '2024-06-24 17:10:43'),
(24, 'AbdulAhad', '03404796631', 'bhaiahad54@gmail.com', 'hi your form ready', '2024-06-24 19:54:21'),
(25, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi your form is ready', '2024-06-24 19:55:45'),
(26, 'AbdulAhad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad my name is mavia', '2024-06-24 20:02:02'),
(27, 'AbdulAhad', '03404796631', 'maviaahad54@gmail.com', 'hi ahad my name is mavia', '2024-06-24 20:02:41'),
(28, 'ahad', '03404796631', 'ahadghanchi2003@gmail.com', 'hi ahad now', '2024-06-25 12:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `jewellery`
--

CREATE TABLE `jewellery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `jewellery_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jewellery`
--

INSERT INTO `jewellery` (`id`, `name`, `company_name`, `price`, `jewellery_img`) VALUES
(2, 'Diamond Solitaire Ring	', 'Tiffany & Co.', 20000000.00, 'd1.jpg'),
(3, 'Gold and Diamond	Necklace', 'Indian gold	', 10000000.00, 'j1.jpg'),
(4, 'Gold Pendant Necklace	', 'Cartier', 1500000.00, 'n1.jpg'),
(5, 'Sapphire  Earrings ', 'Bulgari', 2400000.00, 'e1.jpg'),
(6, 'Radiant Bloom Necklace ', 'LuxeGems Jewelry ', 90000.00, 'j2.jpg'),
(8, 'Eternal Elegance Earrings', 'Ethereal Elegance', 1510000.00, 'j311.jpg'),
(9, 'Celestial Charm Bracelet', 'Opulent Ornaments', 240000.00, 'j4.jpg'),
(10, 'Regal Splendor Ring', 'Starlight Jewels', 42000000.00, 'j5.jpg'),
(12, 'Luminous Grace Ring  ', 'Aurora Luxe', 7000000.00, 'r3.jpg'),
(13, 'Serenity Sparkle Ring', 'Pure Elegance ', 48000.00, 'r4.jpg'),
(14, 'Mystic Rose Ring', 'Enchanted Jewellery', 34000.00, 'r6.jpg'),
(15, 'Celestial Elegance Ring', 'Stardust Gems', 25000.00, 'r5.jpg'),
(17, 'Whispering Twilight Ring ', 'Moonlight Jewelry', 39000.00, 'r9.jpg'),
(18, 'Radiant Harmony Ring', ' Eternal Gems', 35000.00, 'r8.jpg'),
(19, 'Gold Bracelet', 'Kashee\'s Gold', 8000.00, 'br1.jpg'),
(20, 'Rubi Diamond Nacklace', 'Indian gold', 68000.00, 'ru1.jpg'),
(21, 'gold Ring', 'Lavis , USA', 1500000.00, 'r72.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `C_ID` int(11) DEFAULT NULL,
  `ManufacturingDate` date NOT NULL,
  `ExpiryDate` date NOT NULL,
  `Price` int(11) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `C_ID`, `ManufacturingDate`, `ExpiryDate`, `Price`, `product_img`) VALUES
(1, 'GlowBloom Serum', 14, '2024-06-10', '2024-06-17', 470, 'g1.jpg'),
(2, 'LuxeLash Mascara', 17, '2024-06-20', '2024-06-26', 710, 'l3.jpg'),
(3, 'Maskara ', 12, '2024-06-19', '2024-04-10', 650, 'm1.jpg'),
(4, 'eyelashes', 7, '2024-06-26', '2024-06-24', 490, 'cs.jpg'),
(5, 'blushes ', 10, '2024-08-18', '2024-06-24', 800, 'b1.jpj'),
(6, 'Cosmetics kit', 10, '2024-09-10', '2024-06-20', 3200, 'cs1.jpg'),
(7, 'Sauvage', 20, '2024-06-18', '2024-12-02', 2400, 'ch2.jpg'),
(8, 'Flawless Finish Foundation', 21, '2023-06-05', '2024-05-08', 4500, 'f1.jpg'),
(9, 'eyeshades', 16, '2023-02-25', '2024-06-03', 1000, 'ey1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `type` enum('admin','customer') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `address`, `type`, `profile_picture`) VALUES
(82, 'ahadcustomer2024', '$2y$10$Nmnr/B5SLElovAawtTQj6eyMkAQn2fxe74uOQSwIotttUkr6DbAmW', 'acs24@gmail.com', '0012145454', 'sbvbfss114', 'customer', 'uploads/a.ahad1.jpg'),
(85, 'customer22024', '$2y$10$tpNu4QTFKlWL3kZgrz5jBeQWX2Rd3/LRiCPB/GAFcr.uIWMTGqp3.', 'cs2@gmail.com', '02254545455', 'gfgfgfg', 'customer', 'uploads/FaceApp_1672145199836~2.jpg'),
(86, 'AbdulAhad65', '$2y$10$tVQuJefMqYH4fAbDIoRzye8uyoqjADcqG4jN.UsPunCNwOQgDiYJG', 'aa65@gmail.com', '0341124244', 'karachi ', 'admin', 'uploads/a.ahad1.jpg'),
(87, 'AbdulAhad12', '$2y$10$3nXjy8e7p/8jzsQfOKkBjeRUf3mJ2RYSrk6GfhDNhDzqOThcTC18O', 'aa612@gmail.com', '0341124244', 'karachi Pakistan', 'admin', 'uploads/IMG_20230621_182740.jpg'),
(91, 'MrAbdulAhad14', '$2y$10$HaHm97f5IjRwM9nluH5xyutQbAvAyzvXQD/vIWurXwEda2TlPf4HO', 'mah@gmail.com', '03124549595', 'karachi Pakistan', 'admin', 'uploads/1687617838052.jpg'),
(92, 'mavia14', '$2y$10$RuwtPibTdE6ZZLMaofT7N.vncg2zUJgUKpvFClzrH3JpSRlfCGkUS', 'm1@gmail.com', '02124', 'dddff', 'customer', ''),
(93, 'husnain', '123', 'h@gmail.com', '0215424', 'dgffhg', 'admin', 'uploads/h1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jewellery`
--
ALTER TABLE `jewellery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jewellery`
--
ALTER TABLE `jewellery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `company` (`C_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
