-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 12:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invertory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bought` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `image` varchar(300) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `bought`, `sold`, `image`, `created`, `updated`) VALUES
(11, 'TV ', 5, 4, '', '2021-02-05 21:48:33', '2021-02-05 21:48:33'),
(12, 'Charger', 200, 67, '', '2021-02-05 21:49:45', '2021-02-05 21:49:45'),
(15, 'Mobile stand', 20, 17, '', '2021-02-05 22:11:41', '2021-02-05 22:11:41'),
(16, 'Pen', 200, 180, '', '2021-02-06 13:54:58', '2021-02-06 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '@gmail.com',
  `password` varchar(100) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `contact` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `uname`, `email`, `password`, `address`, `contact`, `created`) VALUES
(2, 'Khondker Nafiul Islam', 'nafiulislam', 'nafiulislam@gmail.com', 'nafiul123', 'Lalmatia,Dhaka-1207', '01621292989', '2021-02-04 20:06:36'),
(3, 'Khondker Waliul Islam', 'waliulislam', 'Waliulislam@gmail.com', 'wali123', 'Lalmatia,Dhaka-1207', '01621292900', '2021-02-04 20:07:05'),
(4, 'Akib Hasan', 'akibkhan', 'akib@gmail.com', 'akib123', 'Lalmatia,Dhaka-1207', '01821292989', '2021-02-04 20:11:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
