-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2020 at 07:53 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yujin_bom`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_code` varchar(128) NOT NULL,
  `item_description` varchar(128) NOT NULL,
  `material` varchar(128) NOT NULL,
  `finish` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_code`, `item_description`, `material`, `finish`) VALUES
(2, 'asd', 'asd', 'Polyester Resin', 'Handpainted'),
(3, 'asd', 'asd', 'Polyester Resin', 'Handpainted'),
(6, 'sample', 'sample', 'Polyester Resin', 'No Finish');

-- --------------------------------------------------------

--
-- Table structure for table `item_sculpture_material`
--

CREATE TABLE `item_sculpture_material` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sculpture_id` int(11) NOT NULL,
  `item_value` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_sculpture_material`
--

INSERT INTO `item_sculpture_material` (`id`, `item_id`, `sculpture_id`, `item_value`) VALUES
(4, 2, 1, '45345.00'),
(5, 3, 3, '34234.00'),
(6, 6, 1, '123.00'),
(7, 6, 3, '1234.00');

-- --------------------------------------------------------

--
-- Table structure for table `sculpture_materials`
--

CREATE TABLE `sculpture_materials` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sculpture_materials`
--

INSERT INTO `sculpture_materials` (`id`, `description`) VALUES
(1, 'Styrofoam 1\' x 4\' x 8\''),
(2, 'Micro Wax'),
(3, 'Parafin Wax'),
(4, 'Petroleum Jelly'),
(5, 'Silicone Sealant Clear'),
(6, 'Boral Plaster'),
(7, 'PVC Pipe 4\" X 10ft Orange'),
(8, 'Orinary Plywood 1/4\" (6mm)'),
(9, 'Spag Sauce 100Grams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_sculpture_material`
--
ALTER TABLE `item_sculpture_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `sculpture_id` (`sculpture_id`);

--
-- Indexes for table `sculpture_materials`
--
ALTER TABLE `sculpture_materials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_sculpture_material`
--
ALTER TABLE `item_sculpture_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sculpture_materials`
--
ALTER TABLE `sculpture_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_sculpture_material`
--
ALTER TABLE `item_sculpture_material`
  ADD CONSTRAINT `item_sculpture_material_ibfk_1` FOREIGN KEY (`sculpture_id`) REFERENCES `sculpture_materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_sculpture_material_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
