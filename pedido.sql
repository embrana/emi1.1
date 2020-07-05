-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 09:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dni` int(11) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `pago` varchar(255) NOT NULL,
  `cons1` int(11) NOT NULL,
  `art` varchar(255) NOT NULL,
  `art_anch` varchar(255) NOT NULL,
  `cant` int(11) NOT NULL,
  `n_pedido` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id`, `name`, `lastname`, `email`, `dni`, `tel`, `pago`, `cons1`, `art`, `art_anch`, `cant`, `n_pedido`, `created_at`) VALUES
(57, '', '', '', 0, '', '', 1, '', '', 2, '', '2020-07-02 13:54:24'),
(58, '', '', '', 0, '', '', 1, '', '', 1, '', '2020-07-02 13:55:51'),
(59, '', '', '', 0, '', '', 1, '', '', 1, '', '2020-07-02 13:56:53'),
(60, '', '', '', 0, '', '', 1, '', 'asasas', 1, '20200702020012', '2020-07-02 14:04:17'),
(61, 'Emiliano', 'braña', 'em.brana@gmail.com', 0, '+5491159275056', '', 1, '', '', 1, '20200702020417', '2020-07-02 14:04:21'),
(62, 'Emiliano', 'braña', 'em.brana@gmail.com', 95516234, '+5491159275056', 'uno', 2, 'articulo', 'dfasdfasd', 2, '20200702020421', '2020-07-02 14:04:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
