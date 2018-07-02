-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2018 at 02:26 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpamarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `url_shortner`
--

CREATE TABLE `url_shortner` (
  `id` int(20) NOT NULL,
  `original_link` text NOT NULL,
  `new_link` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_shortner`
--

INSERT INTO `url_shortner` (`id`, `original_link`, `new_link`, `created_at`, `updated_at`) VALUES
(36, 'http://localhost/cpa-uploads/test_run.html', 'NewOne', '2018-06-23 13:53:02', '2018-06-23 13:53:02'),
(37, 'http://localhost/cpa-uploads/test_run.html', '9xGKOa', '2018-06-23 13:53:54', '2018-06-23 13:53:54'),
(38, 'http://localhost/cpa-uploads/test_run.html', 'nH4qNP', '2018-06-23 14:05:39', '2018-06-23 14:05:39'),
(39, 'http://localhost/cpa-uploads/test_run.html', 'Seeppd', '2018-06-23 14:06:04', '2018-06-23 14:06:04'),
(40, 'http://localhost/cpa-uploads/test_run.html', 'EmmanuelNew2', '2018-06-23 14:19:44', '2018-06-23 14:19:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `url_shortner`
--
ALTER TABLE `url_shortner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `url_shortner`
--
ALTER TABLE `url_shortner`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
