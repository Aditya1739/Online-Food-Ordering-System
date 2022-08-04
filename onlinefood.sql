-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 07:12 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefood`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(35, 'Aditya', 'aditya', '057829fa5a65fc1ace408f490be486ac'),
(36, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(37, 'rahul', 'rahul', '439ed537979d8e831561964dbbbd7413'),
(38, 'siddhant', 'siddhant', 'e5bf515039cdf685df68445a1dac27af');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(33, 'PIZZA', 'Food_Category_303.jpg', 'Yes', 'Yes'),
(34, 'MOMOS', 'Food_Category_444.jpg', 'Yes', 'Yes'),
(35, 'BURGER', 'Food_Category_559.jpg', 'Yes', 'Yes'),
(38, 'SANDWICH', 'Food_Category_951.jpg', 'Yes', 'Yes'),
(39, 'DRINKS', 'Food_Category_71.jpg', 'Yes', 'Yes'),
(40, 'JUICE', 'Food_Category_699.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(225) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(36, 'Onion Pizza', 'If you are a pizza lover, then this Onion is going to become your next favorite! Made using pizza sauce, onion, capsicum, tomatoes, mozzarella, oregano, chilli flakes, salt and black pepper, this pizza recipe is absolutely lip-smacking. ', '100.00', 'Food-Name-793.jfif', 33, 'No', 'Yes'),
(37, 'Paneer Pizza', 'If you are a pizza lover, then this PaneerPizza recipe is going to become your next favorite! Made using pizza sauce, onion, capsicum, tomatoes, mozzarella, oregano, chilli flakes, salt and black pepper, this pizza recipe is absolutely lip-smacking. ', '200.00', 'Food-Name-3140.jpg', 33, 'Yes', 'Yes'),
(38, 'Caspsicum Pizza', 'If you are a pizza lover, then this Capsicum Pizza recipe is going to become your next favorite! Made using pizza sauce, onion, capsicum, tomatoes, mozzarella, oregano, chilli flakes, salt and black pepper, this pizza recipe is absolutely lip-smacking. ', '120.00', 'Food-Name-5598.png', 33, 'No', 'Yes'),
(39, 'Exotic Pizza', 'If you are a pizza lover, then this Onion Capsicum Pizza recipe is going to become your next favorite! Made using pizza sauce, onion, capsicum, tomatoes, mozzarella, oregano, chilli flakes, salt and black pepper, this pizza recipe is absolutely lip-smacking. ', '250.00', 'Food-Name-2040.webp', 33, 'Yes', 'Yes'),
(40, 'Aloo Tikki Burger', '', '50.00', 'Food-Name-7867.jpg', 35, 'No', 'Yes'),
(41, 'Maharaja Mac', '', '120.00', 'Food-Name-4815.jpg', 35, 'Yes', 'Yes'),
(42, 'Grilled Burger', '', '80.00', 'Food-Name-4679.jpg', 35, 'Yes', 'Yes'),
(43, 'Veg Momos', '', '60.00', 'Food-Name-7909.jfif', 34, 'No', 'Yes'),
(44, 'Paneer Momos', '', '70.00', 'Food-Name-7026.jfif', 34, 'No', 'Yes'),
(45, 'Darjeling Momos', '', '70.00', 'Food-Name-8927.png', 34, 'Yes', 'Yes'),
(46, 'Veg Fried Momos', '', '80.00', 'Food-Name-1715.jfif', 34, 'Yes', 'Yes'),
(47, 'Paneer Fried Momos', '', '90.00', 'Food-Name-7022.jpg', 34, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Caspsicum Pizza', '2.00', 5, '10.00', '2021-04-26 07:19:46', 'Ordered', 'Aditya Chauhan', ' 7042241911', 'adityachauhans2002@gmail.com', '801 Marvel Homes\r\nSector-61,Noida'),
(2, 'Darjeling Momos', '3.00', 13, '39.00', '2021-04-26 07:23:51', 'On Delivery', 'Aditya ', ' 7042241911', 'adityachauhan2048@gmail.com', '801 Marvel Homes\r\nSector-61,Noida'),
(3, 'Exotic Pizza', '4.00', 4, '16.00', '2021-04-27 06:30:26', 'Delivered', 'Rahul', ' 9625201928', 'adityachauhans2048@gmail.com', 'Grand Ajnara Heritage'),
(4, 'Grilled Burger', '3.00', 3, '9.00', '2021-04-27 05:53:47', 'Canceled', 'Robin', ' 9458905700', 'robin123@gmail.com', 'Prateek Edifice,sector 107,Noida');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
