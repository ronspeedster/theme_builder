-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2020 at 02:52 PM
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
-- Table structure for table `casting_labor`
--

CREATE TABLE `casting_labor` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `days` decimal(12,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casting_labor`
--

INSERT INTO `casting_labor` (`id`, `item_id`, `days`) VALUES
(1, 9, '90.0000');

-- --------------------------------------------------------

--
-- Table structure for table `casting_materials`
--

CREATE TABLE `casting_materials` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `price` decimal(12,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casting_materials`
--

INSERT INTO `casting_materials` (`id`, `description`, `price`) VALUES
(1, '1st Coating-FR441', '10.0000'),
(2, 'Putty Mix-Reg004', '1.0000'),
(3, '1st Coating', '1.0000'),
(4, '2nd Coating', '1.0000'),
(5, 'Fibermat-300', '1.0000'),
(6, 'Resin 206 (004PL)', '1.0000'),
(7, 'Rolling Mix-411', '1.0000'),
(8, 'Rolling Mix', '1.0000'),
(9, ' Hardener-Ordinary', '1.0000'),
(10, 'Lacquer Thinner', '1.0000'),
(11, 'Styrene', '1.0000'),
(12, 'Toner', '1.0000'),
(13, 'Laminated Block', '1.0000'),
(14, 'Back Coat-004', '1.0000'),
(15, 'Liquid Release Wax', '1.0000'),
(16, 'Flexible Resin 31-832', '1.0000'),
(17, 'Resin Mix w/ Sand', '1.0000'),
(18, 'Fibermat-300', '1.0000'),
(19, 'Resin 206', '1.0000'),
(20, 'Clear Resin 32-037', '1.0000'),
(21, 'Hardner-Butanox', '1.0000');

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
(7, 'R-177', 'Lobster', 'Polyester Resin', 'Handpainted'),
(8, 'C-098', 'Coco', 'Polyester Resin', 'Handpainted'),
(9, 'C-105', 'Comic Pelican', 'Polyester Resin', 'Handpainted'),
(10, 'C-118', 'Viking Betty with Base', 'Polyester Resin', 'Handpainted'),
(11, 'C-125', 'Viking Drinking Horn', 'Polyester Resin', 'Handpainted'),
(12, 'CC-001-NF', 'Concept 1990 Bear (No Finish)', 'Polyester Resin', 'Handpainted'),
(13, 'CC-002-NF', 'Concept 1990 Duck with Base (No Finish)', 'Polyester Resin', 'Handpainted'),
(14, 'CC-003-NF', 'Concept 1900 Frog (No Finish)', 'Polyester Resin', 'Handpainted'),
(15, 'CC-004-NF', 'Concept 1900 Goat Female (No Finish)', 'Polyester Resin', 'Handpainted'),
(16, 'R-180', 'Caveman with Deer Antler', 'Polyester Resin', 'Handpainted'),
(17, 'R-186', 'Camel', 'Polyester Resin', 'Handpainted'),
(18, 'R-205', 'Cushion Starfish', 'Polyester Resin', 'Handpainted'),
(19, 'S-078', 'Son Elf', 'Polyester Resin', 'Handpainted'),
(20, 'S-093', 'Mini Gingerbread Papa', 'Polyester Resin', 'Handpainted'),
(21, 'S-107', 'Mini Rock Candies with Base', 'Polyester Resin', 'Handpainted'),
(22, 'S-118', 'Candy Cane with Base', 'Polyester Resin', 'Handpainted');

-- --------------------------------------------------------

--
-- Table structure for table `item_casting_material`
--

CREATE TABLE `item_casting_material` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sculpture_id` int(11) NOT NULL,
  `item_value` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_casting_material`
--

INSERT INTO `item_casting_material` (`id`, `item_id`, `sculpture_id`, `item_value`) VALUES
(1, 9, 3, '2.10'),
(2, 8, 4, '2.63'),
(3, 9, 5, '0.89'),
(4, 9, 7, '1.89'),
(5, 9, 8, '0.53'),
(6, 9, 9, '0.11'),
(7, 9, 10, '0.26'),
(8, 9, 4, '2.63'),
(9, 9, 11, '0.21');

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
(8, 9, 1, '0.61'),
(9, 9, 2, '6.06'),
(10, 8, 3, '6.06'),
(11, 9, 4, '0.30'),
(12, 8, 5, '1.00'),
(13, 10, 1, '0.50'),
(14, 10, 2, '5.00'),
(15, 10, 3, '5.00'),
(16, 10, 4, '0.25'),
(17, 10, 5, '2.00'),
(18, 12, 1, '1.36'),
(19, 12, 2, '13.56'),
(20, 12, 3, '13.56'),
(21, 12, 4, '0.68'),
(22, 12, 5, '0.02'),
(23, 12, 6, '0.50'),
(24, 13, 1, '0.55'),
(25, 13, 2, '7.70'),
(26, 13, 3, '7.70'),
(27, 13, 4, '0.39'),
(28, 13, 5, '0.08'),
(29, 13, 6, '1.10'),
(30, 14, 1, '0.55'),
(31, 14, 2, '8.80'),
(32, 14, 3, '8.80'),
(33, 14, 4, '0.44'),
(34, 14, 5, '0.55'),
(35, 15, 1, '0.55'),
(36, 15, 2, '8.80'),
(37, 15, 3, '8.80'),
(38, 15, 4, '0.07'),
(39, 15, 6, '1.10'),
(40, 7, 1, '0.39'),
(41, 7, 2, '3.93'),
(42, 7, 3, '3.93'),
(43, 7, 4, '0.20'),
(44, 7, 5, '2.62'),
(45, 16, 1, '1.05'),
(46, 16, 2, '11.43'),
(47, 16, 3, '11.43'),
(48, 16, 4, '0.57'),
(49, 16, 5, '0.78'),
(50, 18, 1, '0.29'),
(51, 18, 2, '2.88'),
(52, 18, 3, '2.88'),
(53, 18, 4, '0.14'),
(54, 18, 5, '1.92'),
(55, 19, 1, '0.30'),
(56, 19, 2, '3.50'),
(57, 20, 3, '3.50'),
(58, 20, 4, '0.25'),
(59, 19, 6, '0.50'),
(60, 19, 3, '3.50'),
(61, 19, 4, '0.25'),
(62, 22, 1, '0.02'),
(63, 22, 2, '2.00'),
(64, 22, 3, '2.00'),
(65, 22, 4, '0.10'),
(66, 22, 7, '0.67'),
(67, 9, 3, '2.10');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `client_name` varchar(128) NOT NULL,
  `project_title` varchar(128) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_target` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `remarks` varchar(128) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_flanges` int(11) NOT NULL,
  `unit_cbm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `client_name`, `project_title`, `order_date`, `order_target`, `item_id`, `remarks`, `qty`, `unit_flanges`, `unit_cbm`) VALUES
(2, '', 'sasdasd', '2020-03-17 00:00:00', '2020-03-06 00:00:00', 9, 'asdasd', 234, 234, 2344234),
(3, '10', 'PROJECT-001', '2020-03-06 00:00:00', '2020-03-06 00:00:00', 9, 'OK', 2, 6, 10),
(4, 'CLIENTRONIE', 'PROJECT-001', '2020-04-11 00:00:00', '2020-03-06 00:00:00', 9, 'K', 2, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `sculpture_labor`
--

CREATE TABLE `sculpture_labor` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sculpture_labor`
--

INSERT INTO `sculpture_labor` (`id`, `item_id`, `days`) VALUES
(1, 9, 104);

-- --------------------------------------------------------

--
-- Table structure for table `sculpture_materials`
--

CREATE TABLE `sculpture_materials` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `price` decimal(12,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sculpture_materials`
--

INSERT INTO `sculpture_materials` (`id`, `description`, `price`) VALUES
(1, 'Styrofoam 1 x 4 x 8', '11.0000'),
(2, 'Micro Wax', '10.0000'),
(3, 'Parafin Wax', '50.0000'),
(4, 'Petroleum Jelly', '21.0000'),
(5, 'Silicone Sealant Clear', '210.0000'),
(6, 'Boral Plaster', '12.0000'),
(7, 'PVC Pipe 4 X 10ft Orange', '80.0000'),
(8, 'Orinary Plywood 1/4 (6mm)', '10.0000'),
(9, 'Spag Sauce 100Grams', '500.0000'),
(16, 'Orinary Plywood 1/4', '14.0000'),
(17, 'Silicone Sealant Clear', '16.0000');

-- --------------------------------------------------------

--
-- Table structure for table `utilization`
--

CREATE TABLE `utilization` (
  `id` int(11) NOT NULL,
  `material` varchar(128) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `budgest_cost` decimal(12,2) DEFAULT NULL,
  `actual_cost` decimal(12,2) DEFAULT NULL,
  `budget_actual` decimal(12,2) DEFAULT NULL,
  `percent` decimal(12,2) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilization`
--

INSERT INTO `utilization` (`id`, `material`, `material_id`, `project_id`, `budgest_cost`, `actual_cost`, `budget_actual`, `percent`, `item_id`) VALUES
(5, 'sculpture', 1, 3, NULL, '20.00', NULL, NULL, NULL),
(6, 'sculpture', 2, 3, NULL, '20.00', NULL, NULL, NULL),
(7, 'sculpture', 3, 3, NULL, '20.00', NULL, NULL, NULL),
(8, 'sculpture', 4, 3, NULL, '20.00', NULL, NULL, NULL),
(9, 'sculpture', 1, 2, NULL, '10.00', NULL, NULL, NULL),
(10, 'sculpture', 2, 2, NULL, '10.00', NULL, NULL, NULL),
(11, 'sculpture', 3, 2, NULL, '10.00', NULL, NULL, NULL),
(12, 'sculpture', 4, 2, NULL, '10.00', NULL, NULL, NULL),
(13, 'casting', 1, 2, NULL, '1.00', NULL, NULL, NULL),
(14, 'casting', 2, 2, NULL, '1.00', NULL, NULL, NULL),
(15, 'casting', 4, 2, NULL, '1.00', NULL, NULL, NULL),
(16, 'casting', 3, 2, NULL, '1.00', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casting_labor`
--
ALTER TABLE `casting_labor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casting_materials`
--
ALTER TABLE `casting_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_casting_material`
--
ALTER TABLE `item_casting_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `sculpture_id` (`sculpture_id`);

--
-- Indexes for table `item_sculpture_material`
--
ALTER TABLE `item_sculpture_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `sculpture_id` (`sculpture_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `sculpture_labor`
--
ALTER TABLE `sculpture_labor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sculpture_materials`
--
ALTER TABLE `sculpture_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilization`
--
ALTER TABLE `utilization`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casting_labor`
--
ALTER TABLE `casting_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `casting_materials`
--
ALTER TABLE `casting_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `item_casting_material`
--
ALTER TABLE `item_casting_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_sculpture_material`
--
ALTER TABLE `item_sculpture_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sculpture_labor`
--
ALTER TABLE `sculpture_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sculpture_materials`
--
ALTER TABLE `sculpture_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `utilization`
--
ALTER TABLE `utilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
