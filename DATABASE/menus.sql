-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 100.115.92.199
-- Generation Time: Nov 30, 2023 at 05:05 PM
-- Server version: 8.0.35
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `price`, `created_at`, `img`) VALUES
(1, 'Vada pav', 15, '2023-11-29 06:43:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267618/food_order_system/vada-pav_grzq55.jpg'),
(2, 'Fried chicken', 100, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267506/food_order_system/fried-chicken_eyblmr.jpg'),
(3, 'Chilli potato', 50, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267504/food_order_system/chilli-potato_grfkbr.jpg'),
(4, 'Pasta', 150, '2023-11-29 13:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701267505/food_order_system/pasta_acuzhk.jpg'),
(5, 'Veg Manchurian', 80, '2023-11-29 14:58:03', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701269789/food_order_system/veg-manchurian_yuidin.jpg'),
(6, 'Egg Omlette', 50, '2023-11-29 14:58:04', 'https://res.cloudinary.com/dnkelaevp/image/upload/v1701269789/food_order_system/egg-omlete_gih0ma.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
