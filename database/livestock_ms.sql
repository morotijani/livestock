-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 01:36 PM
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
-- Database: `livestock_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Wadud', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8 '),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997 '),
(3, 'baba', '40bd001563085fc35165329ea1ff5c5ecbdbbeef '),
(5, 'Joe', 'b7ed088190c204b31cd71484e6a1c538986b5f77 '),
(6, 'Baba Tudey', '8cb2237d0679ca88db6464eac60da96345513964 ');

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`id`, `name`) VALUES
(1, 'Boer'),
(2, 'Kiko'),
(3, 'Black Bengal'),
(4, 'Sirohi'),
(12, 'Bokoloji(Sokoto Gudali)'),
(13, 'Bunaji(White Fulani)'),
(14, 'Shorthorn(Ghana)'),
(15, 'Araucana'),
(16, 'Brahma'),
(17, 'Cochin'),
(18, 'Wyandotte'),
(19, 'Gf_White'),
(20, 'Gf_Black'),
(21, 'Gf_lavender'),
(22, 'Gf_pearl'),
(24, 'Jiji de'),
(25, 'Tiwa');

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` int(11) NOT NULL,
  `livestockno` varchar(255) NOT NULL,
  `sale_amount` float(10,2) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `threshold` int(11) DEFAULT NULL,
  `arrived` date NOT NULL,
  `vaccination_date` date DEFAULT NULL,
  `remark` text NOT NULL,
  `health_status` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `reorder` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `livestock`
--

INSERT INTO `livestock` (`id`, `livestockno`, `sale_amount`, `breed_id`, `weight`, `img`, `gender`, `quantity`, `threshold`, `arrived`, `vaccination_date`, `remark`, `health_status`, `type`, `reorder`) VALUES
(1, 'live-stock-4260  ', 300.00, 1, '1.4', 'uploadfolder/download.jpg', 'male', 4, 3, '2024-09-06', '2024-10-12', 'qw', 'active', 'Goat', 0),
(2, 'live-stock-2614', 1600.00, 3, '5.0', 'uploadfolder/download (1).jpg', 'male', NULL, NULL, '2024-07-02', '2024-03-12', '...', 'active', 'Cow', 0),
(3, 'live-stock-8999 ', 50.00, 22, '2.0', 'uploadfolder/download (4).jpg', 'male', 2, 1, '2024-12-04', '2024-09-06', '....', 'active', 'Fowl', 0),
(4, 'live-stock-5071 ', 400.00, 3, '3.3', 'uploadfolder/download (2).jpg', 'male', 52, 9, '2024-05-14', '2024-12-12', ',,.,', 'active', 'Guineafowl', 0),
(5, 'live-stock-8180', 2000.00, 1, '89.11', 'uploadfolder/R.png', 'female', 42, 4, '2024-09-03', '2024-10-03', '...', 'active', 'Goat', 1),
(6, 'live-stock-5446', 230.00, 18, '67.22', 'uploadfolder/download (3).jpg', 'male', 6, 10, '2024-09-18', '2024-12-18', '...', 'active', 'Guineafowl', 1),
(7, 'live-stock-9935', 7000.00, 21, '78', 'uploadfolder/download (3).jpg', 'male', 3, 4, '2024-09-11', '2024-12-11', '....', 'active', 'Guineafowl', 0),
(8, 'live-stock-9375', 78.00, 20, '45', 'uploadfolder/download (3).jpg', 'male', 23, 10, '2024-09-10', '2024-08-05', '...', 'active', 'Goat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quarantine`
--

CREATE TABLE `quarantine` (
  `id` int(11) NOT NULL,
  `livestockno` varchar(50) NOT NULL,
  `date_q` varchar(10) NOT NULL,
  `reason` text NOT NULL,
  `breed` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quarantine`
--

INSERT INTO `quarantine` (`id`, `livestockno`, `date_q`, `reason`, `breed`) VALUES
(1, 'live-stock-2614', '2024-09-03', 'Legs has issues', 'Black Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `reorder`
--

CREATE TABLE `reorder` (
  `id` int(11) NOT NULL,
  `reorder_id` varchar(300) DEFAULT NULL,
  `livestock_id` text DEFAULT NULL,
  `new_amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reorder`
--

INSERT INTO `reorder` (`id`, `reorder_id`, `livestock_id`, `new_amount`) VALUES
(1, '1725616412', '5,6', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sales_id` varchar(100) DEFAULT NULL,
  `livestock_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sales_id`, `livestock_id`, `amount`) VALUES
(1, '1725616373', 1, 300.00),
(2, '1725616389', 6, 230.00),
(3, '1725616911', 7, 7000.00),
(4, '1725616931', 7, 7000.00),
(5, '1725616937', 7, 7000.00),
(6, '1725616948', 7, 7000.00),
(7, '1725616966', 7, 7000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarantine`
--
ALTER TABLE `quarantine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reorder`
--
ALTER TABLE `reorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quarantine`
--
ALTER TABLE `quarantine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reorder`
--
ALTER TABLE `reorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
